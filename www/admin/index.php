<?php
/**
 * @ Author: JunkJumper
 * @ Link: https://github.com/JunkJumper
 * @ Copyright: Creative Common 4.0 (CC BY 4.0)
 * @ Create Time: 19-10-2020 12:27:28
 * @ Modified by: JunkJumper
 * @ Modified time: 20-10-2020 16:50:21
 */

?>

<!DOCTYPE html>
<html lang="en" class="bg">
<head>
    <meta charset="UTF-8">
    <title>WP Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 40%;position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); padding: 10px;}
        img {filter: blur(4px);}
        html {margin: 0; height: 100%; overflow: hidden}
    </style>
</head>
<body>
    <img src="https://www.weponies.fr/images/wallapperSnowPearl.jpg" alt="WPbg" height="90%">
    <div class="wrapper">
        <h1 style="text-align :center;color:white">Login</h2>
        <?php
            if(isset($_GET['deco'])){
                $val = $_GET['deco'];
                if($val==1) {
                    echo "<p style='color:red'>Deconnexion Réussie !</p>";
                }
            }
        ?>
        <form action="check.php" method="post">
            <?php
                        if(isset($_GET['logout'])){
                            $val = $_GET['logout'];
                            if($val=="true")
                                echo "<p style='color:red'>Deconnexion Réussie</p>";
                        }
                        if(isset($_GET['erreur'])){
                            $err = $_GET['erreur'];
                            if($err==3) {
                                echo "<center><p style='color:red; font-size: 2em';>Cette page demande d'être connecté !</p></center>";
                            }
                        }
            ?>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required />
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required />
            </div>
            <div class="form-group">
                <center><input type="submit" id='submit' value='LOGIN' class="btn btn-primary" >
                    <?php
                        if(isset($_GET['erreur'])){
                            $err = $_GET['erreur'];
                            if($err==1 || $err==2){
                                echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                            }
                        }
                    ?>
                </center>
            </div>
        </form>
    </div>    
</body>
</html>