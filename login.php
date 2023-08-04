<?php
session_start();

include 'connection.php';

if(isset($_POST['login'])){
    extract($_POST);
    // echo '<pre/>';
    // print_r($_POST);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' && pwd = '$pwd'");
    if($query){
        if(mysqli_num_rows($query)>0){
            $row = mysqli_fetch_assoc($query);
            extract($row);
            if(isset($_POST['rem'])){
                setcookie("userid",$user_id, time() - 3600,"/");    
            }
            else{
                $_SESSION['userid']=$user_id;    
            }
            header('location:profile.php');
        }
        else{
            $message= "<div class= 'alert alert-danger'>Invalid Username or Password</div>";

        }
    }


}


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container w-50 mt-5 p-5">
        <h3 class="">Login Form</h3>
        <div>
            <?php
            if(isset($message) && !empty($message)){
                echo $message;
            }
            
            ?>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="pwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rem">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
            <button name="login" type="submit" class="btn btn-primary">Submit</button>
        </form>
       
    </div>

   
  </body>
</html>