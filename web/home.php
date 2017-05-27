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




$usersSt = $db->prepare("SELECT * FROM user_info");  
$usersSt->execute();
$users = $usersSt->fetchAll(PDO::FETCH_ASSOC);

$foodSt = $db->prepare("SELECT * FROM food");  
$foodSt->execute();
$food = $foodSt->fetchAll(PDO::FETCH_ASSOC);

$exercisesSt = $db->prepare("SELECT * FROM exercises");  
$exercisesSt->execute();
$exercises = $exercisesSt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION["users"] = $users;
$_SESSION["food"] = $food;
$_SESSION["exercises"] = $exercises;

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

<!-- test -->
<?php 

$uid = 2;

$statement3 = $db->prepare("SELECT * FROM user_info WHERE id = '". $uid ."'");  
$statement3->execute();
$rows = $statement3->fetchAll(PDO::FETCH_ASSOC);


// foreach ($rows as $value2) {

// print_r($value2);	echo "<br>";
// }

?>
<!-- end of test  -->
<img src="images/Pepper_Vegetables2.jpg" alt="Pepper and Vegetables" id="img1">
<h2>Healthy food</h2>
<br>
<form method="post" action="result.php">  


USER DATA
<br>
Select the user: 

<select name="PEPPERONI">
<?php
foreach ($users as $value2) {
 echo "<option value='"; echo $value2['lastname'] . "'>";  echo $value2['lastname'];"</option>"; 
}
?>
</select>
  <input class="" type="submit" name="submit" value="check result">  
</form>
<form method="post" action="result.php">  
<br>
FOOD DATA
<br>
Select meal: 
<select name="CHEESE">
<option value='Snack'>Snacks</option>
<option value='Dinner'>Dinners</option>
<option value='Lunch'>Lunch</option>

<?php
//foreach ($food as $value2) {
// echo "<option value='"; echo $value2['meal'] . "'>";  echo $value2['meal'];"</option>"; 	
//}
?>
</select>
  <input class="" type="submit" name="submit" value="check result">  
</form>
<form method="post" action="result.php">  
<br>
EXERCISES DATA
<br>
Select the Exercise: 
<select name="SUPREME">
<?php
foreach ($exercises as $value2) {
 echo "<option value='"; echo $value2['exercise'] . "'>";  echo $value2['exercise'];"</option>"; 
}
?>
</select>
 

  <br><br>
  <input class="" type="submit" name="submit" value="check result">  
</form>

	<!-- input form -->

<h4>Food input</h4>
<form method="post" action="add.php">
Select meal
<select name="meal">
<?php
foreach ($food as $value2) {
 echo "<option value='"; echo $value2['meal'] . "'>";  echo $value2['meal'];"</option>"; 	
}
?>
</select><br>
Input food name
<input type="text" id="foodName" name="foodName" required>
<br>
Input calories
<input type="number" id="calories" name="calories" required>
<br>
Input date
<input type="date" id="dateF" name="dateF" required>
<br>
  <br><br>
  <input class="" type="submit" name="submit" value="add food">  

</form>



<h4>User input</h4>
<form method="post" action="add.php">
First Name
<input type="text" id="firstName" name="firstName" required>
<br>
Last Name
<input type="text" id="lastName" name="lastName" required>
<br>
Age
<input type="number" id="age" name="age" required>
<br>
Height
<input type="number" id="height" name="height" required>
<br>
Weight
<input type="number" id="weightStart" name="weightStart" required>
<br>
Date Of Registration
<input type="number" id="dateOfRegistr" name="dateOfRegistr" required>

  <br><br>
  <input class="" type="submit" name="submit" value="add food">  

</form>



<h4>Exercises input</h4>
<form method="post" action="add.php">
Exercise
<input type="text" id="exercise" name="exercise" required>
<br>
Input Time Spent
<input type="text" id="timeSpent" name="timeSpent" required>
<br>
Input calories
<input type="number" id="caloriesLoose" name="caloriesLoose" required>
<br>
Input date
<input type="date" id="dateE" name="dateE" required>
<br>
  <br><br>
  <input class="" type="submit" name="submit" value="add food">  

</form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</div>
</div>
</div>
</body>
</html>