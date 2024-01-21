<?php
session_start();
if(isset($_SESSION["is_setup"])){
    header("location: ./index.php");
}
function generateScriptFiles($rootFolder) {
    // Get the operating system
    $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

    // Generate start_server.bat for Windows
    if ($isWindows) {
        file_put_contents('run.bat', '@echo off
cd /d "' . $rootFolder . '"
start php -S localhost:8000
start "" "http://localhost:8000/index.php"');
    }

    // Generate start_server.sh for Unix-like systems
    else {
        file_put_contents('run.sh', '#!/bin/bash
cd "' . $rootFolder . '"
php -S localhost:8000 &
xdg-open "http://localhost:8000/index.php"');
    }
}

function setMessage($statut, $message) {
    if ($statut == 'e') {
        $_SESSION['error'] = $message;
    } else{
        $_SESSION['succes'] = $message;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search4all</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
</head>

<body>

    <div class="container">

        <?php 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $rootFolder = isset($_POST['rootFolder']) ? $_POST['rootFolder'] : '';

                if (!empty($rootFolder)) {
                    $config = [
                        'rootFolder' => $rootFolder,
                        'serverPath' => 'http://localhost:8000'  // to change
                    ];

                    file_put_contents('config.json', json_encode($config, JSON_PRETTY_PRINT));

                    generateScriptFiles($rootFolder);

                    echo '<div class="container set"><div class="setup"> <div class="message-box success"><h1>Configuration sauvegardé avec succès.</h1> <p>- Si vous êtes sur windows, un fichier .bat viens d\'être créer double cliquez dessus pour commencer.</p><p>- Si vous êtes sur Mac ou Linux, lancer le fichier .sh dans votre terminale.</p></div> </div></div>';
                    $_SESSION["is_setup"] = True;
                } else {
                    echo '<div class="container set"><div class="setup"> <div class="message-box erreur"><div class="message-box success"><h1>Erreur lors de la Configuration.</h1><p>Veuillez saisir un chemin d\'accès valide</p></div> </div></div>';
                }
            } else {
                echo '<div class="container set"><div class="setup"> <div class="message-box erreur">Une erreur est survenue, veuillez réessayer ultérieurement.</div> </div></div>';
            }
        ?>

    </div>
</body>
</html>

