<?php
include 'dbconnect.php';

session_start();

$sno = $_SESSION['sno'] ;
// echo $sno;
if (isset($_GET['sno'])) {
 	$sno = $_GET['sno'];
    // echo $sno;
}
else{
    echo"Error";
}    
    $Task = "SELECT Task_name FROM `task` WHERE `task`.`sno` = $sno";
    $Task_result = mysqli_query($conn,$Task);
    $Task_rows = mysqli_fetch_assoc($Task_result);
    $Task_name= implode("", $Task_rows);
    // echo $Task_name;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (empty($_POST['update_task'])) {
        $errors = "You must fill in the task";
       echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>'. $errors.'<strong>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       
       </div>';
    }
    else{
        $update_task = $_POST['update_task'];
        $sql= "UPDATE `task` SET `Task_name` = '$update_task' WHERE `task`.`sno` = $sno";        
        $result = mysqli_query($conn,$sql);
        if($result){
            // $rows = mysqli_fetch_assoc($result);
            // $new_task = implode("", $Task_rows);
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>'.$Task_name.' has been changed to '.$update_task.'  succesfully</p>
            <hr>
            <p class="mb-0">Whenever you need to add your work click <a href="http://localhost/todo/index.php">here</a>
            </p>
          </div>'; 
        }
        else{
            echo"Error";
        }   
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

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container my-4 col-md-6 ">
       <?php 
       echo '<form action="update.php?sno='.$sno.'" method="post"> 
       
            <h2>Update your '.$Task_name.'</h2>
            <input type="text" id="update_task" name="update_task" class="form-control" aria-describedby="passwordHelpBlock">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
        ?>
    </div>
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

 



