<?php

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
</div>
<div id="body">
    <h2>Choix Pseudos/Images</h2>
    <p>Pour pouvoir joueur à notre jeu, merci de complêter le formumaire suivant :</p>
    <div class="content">
        <form action="./blindTest.php" method="post" name="form>
            <label for="name">Pseudo : </label><br />
            <input type="text" name="form[pseudo]" id="name" required><br /><br />
            <label for="name">Image de profil : </label><br />
            <?php
            for ($i = 0; $i < 10; ++$i) {
                echo '<input type="radio" name="form[pp]" value="' .$i .'"><img src="./admin/images/SnowPearlPP/' .$i .'.png" width="80px" />' .'&nbsp&nbsp&nbsp&nbsp&nbsp';
            }
            ?>
            <br /><br />
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

</html>