<?php
session_start();
require_once "database.php";
$date = date("Y/m/d");
$sql = "DELETE FROM grade WHERE grade_id = '$_SESSION[grade]'";
if ($conn->query($sql) === TRUE) {
    header("Location: ../pages/class_grades.php");
    die();
}  
else
    {
        die("Something went wrong");
    }
?>