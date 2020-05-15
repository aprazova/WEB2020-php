<?php

    include "./db_connection.php";

    function insertInTable($title, $description, $lecturer){
        try {

            $connection = dbConnection();
            $sql = "INSERT INTO electives(title,description,lecturer) VALUES (:title, :description, :lecturer)";
    
            $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
            $preparedSql->bindParam(':title', $title);
            $preparedSql->bindParam(':description', $description);
            $preparedSql->bindParam(':lecturer', $lecturer);
            
            $preparedSql->execute() or die("Failed to execute sql query."); 
            $connection = null;  
        }
        catch(PDOException $error) {
            echo ("Request processing failed.");
        }
    }

    function printContentOfTable(){
        
        $tableName = "electives";
        try {
            $connection = dbConnection();
            $sql = "SELECT * FROM $tableName";
            
            $result = $connection->prepare($sql) or die("Failed to prepare sql query.");
            $result->execute() or die("Failed to execute sql query.");
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "ID: " . $row["id"] . "<br/>Title: " . $row["title"] . "<br/>Description: " . $row["description"] . "<br/>Lecturer: " . $row["lecturer"] . "<br/>Created_at: " . $row["created_at"] . "<br/><br/>";
            }
            $connection = null;
        }
        catch(PDOException $error) {
            echo ("Request processing failed.");
        }
    }

    function printSubject($id){
        $tableName = "electives";
        try {
            $connection = dbConnection();
            $sql = "SELECT * FROM $tableName WHERE id = :id;";
            
            $result = $connection->prepare($sql) or die("Failed to prepare sql query.");
            $result->bindParam(':id', $id);
            $result->execute() or die("Failed to execute sql query.");
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "Subject ID: " . $row["id"] . "<br/>Title: " . $row["title"] . "<br/>Description: " . $row["description"] . "<br/>Lecturer: " . $row["lecturer"] . "<br/><br/>";
            }
            $connection = null;
        }
        catch(PDOException $error) {
            echo ("Request processing failed.");
        }
    }

    function checkIfIDExist($id){

        $tableName = "electives";

        $connection = dbConnection();
        $sql = "SELECT * FROM $tableName WHERE id = :id";

        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->bindParam(':id', $id);
        $preparedSql->execute() or die("Failed to execute sql query.");
        $result = $preparedSql->fetchAll();
        $connection = null;
        return count($result) !== 0;
    }

    function updateTable($id, $title, $description, $lecturer){

        if(!checkIfIDExist($id)){
            die("There is no subject with this ID.");
        }

        $tableName = "electives";

        try {
            $connection = dbConnection();
            $sql = "UPDATE $tableName SET title = :title, description = :description, lecturer = :lecturer WHERE id = :id";
    
            $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
            $preparedSql->bindParam(':id', $id);
            $preparedSql->bindParam(':title', $title);
            $preparedSql->bindParam(':description', $description);
            $preparedSql->bindParam(':lecturer', $lecturer);
            
            $preparedSql->execute() or die("Failed to execute sql query.");  
            $connection = null;  
        }
        catch(PDOException $error) {  
            echo ("Request processing failed.");
        }
    }
?>
