<?php
include_once "Nav.php";
require_once "pdo.php";


if( isset($_GET['search-bar']) ){
    $name = addcslashes($_GET['search-bar'], '%');

    $sql = "SELECT Distinct product.product_name , product.description, product_image.image_name , product_image.thumbnail
     FROM product LEFT JOIN product_image ON product.product_id = product_image.product_id WHERE product.product_name LIKE :na";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':na' => "$name%"));


}

?>
<!DOCTYPE html>
<html>
<head>
<title>Search for <?php echo $name ?></title>
</head>
<body>
  <?php if( $stmt->rowCount() >  0){

  ?>
<table class="table">
   <thead>
     <th>Image</th>
     <th>Product Name</th>
   </thead>

    <tbody >
      <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      if($row['thumbnail']==1 || !$row['image_name']){
      ?>

      <tr>
        <td style ="width:100px; height:100px;">
              <img width="100" height="100" alt="Product image" src="media/<?= htmlentities($row['image_name']) ?>">
        </td>

        <td style=" padding-top: 40px;"> <a herf=""><?= htmlentities($row['product_name']) ?></a></td>

      </tr>

    </tbody>

    <?php
      }
    }
  }
    else{
      echo "There is no product with that name!";
    }

?>
 </table>
</body>
</html>
