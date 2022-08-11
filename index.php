<?php 
include('connect.php');
if(isset($_SESSION['nom_user'])){
echo "<p>Bienvenue ".$_SESSION['nom_user']."</p> <a href='./logout.php'>Se déconnecter</a>";
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
    <link rel="stylesheet" href="style.css">
    <title>Conciergerie d'un immeuble</title>
</head>
<body>
<main>
    <form action="connect.php" method="post">
        <h1>Conciergerie</h1>
        <div id=boxIntervention>
            <p>Saisir les intervention </p>
            <div>
                <label for="type_intervention">Type d'intervention</label>
                <input type="text" name="type_intervention" id="type_inntervention">
            </div>
            <div>
                <label for="date_intervention">Date d'intervention</label>
                <input type="date" name="date_intervention" id="date_intervention">
            </div>
            <div>
                <label for="etage_intervention">Etage d'intervention</label>
                <input type="text" name="etage_intervention" id="etage_intervention">
            </div>
        </div>
    </form>
</main>
</body>
</html>