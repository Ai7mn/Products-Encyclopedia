<?php
require_once "pdo.php";

if(!isset($_SESSION)){
  session_start();
}

$staffId ='';

if(isset($_SESSION["username"])){
$staff = $_SESSION["username"];
$staffsql = "SELECT * FROM staff WHERE username = '$staff'";
$staffstmt = $pdo->query($staffsql);
    while ($staffrow = $staffstmt->fetch(PDO::FETCH_ASSOC)){
        $staffId = $staffrow['staff_id'];
      }
      if(isset($_POST['name']) && isset($_POST['description'])&& isset($_POST['color'])&& isset($_POST['size'])&& isset($_POST['material'])) {
        $sql = "INSERT INTO product(product_name ,description, added_on ,added_at ,color_id ,size_id,material_id,added_by) VALUES(:name, :description, :added_on , :added_at , :color_id ,:size_id ,:material_id ,:added_by)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':name' => $_POST['name'],
          ':description' => $_POST['description'],
          ':added_on' => date("Y-m-d"),
          ':added_at' => date("h:i:s"),
          ':color_id' =>  $_POST['color'],
          ':size_id' =>  $_POST['size'],
          ':material_id' => $_POST['material'],
          ':added_by' => $staffId));
          $_SESSION['success'] = 'Product Added';
          header( 'Location: staff.php' );
          return;
        }
      }
else {
  header("location:login.php");
  return;
}


   include_once "Nav.php"
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Item</title>


  </head>
<body>
    <div class="container">
        <h2 style="margin-top:20px;">Add Product</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group ">
                <label>Product name</label>
                <input type="text" name="name" class="form-control" >
            </div>

            <div class="form-group ">
                <label for="color">Color:</label>
                <select class="form-control" name="color">
                  <?php
                  $csql = "SELECT * FROM color";
                  $cstmt = $pdo->query($csql);
                  while ($crow = $cstmt->fetch(PDO::FETCH_ASSOC)){
                    echo "<option class='form-control' value='";
                    echo $crow['color_Id'];
                    echo "'>";
                    echo $crow['color'];
                    echo "</option>";
                  }
                   ?>
                 </select>
            </div>
            
            <div class="form-group ">
                <label for="size">Size:</label>
                <select class="form-control" name="size">
                  <?php
                  $sisql = "SELECT * FROM size";
                  $sistmt = $pdo->query($sisql);
                  while ($sirow = $sistmt->fetch(PDO::FETCH_ASSOC)){
                    echo "<option class='form-control' value='";
                    echo $sirow['size_id'];
                    echo "'>";
                    echo $sirow['size_title'];
                    echo "</option>";
                  }
                   ?>
                 </select>
            </div>

            <div class="form-group ">
                <label for="material">Material:</label>
                <select class="form-control" name="material">
                  <?php
                  $msql = "SELECT * FROM material";
                  $mstmt = $pdo->query($msql);
                  while ($mrow = $mstmt->fetch(PDO::FETCH_ASSOC)){
                    echo "<option class='form-control' value='";
                    echo $mrow['material_id'];
                    echo "'>";
                    echo $mrow['material_name'];
                    echo "</option>";
                  }
                   ?>
                 </select>
            </div>
             <div class="form-group ">
                <label>Description</label>
                <input type="textarea" name="description" class="form-control">
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="add">
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div>

        </form>

    </div>


</body>

</html>
