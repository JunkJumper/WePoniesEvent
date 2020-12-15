<?php
include "game/database.php";

function readTxt() : Array {
    $a = array();
    $pointer = fopen('./game/questions.txt', 'r');
    for ($i=0; $i < 11; $i++) {
        $a[$i] = explode(";", fgets($pointer));
    }
    return $a;
}

function getCurrentQuestionValue() : int {
    include "./game/database.php";
    (int) $ret = 0;

    try {
        // Connection MySQL.
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch(Exception $e) {
        // Si il y a une erreur, arret du script.
        die('Erreur : '.$e->getMessage());
    } // Récupération du contenu de la table "infos"

    $reponse = $bdd->query("SELECT value FROM weponies_song WHERE idValue = 1");
    $donnee = $reponse->fetch();
    $ret = $donnee[0];
    return $ret;
}

$tabQuestionsTxt = readTxt();
(int) $CURRENTQUESTION = getCurrentQuestionValue();
$display = $tabQuestionsTxt[$CURRENTQUESTION];
$listQ = array();

for ($i=0; $i < 11; $i++) {
    $listQ[$i] = $tabQuestionsTxt[$i];
}

$tab = $_COOKIE;
print_r($listQ);

?>

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
                    <h4 class="float-left"><?php echo ucfirst($tab['pseudo'])?></h4>
                    <img src="admin/images/SnowPearlPP/<?php echo $tab['pp']?>.png" width="200px" />
                    <h3>Quel est le titre de cette chanson :<br />«<b>
                        <?php echo $display[1] .'</b>»'?>
                    </h3>
                    <form action="./gamePointChecker.php" method="post" name="game">
                        <label for="name">Réponse : </label><br />
                        <input type="text" name="game[rep]" id="reponse"><br /><br />
                        <input type="submit" value="Envoyer" />
                    </form>
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
<script>

</script>
</html>