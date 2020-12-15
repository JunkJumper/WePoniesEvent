<?php

/**
 * @ Author: JunkJumper
 * @ Link: https://github.com/JunkJumper
 * @ Copyright: Creative Common 4.0 (CC BY 4.0)
 * @ Create Time: 18-10-2020 19:40:45
 * @ Modified by: JunkJumper
 * @ Modified time: 19-10-2020 10:34:39
 */

function charAtpos($str, $pos) {
    $unString =$str;
    return $unString[$pos];
}

function generateAnUniqueID() : String {
    $letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    $id = "";
    
    for($i = 0; $i < 8; $i++) {
        if ($i < 4) {
            $id .= charAtPos($letters, rand(0, 52));
        } else {
            $id .= rand(0,9);
        }
    }
    return $id;
}

function createPlayer($name, $pp) : String {
    include "../game/database.php";
    $idr = "" .generateAnUniqueID();
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO weponies_song_scoreboard(namePlayer, ppPlayer, pointPlayer, pass) VALUES ('$name', $pp, 0, '$idr')";
        
//        $conn->query($sql);
        $conn->query($sql);
        $conn->close();

    return $idr;
}

function updateCurrentPlayerPP($pp, $pass) {
    include "../game/database.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "UPDATE weponies_song_scoreboard SET ppPlayer=" .$pp ." WHERE pass=" .$pass;
        
        $conn->query($sql);
        $conn->close();
}

function updateCurrentPlayerName($name, $pass) {
    include "../game/database.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "UPDATE weponies_song_scoreboard SET ppPlayer=" .$name ." WHERE pass=" .$pass;
        
        $conn->query($sql);
        $conn->close();
}

function resetPlayerList() {
    include "../game/database.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "TRUNCATE TABLE weponies_song_scoreboard";
        
        $conn->query($sql);
        $conn->close();
}

?>