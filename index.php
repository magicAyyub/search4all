<?php 
    if (!file_exists("./config/run.bat"))
        header("location: ./config/setup.php");
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

    <!-- search -->
    <div class="container">
        <div class="left">
            <div class="text">
                <h1>Evitez-vous les fouilles interminable dossier par dossier.</h1>
            </div>
            <div class="box">
                <form id="search-form">
                    <div class="input-box">
                        <input type="search" name="q" placeholder="Recherche..." id="search" required>
                        <button type="submit">
                            <ion-icon name="search-outline"></ion-icon>
                        </button>
                    </div>
                </form>
                <!-- serach result popup -->
                <div id="results-container" class="">
                    <h3>Resultats</h3>
                    <div class="files">
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <img src="images/cat.png" alt="">
        </div>
    </div>


    <!-- cdn for icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- cdn for popup -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main script for search -->
    <script src="js/main.js"></script>
</body>

</html>
