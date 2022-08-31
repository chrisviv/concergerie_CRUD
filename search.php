 <?php include('connect.php');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" href="./css/style.css">
    <title>Chercher une intervention</title>
</head>
<body id="chercherInt">
    <main >
        <section id="boxSearchConcierge">
            <form action="search.php" method="POST">
                <div id="boxSearchInt">
                    <h1>Chercher une intervention</h1>
                    <h2 class="tacheSearch">Type d'intervention</h2>
                    <select name="tacheToSearch" id="tacheToSearch" >
                        <option value=""></option>
                        <?php  recupTache();?>
                    </select>
                    <label for="date_intervention">Date d'intervention</label>
                    <input type="date" name="dateToSearch" id="dateToSearch" >

                    <label for="etage_intervention">Etage d'intervention</label>
                    <input type="number" name="floorToSearch" id="floorToSearch" >

                    <input id="inSearch" type="submit" name="action" value="Chercher">
                    <div class="linkInt">
                        <a id="buttonSub" href="index.php">Ajouter</a>
                    </div>
                </div>
            </form>
            <div id="inResult">
                <h1>Résultat d'une recherche d'intervention</h1>  
                    <div class="linkInt">
                        <?php  if(isset($_POST['action']) && $_POST['action']=="Chercher" && (!empty($_POST['tacheToSearch'])||!empty($_POST['dateToSearch'])||!empty($_POST['floorToSearch']))){  
                                searchInt();
                                }       
                        ?>
                        <a class="buttonSub" href="index.php">Ajouter</a>
                    </div>
            </div>
        </section>
    </main>
</body>
</html>