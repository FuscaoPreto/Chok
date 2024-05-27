<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "esp_db";

$inc_code = $_GET['inc_code'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$inc_code = $_GET['inc_code'];
$stmt = $conn->prepare("SELECT * FROM dados WHERE inc_code = ? ORDER BY timestamp DESC LIMIT 25");
$stmt->bind_param("s", $inc_code);
$stmt->execute();
$result = $stmt->get_result();

$dataPoints1 = array();
$dataPoints2 = array();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    array_push($dataPoints1, array("x" => $row["timestamp"], "y" => $row["temperatura"]));
    array_push($dataPoints2, array("x" => $row["timestamp"], "y" => $row["umidade"]));
  }
} else {
  echo "0 results";
}
$conn->close();

$updateInterval = 2000;
$x=null;
$y1=null;
$y2=null;


?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var updateInterval = <?php echo $updateInterval ?>;
var dataPoints1 = <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
var dataPoints2 = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
var yValue1 = <?php echo $y1 ?>;
var yValue2 = <?php echo $y2 ?>;
var xValue = <?php echo $x ?>;
 
var chart = new CanvasJS.Chart("chartContainer", {
	zoomEnabled: true,
	title: {
		text: "Temperatura e Umidade da Incubadora"
	},
	axisX: {
		title: "Horário de medição"
	},
	axisY:{
		suffix: " °C"
	},
    axisY2:{
        suffix: " % de Umidade Relativa"
    }, 
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		verticalAlign: "top",
		fontSize: 22,
		fontColor: "dimGrey",
		itemclick : toggleDataSeries
	},
	data: [{ 
			type: "line",
			name: "Temperatura",
			xValueType: "dateTime",
			yValueFormatString: "##.## °C",
			xValueFormatString: "hh:mm:ss TT",
			showInLegend: true,
			legendText: "{name}: " + yValue1 + " °C",
			dataPoints: dataPoints1
		},
		{				
			type: "line",
			name: "Umidade Relativa" ,
			xValueType: "dateTime",
			yValueFormatString: "##.## %",
			showInLegend: true,
			legendText: "{name}: " + yValue2 + " %",
			dataPoints: dataPoints2
	}]
});
 
chart.render();
setInterval(function(){updateChart()}, updateInterval);
 
function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
function updateChart() {
	var deltatemperatura, deltaumidade;
	xValue += updateInterval;
	
    
	// pushing the new values
	dataPoints1.push({
		x: xValue,
		y: yValue1
	});
	dataPoints2.push({
		x: xValue,
		y: yValue2
	});
 
    
	// updating legend text with  updated with y Value 
	chart.options.data[0].legendText = "Temperatura " + yValue1 + " °C";
	chart.options.data[1].legendText = " Umidade " + yValue2+ " %"; 
	chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>