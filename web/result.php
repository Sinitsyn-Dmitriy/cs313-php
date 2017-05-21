<?php		
session_start();
header('Cache-Control: no cache');

$dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

try
{
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}

if (isset($_POST["PEPPERONI"])) { $pep = test($_POST["PEPPERONI"]); }
if (isset($_POST["CHEESE"])) { $che = test($_POST["CHEESE"]); }
if (isset($_POST["SUPREME"])) { $sup = test($_POST["SUPREME"]); }


$usersSt = $db->prepare("SELECT * FROM user_info WHERE lastname = '". $pep ."'");  
$usersSt->execute();
$users = $usersSt->fetchAll(PDO::FETCH_ASSOC);

$foodSt = $db->prepare("SELECT * FROM food WHERE meal = '". $che ."'");  
$foodSt->execute();
$food = $foodSt->fetchAll(PDO::FETCH_ASSOC);

$exercisesSt = $db->prepare("SELECT * FROM exercises WHERE exercise = '". $sup ."'");  
$exercisesSt->execute();
$exercises = $exercisesSt->fetchAll(PDO::FETCH_ASSOC);

// $_SESSION["users"] = $users;
// $_SESSION["food"] = $food;
// $_SESSION["exercises"] = $exercises;

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
<a href="home.php">back to home page</a><br>
<img src="images/Pepper_Vegetables2.jpg" alt="Pepper and Vegetables" id="img1">

<?php


// $_SESSION["PEPPERONI"] = $pep;
// $_SESSION["CHEESE"] = $che;
// $_SESSION["SUPREME"] = $sup;

// $usersBig = $_SESSION["users"];
// $foodBig = $_SESSION["food"];
// $exercisesBig = $_SESSION["exercises"];
// rray ( [id] => 2 [dateofregistr] => 2017-05-19 [firstname] => Elena [lastname] => Sinitcyna [age] => 30 [height] => 166 [weightstart] => 51 ) Array ( [id] => 2 [date] => 2017-05-19 [foodname] => Apple [meal] => Snack [calories] => 40 ) Array ( [id] => 2 [date] => 2017-05-19 [timespent] => 15 [exercise] => Swiming [caloriesloose] => 180 ) 

foreach ($users as $value) {
	echo "First Name - " . $value[firstname] . "<br>";
	echo "Last Name - " . $value[lastname] . "<br>";
	echo "Age - " . $value[age] . "<br>";
	echo "Height - " . $value[height] . "<br>";
	echo "Weight at start - " . $value[weightstart] . "<br><br><br><hr>";
} 
foreach ($food as $value) {
	print_r($value);
} 
foreach ($exercises as $value) {
	print_r($value);
} 

// print_r($usersBig);
// print_r($foodBig);
// print_r($exercisesBig);

// echo "<br>".$pep . "<br>". $che ."<br>". $sup;
// die();


// $sum = ($pep * 10) + ($che * 12) + ($sup * 14);
// $order = "";
// echo "<h2>Your order is: </h2><br><br>";

// if ($pep > 0) {

// echo "PEPPERONI PIZZA  - " . $pep . "<br><br>";

// $order .= "PEPPERONI PIZZA  - " . $pep . "<br>";
// }
// if ($che > 0) {

// echo "CHEESE PIZZA     -" . $che . " <br><br>";
// $order .= "CHEESE PIZZA  - " . $che . "<br>";
// }
// if ($sup > 0) {

// echo "SUPREME PIZZA   -  " . $sup . " <br><br>";
// $order .= "SUPREME PIZZA  - " . $sup . "<br>";
// }
// if ($che == 0 && $sup == 0 && $pep == 0) {
// echo "your cart is empty";
// }

// $_SESSION["ORDER"] = $order . "<br><br>Your Total is   $" . $sum;

// echo "<br>Your Total is   $" . $sum;





function test($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<br><br>
<!-- <h4>Please input your address for delivery</h4>
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
</p> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</div>
</div>
</div>
</body>
</html>