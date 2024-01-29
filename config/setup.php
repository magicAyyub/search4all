<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
</head>
<body>
    <div class="container set">
        <div class="setup">
            <h1>Premiers pas</h1>
            <p>Avant de procéder à la recherche, Rendez-vous dans votre explorateur de fichier, choisissez le dossier principale de recherche puis copiez le chemin d'accès.</p>
            <form action="save_config.php" method="post">
                <div class="group">
                    <label for="rootFolder">Dossier racine </label>
                    <input type="text" id="rootFolder" name="rootFolder" placeholder="C:\Users\john\documents" required>
                </div>
               
                <button type="submit">Sauvegarder</button>
            </form>
        </div>
    </div>
</body>
</html>

