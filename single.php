<?php
require_once "pdo.php";
include_once "Nav.php";
if(!isset($_SESSION)){
  session_start();
}
if (isset($_GET['pro_id'])) {
  $sql = "SELECT product.product_name , product.description,
     product_image.image_name , product_image.thumbnail , color.color , size.size_title ,
      material.material_name FROM product JOIN product_image JOIN color JOIN size JOIN material
       ON product.product_id = product_image.product_id and product.color_id = color.color_id and product.size_id = size.size_id
        and product.material_id = material.material_id where product.product_id = :pr_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":pr_id" => $_GET['pro_id']));
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Single</title>
  </head>
  <body>
    <div class="row" >
  <div class="col-sm-4">
   <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     ?>
      <img class="img-thumbnai"
      src="media/<?php echo $row['image_name']; ?>" alt="Card image cap" height="250px"/>

       <?php if($row['thumbnail']==1 || !$row['image_name']){
         if ( !isset ($_SESSION['log']) ) $_SESSION['log'] = Array();
         $_SESSION['log'] [] = array($row['product_name'], date("Y-m-d h:i:s"));

         ?>
         <br>
       </div>
         </div>
         <br>
         <hr>
      <div class="col-sm-4 pull-left">
        <h1><?php echo $row['product_name']; ?></h1>
      </div>

      <div class="col-sm-8">
       <hr>
      <h6> color: <?= htmlentities($row['color']) ?> </h6>
      <h6> size: <?= htmlentities($row['size_title']) ?></h6>
      <h6> material: <?= htmlentities($row['material_name']) ?></h6>
      <hr>
      <p><h4>Description :</h4> <?= htmlentities($row['description']) ?></p>
      </div>

           <?php
         }
          } ?>
      </div>

  </body>
</html>
