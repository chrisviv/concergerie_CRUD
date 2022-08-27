<?php
session_start();

function connect(){
    try {
        $db = new PDO('mysql:host=localhost;port=3307;dbname=conciergerie', 'root', '');
        // echo 'ok';
        return $db;
        }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function register(){
        $pass = password_hash("menard",  PASSWORD_ARGON2I);
        $login ="menard";
        $name = "Menard";

        $ajouter = connect()->prepare('INSERT INTO users (login_user, password_user, name_user ) VALUES (:login_user, :password_user, :name_user)');
        $ajouter->bindParam(':login_user', $login, 
        PDO::PARAM_STR);
        $ajouter->bindParam(':password_user', $pass,  
        PDO::PARAM_STR);
        $ajouter->bindParam(':name_user', $name,  
        PDO::PARAM_STR);
        $estceok = $ajouter->execute();
        $ajouter->debugDumpParams();
        if($estceok){
            header('Location: ./index.php');   
        } else {
            echo 'Error during registration';
        }
}
function login(){
    $findUser = connect()->prepare('SELECT * FROM users WHERE login_user = :login_user');
    $findUser->bindParam(':login_user', $_POST['username'], PDO::PARAM_STR);
    $findUser->execute();
    $user = $findUser->fetch();
 
    if ($user && password_verify($_POST['password'], $user['password_user'])) {
        $_SESSION['nom_user'] = $user['name_user'];
        $_SESSION['id_user'] = $user['id_user'];
        header('Location: ./index.php');  
        
    } else {
        echo 'Votre email ou votre mot de passe est incorrect !';
    }
}
function retrieveTache(){
    try {
        $str = connect()->prepare("SELECT * FROM taches");
        $str->execute();
        $return= $str->fetchAll();
        for ($i=0; $i < count($return) ; $i++) {
            $index = strval($i);
            echo '<option value="'.$return[$index]['ID_taches'].'">'.$return[$index]['Nom_taches'].'</option>';
        }
    } catch (PDOException $th) {
            echo $th;
    }
}
function addingType(){
    try {
        $str = connect()->prepare("INSERT INTO taches (Nom_taches) VALUES(?)");
        $str->execute(array(
            $_POST['type_intervention']));
    } catch (PDOException $th) {
        echo $th;
    }
}
function modifyMaintien(){
    try {
        $str = connect()->prepare("INSERT INTO concierge (date_intervention) VALUE(?)");
        $str->execute();
        $str->execute(array(
            $_POST['date_intervention']));
    } catch (PDOException $th) {
        echo $th;
    }
}
function deleteMaintien(){
    $query= connect()->prepare("DELETE FROM concierge WHERE id_intervention=:idToDelete;");
    $query->bindParam(':idToDelete', $_POST['IDToSendForDelete']);
    $query->execute();
    header('Location: maintenance.php');
}
function retrieve(){
    try {
        $str = connect()->prepare("SELECT concierge.ID_intervention,concierge.date_intervention,taches.Nom_taches,concierge.etage_intervention FROM concierge INNER JOIN taches ON concierge.ID_taches = taches.ID_taches ;");
        $str->execute();
        $return = $str->fetchAll();
        for ($i=0; $i < count($return); $i++) {
            $index = strval($i);
            echo '<tr><td>'.$return[$index]['date_intervention'].'</td><td>'.$return[$index]['Nom_taches'].'</td><td>'.$return[$index]['etage_intervention'].'</td><td><form action="modify.php" method="post"><input type="hidden" name="IDToSendForReplace" value="'.$return[$index]['ID_intervention'].'"><input type="submit" name="action" value="Modifier" class="bouton modif"></form></td><td><form action="" method="post"><input type="hidden" name="IDToSendForDelete" value="'.$return[$index]['ID_intervention'].'"><input type="submit" name="action" value="Supprimer" class="bouton sup"></form></td></tr>';
        }
    } catch (PDOException $th) {
        echo $th;
    }
}
if(isset($_POST['action']) && !empty($_POST['username'])  && !empty($_POST['name'])  && !empty($_POST['password'])  && $_POST['action']=="register"){
    register();
}
if(isset($_POST['action']) && !empty($_POST['username'])  && !empty($_POST['password'])  && $_POST['action']=="login"){
    login();
}
// if(isset($_POST['action']) && $_POST['action']=="Modifier"){
//     modifyMaintien();
// }
if(isset($_POST['action']) && $_POST['action']=="Supprimer"){
    deleteMaintien();
}
?>


