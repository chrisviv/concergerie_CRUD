<?php session_start();

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
function recupTache(){
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
        $str = connect()->prepare("UPDATE concierge SET date_intervention= :date ,etage_intervention= :etage ,ID_taches= :idTache WHERE id_intervention= :idInter");
        $str->bindParam(':date', $_POST['dateToReplace']);
        $str->bindParam(':etage', $_POST['floorToReplace']);
        $str->bindParam(':idTache', $_POST['tacheToReplace']);
        $str->bindParam('idInter',$_POST['idHiddenToReplace'] );
        $str->execute();
        header('Location: maintenance.php');
    } catch (PDOException $th) {
        echo $th;
    }
}
function deleteMaintien(){
    $query= connect()->prepare("DELETE FROM concierge WHERE id_intervention=:idToDelete;");
    $query->bindParam(':idToDelete', $_POST['IDToSendForDelete']);
    $query->execute();
    header('Location: maintenance.php');
    // echo 'Données supprimées';
}
function recup(){
    try {
        $str = connect()->prepare("SELECT concierge.ID_intervention, concierge.date_intervention,taches.Nom_taches,concierge.etage_intervention FROM concierge INNER JOIN taches ON concierge.ID_taches = taches.ID_taches ORDER BY date_intervention DESC ;");
        $str->execute();
        $return = $str->fetchAll();
        for ($i=0; $i < count($return); $i++) {
            $index = strval($i);
            echo '<tr class="TtrCustumers"><td class="tdCustumers">'.$return[$index]['date_intervention'].'</td><td>'.$return[$index]['Nom_taches'].'</td><td>'.$return[$index]['etage_intervention'].'</td><td><form action="modify.php" method="post"><input type="hidden" name="IDToSendForReplace" value="'.$return[$index]['ID_intervention'].'"><input type="submit" value="Modifier" id="inModifMaintien"></form></td><td><form action="" method="post"><input type="hidden" name="IDToSendForDelete" value="'.$return[$index]['ID_intervention'].'"><input type="submit" name="action" value="Supprimer" id="inSupMaintien"></form></td></tr>';
        }
    } catch (PDOException $th) {
        echo $th;
    }
}
function searchInt(){
    try {
        $_SESSION['controleMulti'] = 0;
        $query = "SELECT concierge.ID_intervention,concierge.date_intervention,taches.Nom_taches,concierge.etage_intervention,users.name_user FROM concierge INNER JOIN taches ON concierge.ID_taches = taches.ID_taches INNER JOIN users ON concierge.id_user = users.id_user  WHERE ";
        if(($_POST['tacheToSearch']!=""&& $_POST['dateToSearch']!="")||($_POST['tacheToSearch']!=""&& $_POST['floorToSearch'])||($_POST['floorToSearch']!=""&& $_POST['dateToSearch'])){
            $_SESSION['controleMulti'] = 1;
        }
        if ($_POST['tacheToSearch']!="") {
            $retourForPrep = $_POST['tacheToSearch'];
            $query .= "taches.ID_taches = $retourForPrep";
        }
        if($_POST['dateToSearch']!=""){
            if ($_SESSION['controleMulti'] = 1 && $_POST['tacheToSearch'] !="") {
                $query .= " AND ";
            }
            $query .= "concierge.date_intervention = :test";
        }
        if ($_POST['floorToSearch']!="") {
            $retourForPrep = $_POST['floorToSearch'];
            if ($_SESSION['controleMulti'] = 1 && ($_POST['tacheToSearch'] !=""||$_POST['dateToSearch']!="")) {
                $query .= " AND ";
            }
            $query .= "concierge.etage_intervention = $retourForPrep";
        }
        $str = connect()->prepare($query);
        if($_POST['dateToSearch']!=""){
            $str->bindParam(':test', $_POST['dateToSearch']);
        }
        $str->execute();
        $return = $str->fetchAll();
        for ($i=0; $i < count($return); $i++) {
             $index = strval($i);
            echo '<p class="searchInt"> L\'intervention de '.$return[$index]['Nom_taches'].' a été réalisé le '.$return[$index]['date_intervention']." à l'étage N° ".$return[$index]['etage_intervention']." par Mr ".$return[$index]['name_user'].'</p>';
            echo '<form action="search.php"><input type="hidden" name="IDToSendForSearch" value="'.$return[$index]['ID_intervention'].'">';
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
if(isset($_POST['action']) && $_POST['action']=="Modifier"){
    modifyMaintien();
}
if(isset($_POST['action']) && $_POST['action']=="Supprimer"){
    deleteMaintien();
}
?>