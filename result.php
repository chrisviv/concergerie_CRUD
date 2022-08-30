<?php include('connect.php');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" href="./css/style.css">
    <title>Résultat d'une recherche d'intervention</title>
</head>
<body id="resultInt">
    <main>    
        <h1>Résultat d'une recherche d'intervention</h1>  
        <div id="inResult">
            <div class="linkInt">
                <?php  if(isset($_POST['action']) && $_POST['action']=="Chercher" && (!empty($_POST['tacheToSearch'])||!empty($_POST['dateToSearch'])||!empty($_POST['floorToSearch']))){  
                        searchInt();
}       
?>
                <a class="buttonSub color" href="index.php">Ajouter</a>
            </div>
        </div>
    </main>
</body>
</html>