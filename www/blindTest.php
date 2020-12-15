<?php
include "./game/database.php";
include "./game/game.php";

function createLocalPlayer($name, $pp, $uid){
    include "./game/database.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO weponies_song_scoreboard(namePlayer, ppPlayer, pointPlayer, pass) VALUES ('$name', $pp, 0, '$uid')";

//        $conn->query($sql);
    $conn->query($sql);
    $conn->close();
}

$tab = array();
if(!isset($_POST["form"])) {
    if (!isset($_COOKIE['pseudo']) || !isset($_COOKIE['pp'])) {
        echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./gameSelection.php";}, 1);</script>';
    } else {
        $tab['pseudo'] = $_COOKIE['pseudo'];
        $tab['pp'] = $_COOKIE['pp'];
    }
} else {
    $tab = $_POST["form"];
    $tab['uid'] = "" .generateAnUniqueID();
    setcookie('pseudo', $tab['pseudo'], time() + 3600, null, null, false, true);
    setcookie('pp', $tab['pp'], time() + 3600, null, null, false, true);
    setcookie('uid', $tab['uid'], time() + 3600, null, null, false, true);
    createLocalPlayer($tab['pseudo'], $tab['pp'], $tab['uid']);
}



?>
<!--
 * @ Author: JunkJumper
 * @ Link: https://github.com/JunkJumper
 * @ Copyright: Creative Common 4.0 (CC BY 4.0)
 * @ Create Time: 21-10-2020 09:19:53
 * @ Modified by: JunkJumper
 * @ Modified time: 21-10-2020 11:10:08
-->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>WePonies Event</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mobile.css">
    <script type='text/javascript' src='js/mobile.js'></script>
</head>

<body>
    <div id="header">
        <h1>
            <a href="index.html">
                <img src="images/WPEbanner.png" alt="WEponies Event Banner" />
            </a>
        </h1>
        <ul id="navigation">
            <li>
                <a href="index.html">Accueil</a>
            </li>
            <li>
                <a href="#" class="current">Jeux WePonies</a>
                <ul>
                    <li>
                        <a href="blindTest.php">Blind test</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="about.html">À propos</a>
            </li>
            <li>
                <a href="https://www.weponies.fr/">Retourner au site principal</a>
            </li>
        </ul>
    </div>
    <div id="body">
        <h2>Blind Test Inversé</h2>
        <div class="content">
            <?php
                echo '<p>Bonjour <u><b>' .$tab['pseudo'] .'</b></u>, merci de patienter en attendant que la partie démarre. Pour rappel, tu as choisis cette image de profil pour cette partie :</p><br />';
                echo '<img src="admin/images/SnowPearlPP/' .$tab['pp'] .'.png" witdth="800px" />'
            ?>
            <p>Attends que l'hote de la partie t'invite à suivre ce lien :</p>
            <a href="./blindTestGame.php"><input type="submit" value="Jouer" /></a>
        </div>
    </div>
        <div id="footer">
            <p style="color:white;text-align: center;">
                <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">
                    <img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" />
                </a> This page is available under the terms of the
                <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" style="color:white"> Creative Commons Attribution 4.0 International License</a>.</p>
        </div>
</body>
</html>