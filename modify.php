<?php include('index.php');?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Modifier une entrée</title>
</head>
<body>
    <form action="connect.php" method="POST">
        <select name="tacheToReplace" id="tacheToReplace">
            <option value=""></option>
            <?php retrieveTache();?>
        </select>
        <input type="date" name="dateToReplace" id="dateToReplace">
        <input type="number" name="floorToReplace" id="floorToReplace">
        <input type="hidden" name="idHiddenToReplace" value="<?php echo $_POST['IDToSendForReplace']?>">
        <input type="submit" name="action" value="Modifier">
    </form>
</body>
</html>