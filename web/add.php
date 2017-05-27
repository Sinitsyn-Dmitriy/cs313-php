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

if (isset($_POST["Food"])) {

if (isset($_POST["foodName"])) { $foodName = test($_POST["foodName"]); }
if (isset($_POST["calories"])) { $calories = test($_POST["calories"]); }
if (isset($_POST["meal"])) { $meal = test($_POST["meal"]); }
if (isset($_POST["dateF"])) { $date = test($_POST["dateF"]); }

	$query = 'INSERT INTO food(date, foodName, meal, calories) VALUES(:date, :foodName, :meal, :calories)';
	$statement = $db->prepare($query);

	$statement->bindValue(':date', $date);
	$statement->bindValue(':foodName', $foodName);
	$statement->bindValue(':meal', $meal);
	$statement->bindValue(':calories', $calories);
	$statement->execute();

}

if (isset($_POST["User"])) {

if (isset($_POST["dateOfRegistr"])) { $dateOfRegistr = test($_POST["dateOfRegistr"]); }
if (isset($_POST["firstName"])) { $firstName = test($_POST["firstName"]); }
if (isset($_POST["lastName"])) { $lastName = test($_POST["lastName"]); }
if (isset($_POST["age"])) { $age = test($_POST["age"]); }
if (isset($_POST["height"])) { $height = test($_POST["height"]); }
if (isset($_POST["weightStart"])) { $weightStart = test($_POST["weightStart"]); }

	$query = 'INSERT INTO user_info(dateOfRegistr, firstName, lastName, age, height, weightStart) VALUES(:dateOfRegistr, :firstName, :lastName, :age, :height, :weightStart)';
	$statement = $db->prepare($query);

	$statement->bindValue(':dateOfRegistr', $dateOfRegistr);
	$statement->bindValue(':firstName', $firstName);
	$statement->bindValue(':lastName', $lastName);
	$statement->bindValue(':age', $age);
	$statement->bindValue(':height', $height);
	$statement->bindValue(':weightStart', $weightStart);
	$statement->execute();
}

if (isset($_POST["Exercise1"])) {

if (isset($_POST["exercise"])) { $exercise = test($_POST["exercise"]); }
if (isset($_POST["caloriesLoose"])) { $caloriesLoose = test($_POST["caloriesLoose"]); }
if (isset($_POST["timeSpent"])) { $timeSpent = test($_POST["timeSpent"]); }
if (isset($_POST["dateE"])) { $dateE = test($_POST["dateE"]); }

	$query = 'INSERT INTO exercises(date, exercise, timeSpent, caloriesLoose) VALUES(:date, :exercise, :timeSpent, :caloriesLoose)';
	$statement = $db->prepare($query);

	$statement->bindValue(':date', $dateE);
	$statement->bindValue(':exercise', $exercise);
	$statement->bindValue(':timeSpent', $timeSpent);
	$statement->bindValue(':caloriesLoose', $caloriesLoose);
	$statement->execute();
}



// $usersSt = $db->prepare("SELECT * FROM user_info WHERE lastname = '". $pep ."'");  
// $usersSt->execute();
// $users = $usersSt->fetchAll(PDO::FETCH_ASSOC);

// $foodSt = $db->prepare("SELECT * FROM food WHERE meal = '". $che ."'");  
// $foodSt->execute();
// $food = $foodSt->fetchAll(PDO::FETCH_ASSOC);

// $exercisesSt = $db->prepare("SELECT * FROM exercises WHERE exercise = '". $sup ."'");  
// $exercisesSt->execute();
// $exercises = $exercisesSt->fetchAll(PDO::FETCH_ASSOC);

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
	echo "<br><br>First Name - " . $value[firstname] . "<br>";
	echo "Last Name - " . $value[lastname] . "<br>";
	echo "Age - " . $value[age] . "<br>";
	echo "Height - " . $value[height] . " sm<br>";
	echo "Weight at start - " . $value[weightstart] . " kg<br><br><br>";
} 
foreach ($food as $value) {
	echo "<br><br>Food Name - " . $value[foodname] . "<br>";
	echo "Meal - " . $value[meal] . "<br>";
	echo "Calories - " . $value[calories] . "<br>";
	echo "Date - " . $value[date] . "<br><br><br>";
} 
foreach ($exercises as $value) {
	echo "<br><br>Exercise - " . $value[exercise] . "<br>";
	echo "Calories loose - " . $value[caloriesloose] . "<br>";
	echo "Time Spent - " . $value[timespent] . "<br>";
	echo "Date - " . $value[date] . "<br><br><br>";
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