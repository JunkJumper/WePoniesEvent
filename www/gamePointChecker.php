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



?>
    <html>
    <head>
        <link href="css/gameCheck.css" rel="stylesheet">
        <script>
            setTimeout(function () {
                window.location.href = "index.php#disp-result";
            }, 5000);
        </script>
    </head>
    <body>
    <div id="mid-mid">
        <center>

            <div class="radial-timer s-animate">
                <div class="radial-timer-half"></div>
                <div class="radial-timer-half"></div>
            </div>
        </center>
    </div>
    </body>
    </html>