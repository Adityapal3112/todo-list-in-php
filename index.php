<?php
include 'dbconnect.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if (empty($_POST['task'])) {
    $errors = "You must fill in the task";
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>'. $errors.'<strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
    </div>';
    
  }
  else{
    $task = $_POST['task'];
    // echo $task;
      
    $sql ="INSERT INTO `task` (`sno`, `Task_name`) VALUES (NULL, '$task'); ";
    $result = mysqli_query($conn,$sql);
    header('location: index.php');
  }
    
       
  
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>To-Do List</title>
  </head>
  <body>
  <p class="text-center fs-1">To-Do List</p>
    <form action="http://localhost/todo/" method="post">
    <div class="container my-4 col-md-6">
        <input type="text" name="task" id="input" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Enter our Task">    
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Task</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $tasks = "SELECT * FROM `task`";
        $tasks_result = mysqli_query($conn,$tasks);
        if($tasks_result){
            session_start();
            $i = 1;
            while ($row = mysqli_fetch_array($tasks_result)){
                // echo $row['sno'];
                
                $_SESSION['Task_name'] = $row['Task_name'];
                $_SESSION['sno'] = $row['sno'];
                echo' 
                <tr>
                <th scope="row">'.$i.'</th>
                <td>' . $row['Task_name'] . '</td>
                <td>
                <a name="delete" class="delete" href="delete.php?sno='.$row['sno'].'">Delete</a>   
                <a name="update" class="update" href="update.php?sno='.$row['sno'].'" >Update</a> 
                </td>
                </tr>
                ';
              $i++  ;
                
            }
        }
        else{
            echo"there is a error";
        }

      
           
    ?>
<style>a:link {
  color: red;    
}
a.update{
color:orange;
}
<style>a:link {
  color: red;
}
/* visited link */
a {
  text-decoration: none;
  /* color: green; */
}

/* mouse over link */
a:hover {
  text-decoration: none;
  color: blue;
}

/* selected link */
a:active {
  text-decoration: none;
  
}


</style>
  </tbody>
</table>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>