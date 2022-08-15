<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <title>Login</title>
</head>
<body>
<main>
    <div id="container">
        <!-- zone de connextion -->

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
    </div>
</main>
</body>
</html>