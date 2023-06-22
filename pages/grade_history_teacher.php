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
    <th>Grade_ID</th>
    <th>Previous_Grade</th>
    <th>New_Grade</th>
    <th>Date</th>
  </tr>

<?php
  $email = $_SESSION["email"];
  require_once "../scripts/database.php";
  $sql = "SELECT * FROM teacher t RIGHT JOIN subject s on t.teacher_ID=s.teacher_ID RIGHT JOIN grade g on g.subject_ID=s.subject_ID RIGHT JOIN grade_history gh on gh.grade_ID=g.grade_ID WHERE t.email='$email';";
  $result = $conn->query($sql);
  while($user = $result->fetch_assoc()){
    echo <<< TABLEUSERS
      <tr>
        <td>$user[grade_ID]</td>
        <td>$user[previous_grade]</td>
        <td>$user[new_grade]</td>
        <td>$user[date]</td>
      </tr>
      
TABLEUSERS;
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