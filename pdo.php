<?php
$pdo = new PDO('mysql:host=localhost;dbname=Web_project',
    'root', 'Ayman1@1');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
