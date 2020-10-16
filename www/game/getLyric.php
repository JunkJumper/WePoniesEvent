<?php
/**
 *  ----------------------------------------------------------------------------
 * | @author     JunkJumper                                                     |
 * | @copyright  2029 - JunkJumper                                              |
 * | @license    https://creativecommons.org/licenses/by/4.0/  License CC BY 4.0|
 * | @since      File available since 10/08/2019                                |
 *  ----------------------------------------------------------------------------
 */

$randomQuoteID = rand(1, 152);

function getDifficulty($stringDiff) {
    $number = 0;
    switch ($stringDiff) {
        case "e":
            $number = 5;
            break;
        case "m":
            $number = 3;
            break;
        case "h":
            $number = 1;
            break;
        default:
            # code...
            break;
    }
    return $number;
}

function getElement($int) {
    include "database.php";
    $tabRet;
    try {
        // Connection MySQL.
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch(Exception $e) {
        // Si il y a une erreur, arret du script.
        die('Erreur : '.$e->getMessage());
    } // Récupération du contenu de la table "infos"
    
    $reponse = $bdd->query("SELECT * FROM $table WHERE idSong=$int");
    $donnee = $reponse->fetchAll();

    $tabRet[0] = $donnee[0][1];//NameSong
    $tabRet[1] = $donnee[0][2];//Lyric
    $tabRet[2] = $donnee[0][3];//Season
    $tabRet[3] = $donnee[0][4];//Episode

    return $tabRet;
}


$question = getElement($randomQuoteID);

print_r($question);

$tabLyrics = explode("-a-", $question[1]);
$MAX = sizeof($tabLyrics);
$currentI = rand(0,$MAX);

if(($currentI - $MAX) <= 0) {
    $currentI += $MAX;
}

echo $currentI;

echo $tabLyrics[$currentI];

$askLyric = "";

?>
