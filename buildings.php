
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buildings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into buildings (name) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['bName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Building added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update buildings set name=? where buildingid=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['bName'], $_POST['bid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Building edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from buildings where buildingid=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['bid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Building deleted.</div>';
      break;
  }
}
?>
    
      <h1>Instructors</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>BuildingID</th>
            <th>Name</th>
           <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
<?php
$sql = "SELECT buildingid,name from buildings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["buildingid"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editBuilding<?=$row["name"]?>">
                Edit
              </button>
              <div class="modal fade" id="editBuilding<?=$row["buildingid"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBuilding<?=$row["buildingid"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editBuilding<?=$row["buildingid"]?>Label">Edit Building</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editBuilding<?=$row["buildingid"]?>name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editBuilding<?=$row["buildingid"]?>Name" aria-describedby="editBuilding<?=$row["buildingid"]?>Help" name="bName" value="<?=$row['buildingid']?>">
                          <div id="editBuilding<?=$row["buildingid"]?>Help" class="form-text">Enter the building name.</div>
                        </div>
                        <input type="hidden" name="bid" value="<?=$row['buildingid']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="iid" value="<?=$row["instructor_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
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
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBuilding">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addBuilding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBuildingLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addBuildingLabel">Add Building</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="buildingName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="buildingName" aria-describedby="nameHelp" name="bName">
                  <div id="nameHelp" class="form-text">Enter the building name.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
