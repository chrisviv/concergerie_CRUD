<?php 
include('connect.php');
if(isset($_SESSION['nom_user'])){
echo "<p>Bienvenue Mr". " ".$_SESSION['nom_user']."</p> <a class='boxLogout' href='./logout.php'>Se déconnecter</a>";
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
    <link rel="stylesheet" href="./css/style.css">
    <title>Conciergerie d'un immeuble</title>
</head>
<body id="index">
    <?php
//on traite l'ajout des interventions
if(isset($_POST['action'])){
    //POST n'est pas vide, on vérfie que les données sont présentes
    if($_POST['action']=='addInter'&&isset($_POST['etage_intervention'], $_POST['date_intervention'], $_POST['addTache'])&& !empty($_POST['etage_intervention']) && !empty($_POST['date_intervention'])&& !empty( $_POST['addTache'])){
        //La saisie des interventions est complet
        // On récupére les données en les protégeant (failles XSS)
        //On peut les enregister 
        //on se connecte à la base  //require_once "../../incluses/connect.php";
        //on écrit la requête 
        $sql = "INSERT INTO `concierge`(`etage_intervention`, `date_intervention`,`id_user`,`ID_taches`) VALUES (:etage_intervention, :date_intervention, :id_user, :id_taches)";
        //on prépare la requête
        $query = connect()->prepare($sql);
        //on injecte les valeurs
        $query->bindParam(":etage_intervention", $_POST['etage_intervention']);
        // $query->bindParam(":type_intervention", $_POST['type_intervention']);
        $query->bindParam(":date_intervention", $_POST['date_intervention']);
        $query->bindParam(":id_user", $_SESSION['id_user']);
        $query->bindParam(":id_taches", $_POST['addTache']);

        //on exécute la requete
        if(!$query->execute()){
            die("Une erreur est survenue");
        }
        //on récupére l'id 
        // $id = $db->lastInsertId();
        // die("Ajout de l'intervention effectuée sous le numero $id");
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
    <form action="" method="post" >
        <!-- zone de connextion -->
        <h1 class="boxIndexH1">Conciergerie</h1>
        <div id=boxIntervention>
            <div class="boxEtage">
                <p class="ajoutInt">Ajouter les interventions </p>
                <label for="etage_intervention">Etage</label>
                <input type="number" name="etage_intervention" id="etage_intervention">
                <button class="etage" type="submit" name="action" value="addInter">Ajouter ici</button>
            </div>
            <select name="addTache" id="addTache">
               <?php
                    retrieveTache();
                ?>
            </select>
            <div class="dateInt">
                <label for="date_intervention">Date d'intervention</label>
                <input type="date" name="date_intervention" id="date_intervention">
            </div>
        </div>
    </form>
    <form action="" method="post">
        <!-- zone de connextion -->
        <div id="boxTypeInt">
            <div>
                <label for="type_intervention">Type d'intervention</label>
                <input type="text" name="type_intervention" id="type_inntervention">
                <button class="type" type="submit" name="action" value="addTypeInter">Ajouter le type d'intervention</button>
            </div>
        </div>
    </form>
    <a href="maintenance.php">Maintenance</a>
</main>
</body>
</html>