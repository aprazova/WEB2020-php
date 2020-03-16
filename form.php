<?php

    function validateForm(String $text, int $size, &$valid, &$errors){
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
    
    if( $_POST ){
        
        $maxCountTitle = 150;
        $maxCountTeachet = 200;
        validateForm("title", $maxCountTitle, $valid, $errors);
        validateForm("teacher",$maxCountTeachet, $valid, $errors);

        $description = $_POST['description'];
        if(!$description){
            $errors['description'] = "Описанието е задължително."; 
        } elseif(strlen($description) < 10 ){
            $errors['description'] = "Описанието има минимална дължина 10 символа.";
        } else {
            $valid['description'] = $description;
        }

        $group = $_POST['group'];
        if(!$group){
            $errors['group'] = "Не сте избрали група.";
        } else {
            $valid['group'] = $group;
        }

        $credits = $_POST['credits'];
        if (!$credits){
            $errors['credits'] = "Не сте задали кредити.";
        } elseif($credits < 0 ){
            $errors['credits'] = "Кредити трябва да са положително число.";
        } else {
            $valid['credits'] = $credits;
        }

        $maxValidForms = 5;
        if(count($valid) == $maxValidForms ){

            $filename = 'results.txt';
            file_put_contents($filename, "Име на предмета: ", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, $_POST['title'], FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "Преподавател: ", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, $_POST['teacher'], FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "Описание: ", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, $description, FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "Група: ", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, $group , FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "Kредити: ", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, $credits, FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
            file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);

            echo "Thank you for your submission.";
        } else {
            echo "Тhere is a form with invalid content.";
        }
    }

?>
