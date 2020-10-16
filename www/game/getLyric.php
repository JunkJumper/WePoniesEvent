<?php
/**
 *  ----------------------------------------------------------------------------
 * | @author     JunkJumper                                                     |
 * | @copyright  2020 - JunkJumper                                              |
 * | @license    https://creativecommons.org/licenses/by/4.0/  License CC BY 4.0|
 * | @since      File available since 10/08/2019                                |
 *  ----------------------------------------------------------------------------
 */

function charAt($str, $pos) {
    return $str{$pos};
}

function generateUniqueID() : String {
    $letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    $id = "";
    
    for($i = 0; $i < 8; $i++) {
        if ($i < 4) {
            $id .= charAt($letters, rand(0, 52));
        } else {
            $id .= rand(0,9);
        }
    }

    return $id;
}

function getDifficulty($stringDiff) {
    $number = 0;
    switch ($stringDiff) {
        case "e":
            $number = 5;
            break;
        case "easy":
                $number = 5;
                break;
        case "m":
            $number = 3;
            break;
        case "medium":
            $number = 3;
            break;
        case "h":
            $number = 1;
            break;
        case "hard":
            $number = 1;
            break;
        default:
            # code...
            break;
    }
    return $number;
}

function getElementWithLyricTab() {
    $int = rand(1, 152);
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

function RandomQuote($element, $MAX) {
    $Lyric2return = "";
    $Lyric2Tab = explode("-a-", $element[1]);
    $getSizeOfLyric = sizeof($Lyric2Tab) - 1; // return the size of Lyrics String
    $lastIndexOfLyric = rand(0,$getSizeOfLyric); // return the last index of the lyric (ex 9)

    if ($lastIndexOfLyric <= $MAX) {
        $lastIndexOfLyric += $MAX;
    }
    $currentRandomLyric = $lastIndexOfLyric - $MAX;

    while ($currentRandomLyric < $lastIndexOfLyric) {
        if($currentRandomLyric >= $lastIndexOfLyric) {
            
        } else {
            $Lyric2return .= $Lyric2Tab[$currentRandomLyric] .".";
            $currentRandomLyric++;
        }
    }
    return utf8_decode($Lyric2return);
}

function fillRealQuestionTab(Array $initialArray, String $difficulty) {
    $tabToFill = array();
    $tabToFill[0] = $initialArray[0];                       //NameSong
    $tabToFill[1] = RandomQuote($initialArray, $difficulty);//Lyric
    $tabToFill[2] = $initialArray[2];                       //Season
    $tabToFill[3] = $initialArray[3];                       //Episode
    $tabToFill[4] = generateUniqueID();                         //Unique Question ID

    return $tabToFill;
}

$WriteLyric = fillRealQuestionTab(getElementWithLyricTab(), getDifficulty("easy"));

print_r($WriteLyric);

?>
