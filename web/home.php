<?php		

$dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

try
{
	// Create the PDO connection
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
}
catch (PDOException $ex)
{
	// If this were in production, you would not want to echo
	// the details of the exception.
	echo "Error connecting to DB. Details: $ex";
	die();
}


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

<!-- test -->
<?php 
$statement = $db->prepare("SELECT dateOfRegistr, firstName, lastName, age, height, weightStart FROM user_info");  
$statement->execute();

$statement2 = $db->prepare("SELECT * FROM user_info");  
$statement2->execute();

$uid = 2;

$statement3 = $db->prepare("SELECT * FROM user_info WHERE id = '". $uid ."'");  
$statement3->execute();
$rows = $statement3->fetchAll(PDO::FETCH_ASSOC);

// foreach ($statement2->fetch(PDO::FETCH_ASSOC) as $value) {

// print_r($value);	echo "<br>";
// }

// foreach ($statement2->fetch(PDO::FETCH_ASSOC) as $value2) {

// print_r($value2);	echo "<br>";
// }

foreach ($rows as $value2) {

print_r($value2);	echo "<br>";
}

//print_r($statement->fetch(PDO::FETCH_ASSOC));

// while ($row = $statement->fetch(PDO::FETCH_ASSOC))
// {
// 	echo '<p>';
// 	echo '<strong>' . $row['dateOfRegistr'] . ' ' . $row['firstName'] . ':';
// 	echo $row['lastName'] . '</strong>' . ' - ' . $row['weightStart'];
// 	echo '</p>';
// }

?>
<!-- end of test  -->
<img src="images/Pepper_Vegetables.jpg" alt="Pepper and Vegetables" style="width: 500px;">
<h2>Healthy food</h2>
<br>
<form method="post" action="cart.php">  


USER DATA
<br>
Select the user: 

<select name="PEPPERONI">
<?php
foreach ($rows as $value2) {
?>

<?php echo "<option value='0'>"; 	echo $value2['lastname'];"</option>"; ?>
<!--   <option value="0" <?php if($_SESSION['PEPPERONI'] == 0) echo 'selected'; ?>>0</option>
  <option value="1" <?php if($_SESSION['PEPPERONI'] == 1) echo 'selected'; ?>>1</option>
  <option value="2" <?php if($_SESSION['PEPPERONI'] == 2) echo 'selected'; ?>>2</option>
  <option value="3" <?php if($_SESSION['PEPPERONI'] == 3) echo 'selected'; ?>>3</option> -->
  <?php 
}
?>
</select><hr>


<br>
FOOD DATA
<br>
Select food: 
<select name="CHEESE">
  <option value="0" <?php if($_SESSION['CHEESE'] == 0) echo 'selected'; ?>>0</option>
  <option value="1" <?php if($_SESSION['CHEESE'] == 1) echo 'selected'; ?>>1</option>
  <option value="2" <?php if($_SESSION['CHEESE'] == 2) echo 'selected'; ?>>2</option>
  <option value="3" <?php if($_SESSION['CHEESE'] == 3) echo 'selected'; ?>>3</option>
</select><hr>
<br>
EXERCISES DATA
<br>
Select the Exercise: 
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



?>