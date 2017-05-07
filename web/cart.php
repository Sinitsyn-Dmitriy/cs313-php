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
<a href="shop.php">back to shop</a><br>
<img src="images/pizza-1.png" alt="pizza"><br>

<?php
if (isset($_POST["PEPPERONI"])) { $pep = test($_POST["PEPPERONI"]); }
if (isset($_POST["CHEESE"])) { $che = test($_POST["CHEESE"]); }
if (isset($_POST["SUPREME"])) { $sup = test($_POST["SUPREME"]); }

$_SESSION["PEPPERONI"] = $pep;
$_SESSION["CHEESE"] = $che;
$_SESSION["SUPREME"] = $sup;


$sum = ($pep * 10) + ($che * 12) + ($sup * 14);
$order = "";
echo "<h2>Your order is: </h2><br><br>";

if ($pep > 0) {

echo "PEPPERONI PIZZA  - " . $pep . "<br><br>";

$order .= "PEPPERONI PIZZA  - " . $pep . "<br>";
}
if ($che > 0) {

echo "CHEESE PIZZA     -" . $che . " <br><br>";
$order .= "CHEESE PIZZA  - " . $che . "<br>";
}
if ($sup > 0) {

echo "SUPREME PIZZA   -  " . $sup . " <br><br>";
$order .= "SUPREME PIZZA  - " . $sup . "<br>";
}
if ($che == 0 && $sup == 0 && $pep == 0) {
echo "your cart is empty";
}

$_SESSION["ORDER"] = $order . "<br><br>Your Total is   $" . $sum;

echo "<br>Your Total is   $" . $sum;





function test($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<br><br>
<h4>Please input your address for delivery</h4>
<br>
<p>
<form method="post" action="congrats.php">  
Name: <input type="text" name="name" value="<?php if (isset($_SESSION['name'])) { echo $_SESSION['name']; } ?>"  required>
<br><br>
E-mail: <input type="email" name="email"  value="<?php if (isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>"  required>
<br><br>
Phone: <input type="phone" name="phone"  value="<?php if (isset($_SESSION['phone'])) {  echo $_SESSION['phone'];  } ?>"  required>
<br><br>
Address:  
<input type="text" name="address"  value="<?php if (isset($_SESSION['address'])) {  echo $_SESSION['address'];  } ?>"  required>
<br><br>
Zip: 
<input type="number" name="zip"  value="<?php  if (isset($_SESSION['zip'])) { echo $_SESSION['zip']; }  ?>"  required>
<br><br>
State:
<input type="text" name="state"  value="<?php  if (isset($_SESSION['state'])) { echo $_SESSION['state'];  } ?>"  required>
<br><br>
Country
<input type="text" name="country"  value="<?php  if (isset($_SESSION['country'])) { echo $_SESSION['country'];  } ?>"  required>
<br><br>
<br><br>
<input  class="button_right"  type="submit" name="submit" value="Submit the order">  
</form>
</p>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</div>
</div>
</div>
</body>
</html>