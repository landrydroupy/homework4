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

$sql = "SELECT courseid,prefix,number,description from course where courseid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['cid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="course-edit-save.php">
  <div class="mb-3">
    <label for="prefix" class="form-label">Prefix</label>
    <input type="text" class="form-control" id="Course" aria-describedby="nameHelp" name="cPrefix" value="<?=$row['prefix']?>">
    <div id="nameHelp" class="form-text">Enter the Course's prefix.</div>
    <label for="number" class="form-label">Number</label>
    <input type="text" class="form-control" id="Course" aria-describedby="nameHelp" name="cNumber" value="<?=$row['number']?>">
    <div id="nameHelp" class="form-text">Enter the Course's number.</div>
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="Course" aria-describedby="nameHelp" name="cDescription" value="<?=$row['description']?>">
    <div id="nameHelp" class="form-text">Enter the Course's prefix.</div>
  </div>
  <input type="hidden" name="cid" value="<?=$row['courseid']?>">
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
