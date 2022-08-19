<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_login.css">
    <title>Login</title>
</head>
<body>
<main>
    <div id="container">
        <!-- zone de connextion -->

        <form action="connect.php" method="post">
            <h1>Login</h1>

            <div>
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="username" id="username">
            
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password">
                   
                <input type="submit" name="action" value="login" id="submit">
                <a href="register.php">Register</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>