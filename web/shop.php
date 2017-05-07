<?php
session_start();
header('Cache-Control: no cache');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dmitriy Sinitsyn</title>
	<link rel="stylesheet" href="css/style.css"/>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body class="page">
<div id="about">
<div class="page_wrapper">
<div class="about_content">
<img src="images/pizza-1.png" alt="pizza">
<h2>Pizza Delivery</h2>
<br>
<form method="post" action="cart.php">  

$10 <br>
PEPPERONI PIZZA
<select name="PEPPERONI">
  <option value="0" <?php if($_SESSION['PEPPERONI'] == 0) echo 'selected'; ?>>0</option>
  <option value="1" <?php if($_SESSION['PEPPERONI'] == 1) echo 'selected'; ?>>1</option>
  <option value="2" <?php if($_SESSION['PEPPERONI'] == 2) echo 'selected'; ?>>2</option>
  <option value="3" <?php if($_SESSION['PEPPERONI'] == 3) echo 'selected'; ?>>3</option>
</select><hr>
<br>
$12 <br>
CHEESE PIZZA
<select name="CHEESE">
  <option value="0" <?php if($_SESSION['CHEESE'] == 0) echo 'selected'; ?>>0</option>
  <option value="1" <?php if($_SESSION['CHEESE'] == 1) echo 'selected'; ?>>1</option>
  <option value="2" <?php if($_SESSION['CHEESE'] == 2) echo 'selected'; ?>>2</option>
  <option value="3" <?php if($_SESSION['CHEESE'] == 3) echo 'selected'; ?>>3</option>
</select><hr>
<br>
$14 <br>
SUPREME PIZZA
<select name="SUPREME">

  <option value="0" <?php if($_SESSION['SUPREME'] == 0) echo 'selected'; ?>>0</option>
  <option value="1" <?php if($_SESSION['SUPREME'] == 1) echo 'selected'; ?>>1</option>
  <option value="2" <?php if($_SESSION['SUPREME'] == 2) echo 'selected'; ?>>2</option>
  <option value="3" <?php if($_SESSION['SUPREME'] == 3) echo 'selected'; ?>>3</option>
</select>
<hr>

  <br><br>
  <input class="button_right" type="submit" name="submit" value="Add to cart and proceed to checkout">  
</form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</div>
</div>
</div>
</body>
</html>