<?php 
    include('connect.php');
    if(isset($_SESSION['nom_user'])){
    echo "<p id='bonjour'>Bienvenue Mr". " ".$_SESSION['nom_user']."</p'> <a class='boxLogout' href='logout.php'>Se déconnecter</a>";
    }
    else{
        header('Location: ./login.php');     
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Application pour le service de conciergerie">
    <link rel="stylesheet" href="./css/style.css">
    <title>Conciergerie d'un immeuble</title>
</head>
<body id="index">
    <?php
        //on traite l'ajout des interventions
        if(isset($_POST['action'])){//POST n'est pas vide, on vérfie que les données sont présentes
        if($_POST['action']=='addInter'&&isset($_POST['etage_intervention'], $_POST['date_intervention'], $_POST['addTache'])&& !empty($_POST['etage_intervention']) && !empty($_POST['date_intervention'])&& !empty( $_POST['addTache'])){
            //La saisie des interventions est complet /On peut les enregister //on se connecte à la base //on écrit la requête 
            $sql = "INSERT INTO `concierge`(`etage_intervention`, `date_intervention`,`id_user`,`ID_taches`) VALUES (:etage_intervention, :date_intervention, :id_user, :id_taches)";
            $query = connect()->prepare($sql); //on prépare la requête
            $query->bindParam(":etage_intervention", $_POST['etage_intervention']);//on injecte les valeurs
            $query->bindParam(":date_intervention", $_POST['date_intervention']);
            $query->bindParam(":id_user", $_SESSION['id_user']);
            $query->bindParam(":id_taches", $_POST['addTache']);
            if(!$query->execute()){//on exécute la requete
                die("Une erreur est survenue");
                }
            }
        elseif($_POST['action']=='addTypeInter'&& isset($_POST['type_intervention'])&& !empty($_POST['type_intervention'])){
            addingType();
        }
        else{
            die('ajout des interventions complet');
        }
    }
    ?>
    <main>
        <section id="boxIndexConcierge">
            <!-- zone de connextion -->
            <form action="index.php" method="post" >
                <div class="boxDashBord">
                    <p class="dashBord">Tableau de bord de </p>
                    <h1 class="boxIndexH1">Conciergerie</h1>
                </div>
                <div id=boxIntervention>
                    <div class="boxEtage">
                        <p class="ajoutInt">Ajouter les interventions </p>
                        <label for="etage_intervention" >Etage</label>
                        <input type="number" name="etage_intervention" min='1' max='10' id="etage_intervention">
                    </div>
                    <label for="date_intervention">Type d'intervention</label>
                    <select name="addTache" id="addTache">
                    <option value=""></option>
                        <?php recupTache();?>
                    </select>
                    <div class="dateInt">
                        <label for="date_intervention">Date d'intervention</label>
                        <input type="date" name="date_intervention" id="date_intervention">
                    </div>
                    <button class="etage" type="submit" name="action" value="addInter">Ajouter ici</button>
                    <div id="boxTypeInt">
                    <div class="linkInt">
                        <label for="type_intervention">Type d'intervention</label>
                        <a class='aIndexConcierge'href="search.php">Chercher</a>
                    </div>
                    <input type="text" name="type_intervention" id="type_intervention">
                    <button class="type" type="submit" name="action" value="addTypeInter">Ajouter le type d'intervention</button>
                   
                </div>
                </div>
            </form>
        </section>
        <section id="boxMaintenanceConcierge">
            <div id="boxContainer">
                <h1>
                    Liste des Interventions
                </h1>
                <table id="customers">
                    <thead>
                        <tr>
                            <th>Date d'intervention</th>
                            <th>Type d'interventon</th>
                            <th>Etage</th>
                            <th>Modification</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <?php recup(); ?>
                </table>
            </div>
        </section>
    </main>
</body>
</html>