<?php
session_start();
$grade = $_POST["Grade"];
if($grade == null){
    $_SESSION["error"] = "You must input a new grade";
    header("Location: ../pages/class_grades.php");
    die();
}
require_once "database.php";
$date = date("Y/m/d");
$sql = "UPDATE grade SET grade=$grade WHERE grade_ID = '$_SESSION[grade]';";
if(mysqli_query($conn, $sql)){
    header("Location: ../pages/class_grades.php");
    die();
}
else
    {
        die("Something went wrong");
    }
?>