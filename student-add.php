<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Add Student</h1>
<form method="post" action="student-add-save.php">
  <div class="mb-3">
    <label for="studentCourseID" class="form-label">CourseID</label>
    <input type="text" class="form-control" id="studentCourseID" aria-describedby="nameHelp" name="sCourseID">
    <div id="nameHelp" class="form-text">Enter the student's CourseID</div>
    <label for="studentFname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="studentFname" aria-describedby="nameHelp" name="sFname">
    <div id="nameHelp" class="form-text">Enter the student's First Name</div>
    <label for="studentLname" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="studentLname" aria-describedby="nameHelp" name="sLname">
    <div id="nameHelp" class="form-text">Enter the student's Last Name</div>
    <label for="studentGrade" class="form-label">Grade</label>
    <input type="text" class="form-control" id="studentGrade" aria-describedby="nameHelp" name="sGrade">
    <div id="nameHelp" class="form-text">Enter the student's Grade</div>
     
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
