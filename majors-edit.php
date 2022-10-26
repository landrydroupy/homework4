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

$sql = "SELECT majorid,majorName from majorss where majorid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['mid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="majors-edit-save.php">
  <div class="mb-3">
    <label for="majorName" class="form-label">Major Name</label>
    <input type="text" class="form-control" id="instructorName" aria-describedby="nameHelp" name="mName" value="<?=$row['majorName']?>">
    <div id="nameHelp" class="form-text">Enter the Major's name.</div>
  </div>
  <input type="hidden" name="mid" value="<?=$row['majorid']?>">
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
