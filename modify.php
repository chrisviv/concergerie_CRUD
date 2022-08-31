<?php include('connect.php');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" href="./css/style.css">
    <title>Modifier une intervention</title>
</head>
<body id="modifierInt">
    <main>
        <form action="connect.php" method="POST">
            <div id="boxModifyInt">
                <h1>Modifier une intervention</h1>
                <select name="tacheToReplace" id="tacheToReplace" required>
                    <option value=""></option>
                    <?php recupTache();?>
                </select>
                <input type="date" name="dateToReplace" id="dateToReplace" required>
                <input type="number" name="floorToReplace" id="floorToReplace" required>
                <input type="hidden" name="idHiddenToReplace" value="<?php echo $_POST['IDToSendForReplace']?>">
                <input id="inModify" type="submit" name="action" value="Modifier">
            </div>
        </form>
        <div class="linkInt">
            <a href="index.php">Accueil</a>
            <a href="search.php">Chercher</a>
        </div>
    </main>
</body>
</html>
