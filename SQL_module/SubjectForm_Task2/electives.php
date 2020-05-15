<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <title> Form task </title>

</head>

<body>

    <?php

        include "./validation.php";  

        $url = $_SERVER['REQUEST_URI'];

        $dirname = dirname($url);
        $id = basename($url);
        $patternBasename = '/^[1-9][0-9]*$/';

        //To prevent requests like /electives.php/1/2/3
        if (!preg_match($patternBasename, $id) || preg_match($patternBasename, basename($dirname))){           
            die("Incorrect URL.");
        }

        if(!checkIfIDExist($id)){
            die("Incorrect ID!");
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod == "GET") {
            printSubject($id);
        } 

        $updatedTitle = "updated_title";
        $updatedTeacher = "updated_teacher";
        $updatedDesctiption = "updated_description";

        if ($requestMethod == "POST") {
            
            validateField($updatedTitle, MAX_LENGTH_TITLE, $valid, $errors);
            validateField($updatedTeacher,MAX_LENGTH_LECTURER, $valid, $errors);  
            validateField($updatedDesctiption,MAX_LENGTH_DESCRIPTION, $valid, $errors);
    
            if(count($errors) == 0 ){
    
                $title = $_POST[$updatedTitle];
                $lecturer = $_POST[$updatedTeacher];
                $description = $_POST[$updatedDesctiption];
    
                updateTable($id,$title, $description, $lecturer);
            } else {
                echo "The data was not updated. Please fill in the fields in accordance with the following requirements: Subject - maximum of 128 characters, Lecturer - maximum of 128 characters, Description: maximum of 1024 characters.</br></br>";
                
            }

            printSubject($id);
        }
    ?>

    <form method="POST">
        <fieldset>

            <legend> Редактирай дисциплината </legend>

            <label for="updated_title"> Име на предмета: </label>
            <input type="text" id="updated_title" name="updated_title" required>
            <br>
            <label for="updated_teacher"> Преподавател: </label>
            <input type="text" id="updated_teacher" name="updated_teacher" required>
            <br>
            <label for="updated_description"> Описание: </label>
            <input type="text" id="updated_description" name="updated_description" required>
            <br>
            <br>
            <input type="submit" value="Submit">

        </fieldset>
    </form>
</body>

</html>