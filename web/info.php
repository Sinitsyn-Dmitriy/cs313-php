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


$usersSt = $db->prepare("SELECT * FROM user_info ");  
$usersSt->execute();
$users = $usersSt->fetchAll(PDO::FETCH_ASSOC);

$foodSt = $db->prepare("SELECT * FROM food ");  
$foodSt->execute();
$food = $foodSt->fetchAll(PDO::FETCH_ASSOC);

$exercisesSt = $db->prepare("SELECT * FROM exercises ");  
$exercisesSt->execute();
$exercises = $exercisesSt->fetchAll(PDO::FETCH_ASSOC);


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





function test($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>







 <!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">

  
  <!-- https://www.google.com/jsapi  -->
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>

<style>
	.chart {
  width: 100%;
  min-height: 450px;
}
</style>
  

  
</head>

<body>
  <div class="row">
  <div class="col-md-12 text-center">

<?php  foreach ($food as $value) { echo "['" . $value[date] .  $value[meal] . ", 0, " . $value[calories] . "],"; }  ?>

  </div>
  <div class="col-md-4 col-md-offset-4">
    <hr />
  </div>
  <div class="clearfix"></div>
  <div class="col-md-6">
    <div id="chart_div1" class="chart"></div>
  </div>
  <div class="col-md-6">
    <div id="chart_div2" class="chart"></div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://www.google.com/jsapi'></script>

    <script>
    	google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart1); 
function drawChart1() {
  var data = google.visualization.arrayToDataTable([
    ['Date', 'Exercises', 'Food'],
    // ['2017-05-18',  1000,      400],
    // ['2005',  1170,      460],
// ['2017-05-20Dinner, 0, 420],['2017-05-19Snack, 0, 40],['2017-05-18Lunch, 0, 150],['2017-05-26Snack, 0, 200],['2017-05-24Lunch, 0, 100],['2017-05-24Dinner, 0, 300],['2017-05-24Dinner, 0, 300],
<?php  foreach ($food as $value) { echo "['" . $value[date] . " " . $value[meal] . "', '0', '" . $value[calories] . "'],"; }  ?>

<?php  foreach ($exercises as $value) { echo "['" . $value[date] . " " . $value[exercise] . "', '" . $value[caloriesloose] . "' , '0'],"; }  ?>


    ['2017',  1030,      540]
  ]);



// <?php  

// foreach ($exercises as $value) {
//   echo "<br><br>Exercise - " . $value[exercise] . "<br>";
//   echo "Calories loose - " . $value[caloriesloose] . "<br>";
//   echo "Time Spent - " . $value[timespent] . "<br>";
//   echo "Date - " . $value[date] . "<br><br><br>";
// } 


// foreach ($food as $value) {
//   echo "<br><br>Food Name - " . $value[foodname] . "<br>";
//   echo "Meal - " . $value[meal] . "<br>";
//   echo "Calories - " . $value[calories] . "<br>";
//   echo "['" . $value[date] .  $value[meal] . ", 0, " . $value[calories] . "],";
// } 
?>

  var options = {
    title: 'Calories',
    hAxis: {title: 'Calories from food versus calories burned with exercises', titleTextStyle: {color: 'red'}}
 };

var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
  chart.draw(data, options);
}



$(window).resize(function(){
  drawChart1();
  drawChart2();
});


    </script>

</body>
</html>
