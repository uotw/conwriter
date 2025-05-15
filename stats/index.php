<?
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CON Stats</title>
  <link rel="stylesheet" href="./css/style.css?<?php echo date('Y-m-d_H:i:s'); ?>">
</head>
<body>
<!-- partial:index.partial.html -->
<table style="width:100%">
  <tr>
	<th>
		<div id=canvaswrap><canvas id=chartCanvas></canvas>
		<div id=buttons><button id=day >by day</button><button id=week class=active>by week</button><button id=month>by month</button><button id=year>by year</button></div></div>
	</th>
	<th>
		<div id=canvaswrap2><canvas id=pieChartCanvas></canvas></div>
		<div id=alldata><a href = "https://www.conwriter.com/stats/"><button>Show All Data</button></a></div>
		<div id=citymsg>click on chart to drill down</div>
	</th>
  </tr>
  <tr>
        <th>
                <div id=canvaswrap3><canvas id=transChartCanvas></canvas></div>
        </th>
        <th>
                <div id=canvaswrap4><canvas id=destChartCanvas></canvas></div>
        </th>
  </tr>
</table>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='./js/script.js?<?php echo date('Y-m-d_H:i:s'); ?>'></script>
</body>
</html>
