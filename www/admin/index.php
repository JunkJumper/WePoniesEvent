<!--
 * @ Author: JunkJumper
 * @ Link: https://github.com/JunkJumper
 * @ Copyright: Creative Common 4.0 (CC BY 4.0)
 * @ Create Time: 06-10-2020 21:25:12
 * @ Modified by: JunkJumper
 * @ Modified time: 17-10-2020 21:59:30
-->

<?php

$tabQuestionsTxt = readTxt();
(int) $CURRENTQUESTION = getCurrentQuestionValue();
$display = $tabQuestionsTxt[$CURRENTQUESTION];
$listQ = array();

for ($i=0; $i < 11; $i++) { 
    $listQ[$i] = $tabQuestionsTxt[$i];
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
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        
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
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        
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
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./index.php";}, 1);</script>';
} else if(isset($_GET['medium'])) {
    printQuestions(generateQuestion("m"));
    resetCurrentQuestionValue();
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./index.php";}, 1);</script>';
} else if(isset($_GET['hard'])) {
    printQuestions(generateQuestion("h"));
    resetCurrentQuestionValue();
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./index.php";}, 1);</script>';
}

if(isset($_GET['next'])) {
    updateCurrentQuestionValue(getCurrentQuestionValue()+1);
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./index.php";}, 1);</script>';
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
                        <a href="./index.php"><img src="./images/WPbanner.png" alt="WP banner" class="aligncenter" /></a>
                    </center>
                </div>
                <!--heder end here-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a> <i class="fa fa-angle-right"></i></li>
                </ol>
                <!--photoday-section-->

                <div class="breadcrumb text-center">
                    <h2><?php echo $listQ[$CURRENTQUESTION][1]?></h5>
                        <p style="font-size: 1.3em;"><?php echo "S<b>" .$listQ[$CURRENTQUESTION][2] ."</b> - E<b>" .$listQ[$CURRENTQUESTION][3] ."</b> : <i>" .$listQ[$CURRENTQUESTION][0] ."</i>"?></p>
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
                                        <a href="./index.php?easy"><div class="bg-success dark pv20 text-white fw600 text-center hvr-icon-spin col-5">&nbsp; &nbsp; Générer des nouvelles questions EASY</div></a>
                                        <a href="./index.php?medium"><div class="bg-primary dark pv20 text-white fw600 text-center hvr-icon-spin col-5">&nbsp; &nbsp; Générer des nouvelles questions MEDIUM</div></a>
                                        <a href="./index.php?hard"><div class="bg-warning dark pv20 text-white fw600 text-center hvr-icon-spin col-5">&nbsp; &nbsp; Générer des nouvelles questions HARD</div></a>

                                        <?php
                                            if($CURRENTQUESTION<10) {
                                                if(isset($_GET['next'])) {
                                                    echo '<a href="./index.php?n"><div class="bg-system dark pv20 text-white fw600 text-center hvr-icon-float col-21">&nbsp; &nbsp; Envoyer question suivante</div></a>';
                                                } else {
                                                    echo '<a href="./index.php?next"><div class="bg-system dark pv20 text-white fw600 text-center hvr-icon-float col-21">&nbsp; &nbsp; Envoyer question suivante</div></a>';
                                                }
                                            }
                                            
                                        ?>
                                    </div>
                                </div>
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
                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/0.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J1</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J2</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/2.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J3</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/3.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J4</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/4.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J5</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/5.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J6</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/6.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J7</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/7.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J8</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/8.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J9</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <img class="lg-item-img" src="./images/SnowPearlPP/9.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-left">
                                                <div class="lg-item-heading">J10</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="lg-item-heading">X pts</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--End List-->

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
                                                echo "<li style=\"color: #617eff;\">S<b>" .$listQ[$i][2] ."</b> - E<b>" .$listQ[$i][3] ."</b> : <i>".$listQ[$i][0] ."</i></li>";
                                            } else {
                                                echo "<li>S<b>" .$listQ[$i][2] ."</b> - E<b>" .$listQ[$i][3] ."</b> : <i>".$listQ[$i][0] ."</i></li>";
                                            }
                                        }
                                    ?>
                                </ol>

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
                    <li><a href="./index.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>
                    <li id="menu-academico"><a href="errorpage.html"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><span>Déconnexion</span><div class="clearfix"></div></a></li>
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
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                    period: '2014 Q1',
                    iphone: 2668,
                    ipad: null,
                    itouch: 2649
                }, {
                    period: '2014 Q2',
                    iphone: 15780,
                    ipad: 13799,
                    itouch: 12051
                }, {
                    period: '2014 Q3',
                    iphone: 12920,
                    ipad: 10975,
                    itouch: 9910
                }, {
                    period: '2014 Q4',
                    iphone: 8770,
                    ipad: 6600,
                    itouch: 6695
                }, {
                    period: '2015 Q1',
                    iphone: 10820,
                    ipad: 10924,
                    itouch: 12300
                }, {
                    period: '2015 Q2',
                    iphone: 9680,
                    ipad: 9010,
                    itouch: 7891
                }, {
                    period: '2015 Q3',
                    iphone: 4830,
                    ipad: 3805,
                    itouch: 1598
                }, {
                    period: '2015 Q4',
                    iphone: 15083,
                    ipad: 8977,
                    itouch: 5185
                }, {
                    period: '2016 Q1',
                    iphone: 10697,
                    ipad: 4470,
                    itouch: 2038
                }, {
                    period: '2016 Q2',
                    iphone: 8442,
                    ipad: 5723,
                    itouch: 1801
                }],
                lineColors: ['#ff4a43', '#a2d200', '#22beef'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
</body>

</html>