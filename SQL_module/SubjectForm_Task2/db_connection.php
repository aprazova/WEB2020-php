<?php
function dbConnection(){

    $host = "localhost";
    $dbname = "universitySystem";
    $username = "root";
    $pass = "";

    $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $pass);
    return $connection;
}
?>
