<?php
require_once "pdo.php";
include_once "Nav.php";
if(!isset($_SESSION)){
  session_start();
}
$m='';
if(isset($_SESSION["username"])){
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $image = $_FILES['image']['name'];
  $target_dir = "media/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    $sql = "INSERT INTO product_image(product_id ,image_name, thumbnail) VALUES(:id, :name,:thum)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':id' => $_POST['prodcut'],
      ':name' => $image,
      ':thum' => $_POST['isThumbnail']));
      $_SESSION['success'] = 'Image Added';
      header( 'Location: staff.php' );
      return;
    }
    }
else {
header("location:login.php");
return;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>Add Image</title>
  </head>
  <body>
    <div class="container">

    <h3>Add Image</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <div class="form-group ">
                  <label for="prodcut">Prodcut:</label>
                  <select class="form-control" name="prodcut">
                    <?php
                    $sisql = "SELECT * FROM product";
                    $sistmt = $pdo->query($sisql);
                    while ($sirow = $sistmt->fetch(PDO::FETCH_ASSOC)){
                      echo "<option class='form-control' value='";
                      echo $sirow['product_id'];
                      echo "'>";
                      echo $sirow['product_name'];
                      echo "</option>";
                    }
                     ?>
                   </select>
                        </div>
                <div class="form-group ">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" >
                </div>

                <div class="form-group ">
                    <label for="thumbnail">Visibility:</label>
                        <select name="isThumbnail">
                          <option value="1">Thumbnail</option>
                          <option value="0">Not Thumbnail</option>
                        </select>
                </div>
                <div class="form-group">
                  <input type="submit" value="Add" name="Add" class="btn btn-warning">
                  <a href="staff.php">Cancel</a>
                </div>

        </form>
      </div>

  </body>
</html>
