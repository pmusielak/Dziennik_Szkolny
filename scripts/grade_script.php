<?php
session_start();
$grade = $_POST["Grade"];
if($grade == null){
    $_SESSION["error"] = "You must input a grade";
    header("Location: ../pages/class_grades.php");
    die();
}
require_once "database.php";
$date = date("Y/m/d");
$sql = "INSERT INTO grade (student_ID, subject_ID, grade, date) VALUES (?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
$prepareSTMT = mysqli_stmt_prepare($stmt, $sql);
if ($prepareSTMT)
{
    mysqli_stmt_bind_param($stmt, "iiis", $_SESSION["student"], $_SESSION["subject"], $grade, $date);
    mysqli_stmt_execute($stmt);
    header("Location: ../pages/class_grades.php");
    die();
}
else
    {
        die("Something went wrong");
    }
?>