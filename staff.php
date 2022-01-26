<?php
require_once "pdo.php";
include_once "Nav.php";

if(!isset($_SESSION)){
  session_start();
}
if (isset($_SESSION['success'])){
  echo "<p style='color:green'>".$_SESSION['success']."</p>\n";
  unset($_SESSION['success']);
 }
 if (isset($_SESSION['error'])){
   echo "<p style='color:red'>".$_SESSION['error']."</p>\n";
   unset($_SESSION['error']);
  }



if(!isset($_SESSION["username"]))
{
  header("location:login.php");
  return;
}
else
{
  ?>
  <html lang="en">
   <meta charset="UTF-8">
      <title>Staff</title>

  <head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

  <style type="text/css">
  table{

  	border-width: 2px;
  	border-color: #ffffff;
  	border-collapse: collapse;
  	margin-top: 80px;
  	margin-right: 20px;
  	margin-left: 20px;
  	margin-bottom: 20px;

  }
  table th {
  	border-width: 2px;
  	padding: 8px;
  	border-style: solid;
  	border-color: #ffffff;
  	font: normal 36px 'Cookie', cursive;
  	color:  #e0ac1c;
  }
  table tr {
  	background-color:#333;
  }
  table td {
  	border-width: 2px;
  	padding: 8px;
  	border-style: solid;
  	border-color: #ffffff;
  	font-family: "Lucida Console", Courier, monospace;
  	font-size: 14px;
  	font-weight: bold;
  	color: #ffffff;
  }
  </style>


  </head>

  <body>
  	<div style=" padding-top: 20px; padding-left: 170px; padding-bottom: 20px;">
   </div>

  <table border='1' style=" width: 80%; margin: 0 auto; text-align: center;">

  <tr>


  <th>Image</th>

  <th>name</th>

  <th>Color</th>
  <th>Size</th>
  <th>material</th>
  <th>Process</th>



  </tr>

  <?php
  $sql = "SELECT product.product_name , product.description,
     product_image.image_name , product_image.thumbnail , color.color , size.size_title ,
      material.material_name FROM product JOIN product_image JOIN color JOIN size JOIN material
       ON product.product_id = product_image.product_id and product.color_id = color.color_id and product.size_id = size.size_id
        and product.material_id = material.material_id";
  $stmt = $pdo->query($sql);
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($row['thumbnail']==1 || !$row['image_name']){
    ?>

     <tr onmouseover="this.style.backgroundColor='#e0ac1c';" onmouseout="this.style.backgroundColor='#333';">
  	<td width="250px"><img height="300px" width="250px" class="img" alt="Card image cap" src="media/<?= htmlentities($row['image_name']) ?>"></td>
  	 <td width="150px"><?= htmlentities($row['product_name']) ?></td>
  	 <td> <?= htmlentities($row['color']) ?> </td>
     <td> <?= htmlentities($row['size_title']) ?></td>
     <td> <?= htmlentities($row['material_name']) ?> </td>

       <td>
       	<form  action="delete.php"  method="GET">
     			<button class="btn btn-danger" type="submit" name="id" value="<?php echo $row['product_id']; ?>">Delete</button>
  		</form>
  </td>


   </tr>

  <?php
  }
}
  ?>

  </table>





  </body>

  </html>

<?php
}
?>
