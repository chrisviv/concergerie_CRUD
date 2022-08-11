<?php 
session_start();
if(isset($_SESSION['nom_user'])){
echo "Bienvenue ".$_SESSION['nom_user']." <a href='./logout.php'>Se déconnecter</a>";
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
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Concergerie d'un immeuble</title>
</head>
<body>
<main>
    <form action="connect.php" method="post">
        <h1>Login</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <section>
            <button type="submit" name="action" value="login">Login</button>
            <a href="register.php">Register</a>
        </section>
    </form>
</main>
</body>
</html>