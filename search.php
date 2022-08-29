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
        <form action="result.php" method="POST">
            <div id="boxSearchInt">
                <h1>Chercher une intervention</h1>
                <select name="tacheToSearch" id="tacheToSearch" >
                    <option value=""></option>
                    <?php  recupTache();?>
                </select>
                <input type="date" name="dateToSearch" id="dateToSearch" >
                <input type="number" name="floorToSearch" id="floorToSearch" >
                
                <input id="inSearch" type="submit" name="action" value="Chercher">
            </div>
        </form>
        <div class="linkInt">
            <a href="index.php">Accueil</a>
        </div>
    </main>
</body>
</html>