<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Add Major</h1>
<form method="post" action="course-add-save.php">
  <div class="mb-3">
    <label for="prefix" class="form-label">Prefix</label>
    <input type="text" class="form-control" id="majorName" aria-describedby="nameHelp" name="cPrefix">
    <div id="nameHelp" class="form-text">Enter the courses's prefix.</div>
     <label for="number" class="form-label">Number</label>
    <input type="text" class="form-control" id="majorName" aria-describedby="nameHelp" name="cNumber">
    <div id="nameHelp" class="form-text">Enter the course's number.</div>
     <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="majorName" aria-describedby="nameHelp" name="cDescription">
    <div id="nameHelp" class="form-text">Enter the course's description.</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
