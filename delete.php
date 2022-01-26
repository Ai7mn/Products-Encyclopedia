<?php
require_once "pdo.php";
include_once "Nav.php";
if(!isset($_SESSION)){
  session_start();
}
if (isset($_POST['delete']) && isset($_POST['product_id']) ) {
  $sql = "DELETE FROM product WHERE product_id = :the_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':the_id' => $_POST['product_id']));
  $_SESSION['success'] = 'Product deleted';
  header( 'Location: staff.php' ) ;
  return;
}
$stmt = $pdo->prepare("SELECT product_id, product_name FROM product where product_id = :pro_id");
$stmt->execute(array(":pro_id" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
  $_SESSION['error'] = 'No value for product_id';
  header( 'Location: staff.php' ) ;
  return;
}
?>
<p>Confirm: Deleting <?= htmlentities($row['product_name']) ?></p>

<form method="post"><input type="hidden"
name="product_id" value="<?= $row['product_id'] ?>">
<input type="submit" value="Delete" name="delete" class="btn btn-danger">
<a href="staff.php">Cancel</a>
</form>
