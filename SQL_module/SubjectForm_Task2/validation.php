<?php
    
    include "./db_manipulation.php";

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
        
?>