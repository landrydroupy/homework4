<!doctype html>
<?php include("nav.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Course Gradebook</h1>
<table class="table table-striped">
  <thead>
    <tr>
     <th>First Name</th>
      <th>Last Name</th>
     <th>description</th>
      <th>prefix</th>
      <th>number</th>
      <th>grade</th>
 
    </tr>
  </thead>
  <tbody>
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

$cid = $_POST['id'];
//echo $cid;
$sql = "select fname, lname, grade,c.prefix, c.number, c.description from student s join course c on s.courseid = c.courseid where c.courseid=" . $cid;
//echo $sql;
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
     <td><?=$row["fname"]?></td>
     <td><?=$row["lname"]?></td>
    <td><?=$row["description"]?></td>
    <td><?=$row["prefix"]?></td>
    <td><?=$row["number"]?></td>
    <td><?=$row["grade"]?></td>
    <td>
      
    </td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
