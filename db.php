<?php
function connexion_bdd(){
$db_username = 'root';
$db_password = '';
$db_name = 'users';
$db_host = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
    or die('Connexion impossible à la base de données');
    return $db;
}


?>