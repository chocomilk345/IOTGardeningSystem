<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="30">
	<style type="text/css">
		.spec {
			text-align: center;
		}
		.table-container {
			display: flex;
			justify-content: center;
			gap: 20px;
		}
		table {
			border-collapse: collapse;
			width: 40%;
		}
		th, td {
			border: 1px solid black;
			padding: 8px;
			text-align: center;
		}
		.table-title {
			text-align: center;
			font-weight: bold;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	<h1 align="center">IoT Database</h1>
	<div class="spec">
		<b>The sensor value description</b>
		<br><br>
	</div>

	<div class="table-container">
		<div>
			<div class="table-title">ROOM</div>
			<table>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>ILLU</th>
					<th>TEMP</th>
					<th>HUMI</th>
				</tr>
				<?php
					$conn = mysqli_connect("localhost", "iot", "pwiot");
					mysqli_select_db($conn, "iotdb");
					$result = mysqli_query($conn, "SELECT * FROM sensor");
					while($row = mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['date'] . "</td>";
						echo "<td>" . $row['time'] . "</td>";
						echo "<td>" . $row['illu'] . "</td>";
						echo "<td>" . $row['temp'] . "</td>";
						echo "<td>" . $row['humi'] . "</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
		<div>
			<div class="table-title">POT</div>
			<table>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>WATER</th>
				</tr>
				<?php
					$result_pot = mysqli_query($conn, "SELECT * FROM pot");
					while($row = mysqli_fetch_array($result_pot)) {
						echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['date'] . "</td>";
						echo "<td>" . $row['time'] . "</td>";
						echo "<td>" . $row['water'] . "</td>";
						echo "</tr>";
					}
					mysqli_close($conn);
				?>
			</table>
		</div>
	</div>
</body>
</html>