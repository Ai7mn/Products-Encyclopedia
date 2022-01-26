<?php
require_once "pdo.php";
include_once "Nav.php";
?>

<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
<style type="text/css">
	p {
     width: 250px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
}


</style>
</head>
<body>

  <div class="row justify-content-center">
<?php
$sql = "SELECT Distinct product.product_id ,product.product_name , product.description, product_image.image_name , product_image.thumbnail
 FROM product LEFT JOIN product_image ON product.product_id = product_image.product_id";
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  if($row['thumbnail']==1 || !$row['image_name']){
echo "<div class='col-sm-3' style='padding-top: 20px;'><div class='card' style='width: 18rem;'>";
echo "<div class='cardheader'><div class='avatar'>";
echo "<img class='card-img-top' alt='Card image cap' src='media/";
echo $row['image_name'];
echo "'></div></div><hr><div class='card-body info'><div class='title'><a href='single.php?pro_id=".$row['product_id']."'>";
echo $row['product_name'];
echo "</a></div><div class='desc'><p>";
echo $row['description'];
echo "</p></div></div></div></div>";
}
}
echo "</div>";
?>
