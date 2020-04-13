<?php

    Include "./db_manipulation.php";

    function validateField(String $text, int $size, &$valid, &$errors){
        $tmp = $_POST["$text"];
        if(!$tmp){
            $errors["$text"] = "Полето е задължително."; 
        } elseif(strlen($tmp) > $size ){
            $errors["$text"] = "Полето има максимална дължина $size символа.";
        } else {
            $valid[$text] = $tmp;
        }        
    }

    $valid = array();
    $errors = array();

    define("MAX_LENGTH_TITLE", 128);
    define("MAX_LENGTH_LECTURER", 128);
    define("MAX_LENGTH_DESCRIPTION", 1024);
    define("COUNT_FIELDS", 3);
    
    if( $_POST ){
        
        validateField('title', MAX_LENGTH_TITLE, $valid, $errors);
        validateField('teacher',MAX_LENGTH_LECTURER, $valid, $errors);

        validateField('description',MAX_LENGTH_DESCRIPTION, $valid, $errors);

        if(count($valid) == COUNT_FIELDS){

            $title = $_POST['title'];
            $lecturer = $_POST['teacher'];
            $description = $_POST['description'];

            insert($title, $description, $lecturer);
        } 
    }

?>