<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Building</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    
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

$sql = "delete from buildings where buildingid=?";
//echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_POST['bid']);
    $stmt->execute();
?>
    
    <h1>Delete Building</h1>
<div class="alert alert-success" role="alert">
  Instructor deleted.
</div>
    <a href="buildings.php" class="btn btn-primary">Go back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
