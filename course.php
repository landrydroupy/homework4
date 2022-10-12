<!doctype html>
	<?php include("nav.php");?>
	<html lang="en">
	  <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Courses</title>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	  </head>
	 
	   
	  
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
      $sqlAdd = "insert into course (description) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['cDescription]);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Course added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update course set description=? where courseid=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['cDescription'], $_POST['cid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Course edited.</div>';
    case 'Delete':
      $sqlDelete = "delete from course where courseid=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['cid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Course deleted.</div>';
  }
}

?>
 <h1>Courses</h1>
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th>ID</th>
	      <th>Prefix</th>
	      <th>Number</th>
	      <th>Description</th>
	      <th></th>
	      <th></th>
	    </tr>
	  </thead>
	  <tbody>
		
<?php
$sql = "SELECT courseid,prefix,number,description from course";
$result = $conn->query($sql);		  
		  
	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["courseid"]?></td>
            <td><a href="instructor-section.php?id=<?=$row["instructor_id"]?>"><?=$row["instructor_name"]?></a></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCourse<?=$row["courseid"]?>">
                Edit
              </button>
              <div class="modal fade" id="editCourse<?=$row["courseid"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCourse<?=$row["courseid"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCourse<?=$row["courseid"]?>Label">Edit Course</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCourse<?=$row["courseid"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editCourse<?=$row["courseid"]?>Name" aria-describedby="editCourse<?=$row["courseid"]?>Help" name="cDescription" value="<?=$row['courseid']?>">
                          <div id="editCourse<?=$row["courseid"]?>Help" class="form-text">Enter the course's name.</div>
                        </div>
                        <input type="hidden" name="cid" value="<?=$row['courseid']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="cid" value="<?=$row["courseid"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <button type="submit" class="btn" onclick="return confirm('Are you sure?')">Delete</button>
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addInstructorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addCourseLabel">Add Course</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="courseDescription" class="form-label">Description</label>
                  <input type="text" class="form-control" id="courseDescription" aria-describedby="descHelp" name="cDescription">
                  <div id="descHelp" class="form-text">Enter the Course's description.</div>
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
