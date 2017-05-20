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


foreach ($rows as $value2) {

print_r($value2);	echo "<br>";
}

?>
<!-- end of test  -->
<img src="images/Pepper_Vegetables2.jpg" alt="Pepper and Vegetables" style="width: 500px;">
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
</select><hr>


<br>
FOOD DATA
<br>
Select food: 
<select name="CHEESE">
<?php
foreach ($food as $value2) {
 echo "<option value='0'>"; 	echo $value2['meal'];"</option>"; 
}
?>
</select><hr>
<br>
EXERCISES DATA
<br>
Select the Exercise: 
<select name="SUPREME">
<?php
foreach ($exercises as $value2) {
 echo "<option value='0'>"; 	echo $value2['exercise'];"</option>"; 
}
?>
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