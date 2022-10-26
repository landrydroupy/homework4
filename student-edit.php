<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Edit Course</h1>
<?php
$servername = "localhost";
$username = "landryou_user";
$password = "A2kYbmhiMHTE";
$dbname = "landryou_homework3data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT studentid,courseid,fname,lname,grade from course where studentid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['sid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="student-edit-save.php">
  <div class="mb-3">
    label for="editStudent<?=$row["studentid"]?>name" class="form-label">CourseID</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["studentid"]?>courseid" aria-describedby="editStudent<?=$row["studentid"]?>Help" name="sCourseID" value="<?=$row['courseid']?>">
                          <div id="editStudent<?=$row["studentid"]?>Help" class="form-text">Enter the Student's CourseID.</div>
                         <label for="editStudent<?=$row["studentid"]?>name" class="form-label">First Name</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["studentid"]?>fname" aria-describedby="editStudent<?=$row["studentid"]?>Help" name="sFname" value="<?=$row['fname']?>">
                          <div id="editStudent<?=$row["studentid"]?>Help" class="form-text">Enter the Student's First Name.</div>
                          <label for="editStudent<?=$row["studentid"]?>name" class="form-label">Last Name</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["studentid"]?>lname" aria-describedby="editStudent<?=$row["studentid"]?>Help" name="sLname" value="<?=$row['lname']?>">
                          <div id="editStudent<?=$row["studentid"]?>Help" class="form-text">Enter the Student's Last Name.</div>
                           <label for="editStudent<?=$row["studentid"]?>name" class="form-label">Grade</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["studentid"]?>grade" aria-describedby="editStudent<?=$row["studentid"]?>Help" name="sGrade" value="<?=$row['grade']?>">
                          <div id="editStudent<?=$row["studentid"]?>Help" class="form-text">Enter the Student's grade.</div>
  </div>
  <input type="hidden" name="sid" value="<?=$row['studentid']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
