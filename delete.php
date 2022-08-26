<?php

include('connect.php');

if (isset($_POST)) {
    $rows = $pdo->exec("DELETE FROM `taches` WHERE `taches`. `ID_taches` = ". $_POST['ID_taches']);

    if ($rows > 0){
        header("Location:index.php");
    } else{
        echo 'error';
    }
}
?>