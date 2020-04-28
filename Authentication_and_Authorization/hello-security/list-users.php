<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<a href="index.php"> Take me home, country roads ... </a> <br>
<?php

include "db-connection.php";

function checkIfRoleIsAdmin($email){
    
    $conn = openCon();

    $sql = "SELECT * from person where email = :email;";
    $resultSet = $conn->prepare($sql);

    $resultSet->bindParam(':email', $email);

    $resultSet->execute() or die("Failed to query from DB!");;
    $firstrow = $resultSet->fetch(PDO::FETCH_ASSOC);
    
    $admin = "admin";
    $role = $firstrow['role'];

    return strcmp($role, $admin);
}

session_start();

if (!isset($_SESSION["email"])) {
    die("Only authenticated users are allowed");
}

$email= $_SESSION["email"];
if (checkIfRoleIsAdmin($email)) {
    die("No permissions.");
}

$conn = openCon();
$sql = "SELECT * from person;";

$resultSet = $conn->prepare($sql);
$resultSet->execute() or die("Failed to list all users.");

echo("The users in the system are: <br>");
while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
    echo $row['email'] . " " . $row['firstname'] . " " . $row['role'];
    echo "<br>";
}
?>
</body>
</html>
