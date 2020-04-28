<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<a href="index.php"> Take me home, country roads ... </a> <br>
<?php

include "db-connection.php";

function getHashedPassword($conn, $email){

    $sqlQueryForPassword = "SELECT password FROM person WHERE email = :email;";

    $getHashedPassword = $conn->prepare($sqlQueryForPassword);
    $getHashedPassword->bindParam(':email', $email);
    $getHashedPassword->execute() or die ("Not valid credentials.");

    $result = $getHashedPassword->fetch(PDO::FETCH_BOTH);
    $hashedPassword = $result['password'];

    return $hashedPassword;
}

$conn = openCon();

$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);

$hashedPassword = getHashedPassword($conn, $email);

if (!isset($hashedPassword)) {
    die("Not valid credentials.");
}

if(password_verify($password, $hashedPassword)){

    $sql = "SELECT * from person WHERE email = :email;";

    $resultSet = $conn->prepare($sql);
    $resultSet->bindParam(':email', $email);
    $resultSet->execute() or die("Failed to query from DB!");
    $firstrow = $resultSet->fetch(PDO::FETCH_ASSOC) or die ("Not valid credentials.");

    echo("Hello " . $firstrow['firstname'] . " you are now logged in.");

    session_start();
    $_SESSION["email"] = $firstrow['email'];

} else {
    echo("Not valid credentials.");
}

?>
</body>
</html>
