<?php
include "../game/database.php";
$loginOK = 0;


if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db = mysqli_connect($servername, $username, $password,$dbname) or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $usernameForm = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $passwordForm = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM weponies_song_users where 
            username = '".$usernameForm."' and password = '".$passwordForm."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
            $_SESSION['username'] = $usernameForm;
            $loginOK = 1;

        }
        else
        {
           header('Location: index.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
    header('Location: index.php');
}
mysqli_close($db); // fermer la connexion

if($loginOK == 1) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = 'UPDATE weponies_song_users SET active=1 WHERE username="CONN"';
    $conn->query($sql);
    $conn->close();
    echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./admin.php";}, 1);</script>';

}

?>