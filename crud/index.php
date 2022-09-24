<?php
$insert= false;
// Connecting to database
$servername= "localhost";
$username= "root";
$password= "";
$database= "notes";
//Create a connection
$conn= mysqli_connect($servername, $username, $password, $database);
if(!$conn){
  die("Sorry we are failed:".mysqli_connect_error() );
}
  if  ($_SERVER['REQUEST_METHOD']=='POST'){
    $title= $_POST["title"];
    $description=$_POST["description"];
    
    //sql query to be executed
$sql = "INSERT INTO `notes` ( `title`, `description`) VALUES ( '$title', '$description' )";
$result= mysqli_query($conn, $sql);
// Check for the table creation 
if($result){
    //echo "The record has been inserted successfully! <br>";
    $insert=true;
}
else{
    //echo "The record has not been inserted successfully!";
    
}

  }

  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Php Crud</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> 
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php
if($insert){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Your note is inserted successfully!</strong> 
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
?>
<div class="container my-4">
<form action="/crud/index.php" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Note Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
  <label for="description" class="form-label">Note Description</label>
  <textarea class="form-control" id="description" name="description" rows="3"></textarea>
</div>
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>
<div class="container">
  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $sql ="SELECT * FROM `notes`";
  $result= mysqli_query($conn, $sql);
  $sno=0;
  while($row= mysqli_fetch_assoc($result)){
    $sno=$sno + 1;
    echo "  <tr>
    <th scope='row'>".$sno."</th>
    <td>".$row['title']."</td>
    <td>".$row['description']."</td>
    <td><button class='edit btn btn-sm btn-primary'>Edit</button> <a href='/del'>delete</a></td>
  </tr>";
}

  ?>
  </tbody>
</table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
