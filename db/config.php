<?php
$host = 'd138239.mysql.zonevs.eu'; 
$user = 'd138239sa545338';          
$password = 'Ilovetennis13!';  
$dbname = 'd138239sd598543';        

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse viga: " . $conn->connect_error);
} else {

}
?>
