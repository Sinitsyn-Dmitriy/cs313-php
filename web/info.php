<?php 






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
    ['Year1', 'Exercises', 'Food'],
    ['2004',  1000,      400],
    ['2005',  1170,      460],
    ['2006',  660,       1120],
        ['2006',  660,       1120],
            ['2006',  660,       1120],
                ['2006',  660,       1120],
    ['2017',  1030,      540]
  ]);

  var options = {
    title: 'Calories',
    hAxis: {title: 'Calories from food versus calories burned with exercises', titleTextStyle: {color: 'red'}}
 };

var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
  chart.draw(data, options);
}

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart2);
function drawChart2() {
  var data = google.visualization.arrayToDataTable([
    ['Year', 'Weight on the start', 'Weight become'],
    ['2013',  1000,      400],
    ['2014',  1000,      460],
    ['2015',  1000,       1120],
    ['2016',  1000,      540]
  ]);

  var options = {
    title: 'Weight',
    hAxis: {title: 'Weight',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
  chart.draw(data, options);
}

$(window).resize(function(){
  drawChart1();
  drawChart2();
});


    </script>

</body>
</html>
