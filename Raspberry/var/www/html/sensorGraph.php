<?php
	$conn = mysqli_connect("localhost", "iot", "pwiot");
	mysqli_select_db($conn, "iotdb");

	// Sensor table data
	$query_sensor = "select name, date, time, illu, temp, humi from sensor";
	$result_sensor = mysqli_query($conn, $query_sensor);
	$data_sensor = array(array('KSH_SQL', 'illu', 'temp', 'humi'));

	if ($result_sensor) {
		while ($row = mysqli_fetch_array($result_sensor)) {
			array_push($data_sensor, array($row['date'] . "\n" . $row['time'], intval($row['illu']), intval($row['temp']), intval($row['humi'])));
		}
	}

	$options_sensor = array(
		'title' => 'Illumination Temperature Humidity',
		'width' => 1000, 'height' => 400,
		'curveType' => 'function'
	);

	// Pot table data
	$query_pot = "select name, date, time, water from pot";
	$result_pot = mysqli_query($conn, $query_pot);
	$data_pot = array(array('POT_SQL', 'water'));

	if ($result_pot) {
		while ($row = mysqli_fetch_array($result_pot)) {
			array_push($data_pot, array($row['date'] . "\n" . $row['time'], floatval($row['water'])));
		}
	}

	$options_pot = array(
		'title' => 'Water Level',
		'width' => 1000, 'height' => 400,
		'curveType' => 'function'
	);
?>

<script src="//www.google.com/jsapi"></script>
<script>
	var data_sensor = <?= json_encode($data_sensor) ?>;
	var options_sensor = <?= json_encode($options_sensor) ?>;

	var data_pot = <?= json_encode($data_pot) ?>;
	var options_pot = <?= json_encode($options_pot) ?>;

	google.load('visualization', '1.0', {'packages': ['corechart']});

	google.setOnLoadCallback(function () {
		var chart_sensor = new google.visualization.LineChart(document.querySelector('#chart_sensor_div'));
		chart_sensor.draw(google.visualization.arrayToDataTable(data_sensor), options_sensor);

		var chart_pot = new google.visualization.LineChart(document.querySelector('#chart_pot_div'));
		chart_pot.draw(google.visualization.arrayToDataTable(data_pot), options_pot);
	});
</script>

<div id="chart_sensor_div"></div>
<div id="chart_pot_div"></div>