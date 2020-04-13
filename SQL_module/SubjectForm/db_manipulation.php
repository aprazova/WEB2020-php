<?php

function executeQuery($sql)
    {
        $host = "localhost";
        $dbname = "universitySystem";
        $username = "root";
        $pass = "";
        $table_name = "electives";

        try {
            $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $connection->query($sql);

            printContentOfTable($connection, $table_name);
        }
        catch(PDOException $error) {
            echo $error->getMessage();
        }
    }

    function insert($title, $description, $lecturer){
        executeQuery("INSERT INTO electives(title,description,lecturer) VALUES ('$title', '$description', '$lecturer')");
    }

    function printContentOfTable($connection, $table_name){
        $sql = "SELECT * FROM $table_name";
        $result = $connection->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row["id"] . "<br/>Title: " . $row["title"] . "<br/>Description: " . $row["description"] . "<br/>Lecturer: " . $row["lecturer"] . "<br/>Created_at: " . $row["created_at"] . "<br/><br/>";
        }
    }
?>
