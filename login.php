<?php
include "Nav.php";
require_once("pdo.php");
if(!isset($_SESSION)){
  session_start();
}
if (isset($_SESSION['error'])){
  echo "<p style='color:red'>".$_SESSION['error']."</p>\n";
  unset($_SESSION['error']);
 }


try
{
     if(isset($_POST["login"]))
     {
          if(empty($_POST["username"]) || empty($_POST["password"]))
          {
               $_SESSION['error'] = 'All fields are required';
          }
          else
          {
               $query = "SELECT * FROM staff WHERE username = :username AND password = :password";
               $statement = $pdo->prepare($query);
               $statement->execute(
                    array(
                         'username'     =>     $_POST["username"],
                         'password'     =>     $_POST["password"]
                    )
               );
               $count = $statement->rowCount();
               if($count > 0)
               {
                    $_SESSION["username"] = $_POST["username"];
                    header("location:staff.php");
                    return;
               }
               else
               {
                    $_SESSION['error'] = 'Wrong Data';
               }
          }
     }
}
catch(PDOException $error)
{
     $_SESSION['error'] = $error->getMessage();
}
?>
<!DOCTYPE html>
<html>
     <head>
       <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Login</title>

     </head>
     <body>
          <br />
          <div class="container" style="width:500px;">

               <h3 align="" >Staff Login </h3><br />
               <form method="post">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" />
                    <br />
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" />
                    <br />
                    <input type="submit" name="login" class="btn btn-info" value="Login" />
               </form>
          </div>
          <br />
     </body>
</html>
