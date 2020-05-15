<?php

    include "./validation.php";

    if( $_POST ){
    
        validateField('title', MAX_LENGTH_TITLE, $valid, $errors);
        validateField('teacher',MAX_LENGTH_LECTURER, $valid, $errors);
        validateField('description',MAX_LENGTH_DESCRIPTION, $valid, $errors);

        if(count($errors) == 0 ){

            $title = $_POST['title'];
            $lecturer = $_POST['teacher'];
            $description = $_POST['description'];

            insertInTable($title, $description, $lecturer);
            printContentOfTable();
        } else {
            echo "The data was not saved. Please fill in the fields in accordance with the following requirements: Subject - maximum of 128 characters, Lecturer - maximum of 128 characters, Description: maximum of 1024 characters.";
        }
    }

?>