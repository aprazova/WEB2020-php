<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<a href="index.php"> Take me home, country roads ... </a> <br>

<?php
include "db-connection.php";

function checkIfEmailExist($email){
  $conn = openCon();

  $sql = "SELECT * FROM person WHERE email = :email;";
  $preparedSql = $conn->prepare($sql);
  $preparedSql->bindParam(':email',$email);
  $preparedSql->execute() or die("Failed to check if email exist.");
  
  $result = $preparedSql->fetchAll();
  
  return count($result) !== 0;
}

$email = htmlentities($_POST["email"]);
$firstname = htmlentities($_POST["firstname"]);
$password = htmlentities($_POST["password"]);
$role = htmlentities($_POST["role"]);
 
if( !empty($email) && !empty($firstname) && !empty($password) && !empty($role)){

  $roles = array('teacher', 'student');
  if(in_array($role, $roles)){

    if(!checkIfEmailExist($email)){

      $conn = openCon();
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO person (email, firstname, password, role) VALUES (:email, :firstname, :hashedPassword, :role);";

      $preparedSql = $conn->prepare($sql) or die("Error description: " . $conn -> error);
      $preparedSql->bindParam(':email', $email);
      $preparedSql->bindParam(':firstname', $firstname);
      $preparedSql->bindParam(':hashedPassword', $hashedPassword);
      $preparedSql->bindParam(':role', $role);
      $preparedSql->execute() or die("Failed to query from DB!");

      echo("You are registered as: $email with role: $role");
    } else {
      echo("Invalid parameters.");
    }

  } else {
    echo("Not valid credentials.");
  }

} else {
  echo("Invalid parameters.");
}
?>
</body>
</html>

