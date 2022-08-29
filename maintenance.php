<?php include('connect.php');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Maintenance</title>
</head>
<body id="maintenance">
    <main>
        <div id="boxContainer">
            <!-- zone de connextion -->
                <h1>Maintenance</h1>
                <table id="customers">
                    <thead>
                        <tr>
                            <th>Date d'intervention</th>
                            <th>Type d'interventon</th>
                            <th>Etage concerné</th>
                            <th>Modification</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <?php recup(); ?>
            </table>
            <div class="linkInt">
                    <a href="index.php">Ajouter</a>
                    <a href="search.php">Chercher</a>
            </div>
        </div>
    </main> 
</body>
</html>