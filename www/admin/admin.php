<!--
 * @ Author: JunkJumper
 * @ Link: https://github.com/JunkJumper
 * @ Copyright: Creative Common 4.0 (CC BY 4.0)
 * @ Create Time: 06-10-2020 21:25:12
 * @ Modified by: JunkJumper
 * @ Modified time: 20-10-2020 17:40:36
-->

<?php
if(!checkActive()) {
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./index.php?erreur=3";}, 1);</script>';
}

$tabQuestionsTxt = readTxt();
(int) $CURRENTQUESTION = getCurrentQuestionValue();
$display = $tabQuestionsTxt[$CURRENTQUESTION];
$listQ = array();
$scoreboard = getCurrentScoreboard(); //$listQ = idPlayer[0] | namePlayer[1] | ppPlayer[2] | pointPlayer[3]
$playerAmount = count($scoreboard);

for ($i=0; $i < 11; $i++) { 
    $listQ[$i] = $tabQuestionsTxt[$i];
}


function checkActive() : int {
    $a = array();
    include "../game/database.php";
    try {
        // Connection MySQL.
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch(Exception $e) {
        // Si il y a une erreur, arret du script.
        die('Erreur : '.$e->getMessage());
    } // Récupération du contenu de la table "infos"
    
    $reponse = $bdd->query("SELECT active FROM weponies_song_users WHERE username=\"CONN\"");
    $a = $reponse->fetch();

    return $a['active'];
}

function getCurrentScoreboard() : Array {
    include "../game/database.php";
    $a = array();
    try {
        // Connection MySQL.
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch(Exception $e) {
        // Si il y a une erreur, arret du script.
        die('Erreur : '.$e->getMessage());
    } // Récupération du contenu de la table "infos"
    
    $reponse = $bdd->query("SELECT * FROM weponies_song_scoreboard ORDER BY pointPlayer DESC");
    $a = $reponse->fetchAll();
    
    return $a;
}

function getCurrentQuestionValue() : int {
    include "../game/database.php";
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

function updateCurrentQuestionValue($val) {
    include "../game/database.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "UPDATE weponies_song SET value=" .$val ." WHERE idValue=1";
        
        $conn->query($sql);
        $conn->close();
}

function resetCurrentQuestionValue() {
    include "../game/database.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "UPDATE weponies_song SET value=1 WHERE idValue=1";
        $conn->query($sql);
        $conn->close();
}

function readTxt() : Array {
    $a = array();
    $pointer = fopen('../game/questions.txt', 'r');
    for ($i=0; $i < 11; $i++) { 
        $a[$i] = explode(";", fgets($pointer));
    }
    return $a;
}

include "../game/getLyric.php"; 

if(isset($_GET['easy'])) {
    printQuestions(generateQuestion("e"));
    resetCurrentQuestionValue();
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./admin.php";}, 1);</script>';
} else if(isset($_GET['medium'])) {
    printQuestions(generateQuestion("m"));
    resetCurrentQuestionValue();
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./admin.php";}, 1);</script>';
} else if(isset($_GET['hard'])) {
    printQuestions(generateQuestion("h"));
    resetCurrentQuestionValue();
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./admin.php";}, 1);</script>';
}

if(isset($_GET['next'])) {
    updateCurrentQuestionValue(getCurrentQuestionValue()+1);
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./admin.php";}, 1);</script>';
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>WePonies Web Games Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/morris.css" type="text/css" />
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- //jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body id="<?php echo $CURRENTQUESTION?>">
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="mother-grid-inner">
                <!--header start here-->
                <div class="header-main">
                    <center>
                        <a href="./admin.php"><img src="./images/WPbanner.png" alt="WP banner" class="aligncenter" width="40%"/></a>
                    </center>
                </div>
                <!--heder end here-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./admin.php">Home</a> <i class="fa fa-angle-right"></i></li>
                </ol>
                <!--photoday-section-->

                <div class="breadcrumb text-center">
                    <h3><?php echo $listQ[$CURRENTQUESTION][1]?></h5>
                        <?php
                            if($listQ[$CURRENTQUESTION][2] == 10 || $listQ[$CURRENTQUESTION][2] == 11 || $listQ[$CURRENTQUESTION][2] == 12 || $listQ[$CURRENTQUESTION][2] == 13 || $listQ[$CURRENTQUESTION][2] == 14) {
                                echo "<p style=\"font-size: 1.3em;\">Equestria Girls : <i>".$listQ[$CURRENTQUESTION][0] ."</i></p>";
                            } else if($listQ[$CURRENTQUESTION][2] == 15 || $listQ[$CURRENTQUESTION][2] == 16) {
                                echo "<p style=\"font-size: 1.3em;\">MLP Special : <i>".$listQ[$CURRENTQUESTION][0] ."</i></p>";
                            } else if($listQ[$CURRENTQUESTION][2] == 17) {
                                echo "<p style=\"font-size: 1.3em;\">MLP The Movie : <i>".$listQ[$CURRENTQUESTION][0] ."</i></p>";
                            } else {
                                echo '<p style="font-size: 1.3em;">S<b>' .$listQ[$CURRENTQUESTION][2] .'</b> - E<b>' .$listQ[$CURRENTQUESTION][3] .'</b> : <i>' .$listQ[$CURRENTQUESTION][0] .'</i></p>';
                            }
                        ?>
                </div>

                <div class="col-sm-4 wthree-crd">
                    <div class="card">
                        <div class="card-body">
                            <div class="widget widget-report-table">
                                <header class="widget-header m-b-15">
                                </header>

                                <div class="row m-0 md-bg-grey-100 p-l-20 p-r-20">
                                    <div class="col-md-12 col-sm-12 col-xs-12 w3layouts-aug text-center">
                                        <h3>Gestion du jeu</h3>
                                        <?php
                                            if($CURRENTQUESTION<10) {
                                                if(isset($_GET['next'])) {
                                                    echo '<a href="./admin.php?n"><div class="bg-system dark pv20 text-white fw600 text-center hvr-icon-float col-21">&nbsp; &nbsp; Envoyer question suivante</div></a>';
                                                } else {
                                                    echo '<a href="./admin.php?next"><div class="bg-system dark pv20 text-white fw600 text-center hvr-icon-float col-21">&nbsp; &nbsp; Envoyer question suivante</div></a>';
                                                }
                                            } else {
                                                echo '<a href="./admin.php?easy"><div class="bg-success dark pv20 text-white fw600 text-center hvr-icon-spin col-5">&nbsp; &nbsp; Générer des nouvelles questions EASY</div></a>';
                                                echo '<a href="./admin.php?medium"><div class="bg-primary dark pv20 text-white fw600 text-center hvr-icon-spin col-5">&nbsp; &nbsp; Générer des nouvelles questions MEDIUM</div></a>';
                                                echo '<a href="./admin.php?hard"><div class="bg-warning dark pv20 text-white fw600 text-center hvr-icon-spin col-5">&nbsp; &nbsp; Générer des nouvelles questions HARD</div></a>';
                                            }
                                            
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-sm-4 w3-agile-crd">
                    <div class="card">
                        <div class="card-body card-padding">
                            <div class="widget">
                                <header class="widget-header">
                                    <h4 class="widget-title text-center" id ="question">Questions :</h4>
                                </header>
                                <hr class="widget-separator">
                                <ol>
                                    <?php
                                        for ($i=1; $i < 11; $i++) { 
                                            if($CURRENTQUESTION == $i) {
                                                if($listQ[$i][2] == 10 || $listQ[$i][2] == 11 || $listQ[$i][2] == 12 || $listQ[$i][2] == 13 || $listQ[$i][2] == 14) {
                                                    echo "<li style=\"color: #617eff;\">Equestria Girls : <i>".$listQ[$i][0] ."</i></li>";
                                                } else if($listQ[$i][2] == 15 || $listQ[$i][2] == 16) {
                                                    echo "<li style=\"color: #617eff;\">MLP Special : <i>".$listQ[$i][0] ."</i></li>";
                                                } else if($listQ[$i][2] == 17) {
                                                    echo "<li style=\"color: #617eff;\">MLP The Movie : <i>".$listQ[$i][0] ."</i></li>";
                                                } else {
                                                    echo "<li style=\"color: #617eff;\">S<b>" .$listQ[$i][2] ."</b> - E<b>" .$listQ[$i][3] ."</b> : <i>".$listQ[$i][0] ."</i></li>";
                                                }
                                            } else {
                                                if($listQ[$i][2] == 10 || $listQ[$i][2] == 11 || $listQ[$i][2] == 12 || $listQ[$i][2] == 13 || $listQ[$i][2] == 14) {
                                                    echo "<li>Equestria Girls : <i>".$listQ[$i][0] ."</i></li>";
                                                } else if($listQ[$i][2] == 15 || $listQ[$i][2] == 16) {
                                                    echo "<li>MLP Special : <i>".$listQ[$i][0] ."</i></li>";
                                                } else if($listQ[$i][2] == 17) {
                                                    echo "<li>MLP The Movie : <i>".$listQ[$i][0] ."</i></li>";
                                                } else {
                                                    echo "<li>S<b>" .$listQ[$i][2] ."</b> - E<b>" .$listQ[$i][3] ."</b> : <i>".$listQ[$i][0] ."</i></li>";
                                                }
                                            }
                                        }
                                    ?>
                                </ol>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 w3-agileits-crd">

<div class="card card-contact-list">
    <div class="agileinfo-cdr">
        <div class="card-header text-center">
            <h3>Scores</h3>
        </div>
        <div class="card-body p-b-20">
            <div class="list-group center-block">
                <!-- List Begin -->

                <?php
                    if($playerAmount <= 0) {
                        echo "Il n'y a pas de joueurs dans cette partie";
                    } else {
                        for ($i=0; $i < $playerAmount; $i++) { 
                            echo '<div class="list-group-item media">
                                    <div class="pull-left">
                                        <img class="lg-item-img" src="./images/SnowPearlPP/' .$scoreboard[$i][2] .'.png" alt="PP player .' .$scoreboard[$i][1].'">
                                    </div>
                                    <div class="media-body">
                                        <div class="pull-left">
                                            <div class="lg-item-heading">' .$scoreboard[$i][1] .'</div>
                                        </div>
                                        <div class="pull-right">
                                            <div class="lg-item-heading">'.$scoreboard[$i][3] .' pts</div>
                                        </div>
                                    </div>
                                </div>';
                            }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</div>

                <div class="clearfix"></div>

                <!--//photoday-section-->

                <!-- script-for sticky-nav -->
                <script>
                    $(document).ready(function() {
                        var navoffeset = $(".header-main").offset().top;
                        $(window).scroll(function() {
                            var scrollpos = $(window).scrollTop();
                            if (scrollpos >= navoffeset) {
                                $(".header-main").addClass("fixed");
                            } else {
                                $(".header-main").removeClass("fixed");
                            }
                        });

                    });
                </script>
                <!-- /script-for sticky-nav -->
                <!--inner block start here-->
                <div class="inner-block">

                </div>
                <!--inner block end here-->
                <!--copy rights start here-->
                <div class="copyrights" style="background-color: #202020;">
                    <p style="color: #fcce09;">
                        <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">
                            <img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png">
                        </a> This page is available under the terms of the
                        <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" style="color:#617eff"> Creative Commons Attribution 4.0 International License</a>.</p>
                </div>
                <!--COPY rights end here-->
            </div>
        </div>
        <!--//content-inner-->
        <!--/sidebar-menu-->
        <div class="sidebar-menu">
            <header class="logo1" style="background: #fcce09;">
                <a href="#" class="sidebar-icon"> <span class="fa fa-bars" style="color: #617eff;"></span> </a>
            </header>
            <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
            <div class="menu">
                <ul id="menu">
                    <li><a href="./admin.php?easy"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Générer questions EASY</span><div class="clearfix"></div></a></li>
                    <li><a href="./admin.php?medium"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Générer questions MEDIUM</span><div class="clearfix"></div></a></li>
                    <li><a href="./admin.php?hard"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Générer questions HARD</span><div class="clearfix"></div></a></li>
                    <li><a href="./logout.php"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><span>Déconnexion</span><div class="clearfix"></div></a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function() {
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({
                    "position": "absolute"
                });
            } else {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function() {
                    $("#menu span").css({
                        "position": "relative"
                    });
                }, 400);
            }

            toggle = !toggle;
        });
    </script>
    <!--js -->
    <script src="js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- /Bootstrap Core JavaScript -->
    <!-- morris JavaScript -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.js"></script>

</body>

</html>