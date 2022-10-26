<!doctype html>
<?php include("nav.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
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
      $sqlAdd = "insert into student (courseid,fname,lname,grade) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("issi", $_POST['sCourseID'],$_POST['sFname'],$_POST['sLname'],$_POST['sGrade']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Student added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update student set courseid=?,fname=?,lname=?,grade=? where studentid=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("issii", $_POST['sCourseID'],$_POST['sFname'],$_POST['sLname'],$_POST['sGrade'], $_POST['sid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Student edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from student where studentid=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['sid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Student deleted.</div>';
      break;
  }
}
?>
    
      <h1>Students</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>StudentID</th>
            <th>CourseID</th>
           <th>First Name</th>
            <th>Last name</th>
            <th>Grade</th>
            <th></th>
	          <th></th>
	          <th></th>
          </tr>
        </thead>
        <tbody>
          
<?php
$sql = "SELECT studentid,courseid,fname,lname,grade from student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
           <td><?=$row["studentid"]?></td>
            <td><?=$row["courseid"]?></td>
	     <td><?=$row["fname"]?></td>
	      <td><?=$row["lname"]?></td>
            <td><?=$row["grade"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editStudent<?=$row["studentid"]?>">
                Edit
              </button>
              <div class="modal fade" id="editStudent<?=$row["studentid"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStudent<?=$row["studentid"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editStudent<?=$row["studentid"]?>Label">Edit Student</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editStudent<?=$row["studentid"]?>name" class="form-label">CourseID</label>
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
                <input type="hidden" name="sid" value="<?=$row["studentid"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addStudentLabel">Add Student</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="studentCourseID" class="form-label">Course ID</label>
                  <input type="text" class="form-control" id="studentCourseID" aria-describedby="nameHelp" name="sCourseID">
                  <div id="nameHelp" class="form-text">Enter the student's CourseID.</div>
                  <label for="studentFname" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="studentFname" aria-describedby="nameHelp" name="sFname">
                  <div id="nameHelp" class="form-text">Enter the student's First Name.</div>
                  <label for="studentLname" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="studentLname" aria-describedby="nameHelp" name="sLname">
                  <div id="nameHelp" class="form-text">Enter the student's Last Name.</div>
                  <label for="studentGrade" class="form-label">Grade</label>
                  <input type="text" class="form-control" id="studentGrade" aria-describedby="nameHelp" name="sGrade">
                  <div id="nameHelp" class="form-text">Enter the student's Grade.</div>
		  
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
