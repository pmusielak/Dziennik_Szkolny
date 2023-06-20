<?php
session_start();
if (!isset($_SESSION["user"]))
{
    header("Location: ../pages/login.php");
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/table.css">
  <title>Użytkownicy</title>
</head>
<body>
<h4>School Gradebook</h4>
<table>
  <tr>
    <th>Name</th>
    <th>Surname</th>
    <th>Grades</th>
  </tr>

<?php
  $email = $_SESSION["email"];
  $subject_ID = $_GET['subject_ID'];
  $_SESSION["subject"] = $subject_ID;
  require_once "../scripts/database.php";
  $sql = "SELECT * FROM subject s RIGHT JOIN class c on s.class_ID=c.class_ID RIGHT JOIN student s2 on c.class_ID=s2.class_ID WHERE s.subject_ID='$subject_ID';";
  $result = $conn->query($sql);
  while($user = $result->fetch_assoc()){
    $student_ID = $user['student_ID'];
    $sql = "SELECT * FROM grade g WHERE student_ID=$student_ID AND subject_ID='$subject_ID';";
    $result2 = $conn->query($sql);
    echo '<tr>';
    echo '<td>' . $user['name'] . '</td>';
    echo '<td>' . $user['surname'] . '</td>';
    echo  '<td>';
    while($grade = $result2->fetch_assoc()){
          echo $grade['grade'];
          echo '<p>'."   ".'</p>';
    }
    echo '</td>';
    echo "<td><a href='add_grade.php?student_ID=" . $user['student_ID'] . "'>" . "Add Grade" . '</a></td>';
    echo '<td>' . $user['student_ID'] . '</td>';
    echo '</tr>';
  }
  echo "</table>";
?>
<div class="container">
        <a href="../scripts/logout.php" class="btn btn-warning">Logout</a>
    </div>
<div class="container">
        <a href="teacher_index.php" class="btn btn-warning">Go Back</a>
    </div>
</body>
</html>