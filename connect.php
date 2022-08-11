<?php
session_start();
function connect(){
    try {
        $db = new PDO('mysql:host=localhost;port=3307;dbname=conciergerie', 'root', '');
        echo 'ok';
        return $db;
        }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
connect();

function register(){
        $pass = password_hash("menard",  PASSWORD_DEFAULT);
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
 
    //$user && password_verify($_POST['password'], $user['password_user'])
    //le mot de passe est alex
    //$user && password_verify(alex, $2y$10$6BcBM4oinhbyHIL09w.j/eIFwYkCc499VDIZIy7LJ1PRU4GO2ynQS])
    if ($user && password_verify($_POST['password'], $user['password_user'])) {
        $_SESSION['nom_user'] = $user['name_user']; 
        header('Location: ./index.php');  
        
    } else {
        echo 'Invalid username or password';
    }


}

if(isset($_POST['action']) && !empty($_POST['username'])  && !empty($_POST['password'])  && $_POST['action']=="register"){
    register();
}

if(isset($_POST['action']) && !empty($_POST['username'])  && !empty($_POST['password'])  && $_POST['action']=="login"){
    login();
}
   







?>


