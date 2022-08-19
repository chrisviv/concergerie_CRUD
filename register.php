
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_register.css">
    <title>Register</title>
</head>
<body>
    <main>
    <div id="containerReg">
        <form action="connect.php" method="post">
           <!-- zone de connextion -->

            <h1 class="boxRegister">Register</h1>
            <div>
                <label for="username">Nom:</label>
                <input type="text" name="username" id="username">

                <label for="name">Prénom:</label>
                <input type="text" name="name" id="name">
           
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password">
                           
                <input id='register' type="submit" name="action" value="register">Register</input>
                <a href="index.php">Login</a>
            </div>
        </form>
    </div>
    </main>
</body>
</html>
