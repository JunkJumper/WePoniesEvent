<?php
include "../game/database.php";

$db = mysqli_connect($servername, $username, $password,$dbname) or die('could not connect to database');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = 'UPDATE weponies_song_users SET active=0 WHERE username="CONN"';
$conn->query($sql);
$conn->close();
echo '<script type="text/javascript">setTimeout(function () {window.location.href = "./index.php?logout=true";}, 1);</script>';
?>