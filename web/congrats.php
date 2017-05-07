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
<img src="images/pizza-1.png" alt="pizza"><br>

<?php

echo "<h2>Order confirmation:</h2>";

$name = $email = $phone = $address = $zip = $state = $country  = "";

$name = test($_POST["name"]);
$email = test($_POST["email"]);
$address = test($_POST["address"]);
$phone = test($_POST["phone"]);
$zip = test($_POST["zip"]);
$state = test($_POST["state"]);
$country = test($_POST["country"]);


function test($test) {
  $test1 = trim($test);
  $test2 = stripslashes($test1);
  $test3 = htmlspecialchars($test2);
  return $test3;
}

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['address'] = $address;
$_SESSION['phone'] = $phone;
$_SESSION['zip'] = $zip;
$_SESSION['state'] = $state;
$_SESSION['country'] = $country;

echo $_SESSION["ORDER"];

echo "<br><br><b>Address:</b><br><br>";

echo "Name: " . $name;
echo "<br>";
echo "E-mail: " . $email;
echo "<br>";
echo "Phone: " . $phone;
echo "<br>";
echo "Address: " . $address;
echo "<br>";
echo "Zip: " . $zip;
echo "<br>";
echo "State: " . $state;
echo "<br>";
echo "Country: " . $country;
echo "<br>";




?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</div>
</div>
</div>	
</body>
</html>