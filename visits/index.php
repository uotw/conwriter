<?php
$config = parse_ini_file('/var/www/scripts/condbcred.ini');
// database login credentials
$conn   = new mysqli($config['servername'],$config['username'],$config['password'],$config['dbname']);
        // Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
?>

<html>
<head>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<style>
body{
margin:10px;
}
</style>
<title>CON Writer Log</title>
</head>
<body>
<h1>CON Writer Log</h1>
<hr>
<table border = '2'>
<tr>
<th>date</th>
<th>city</th>
<th>state</th>
</tr>
<?php 
$sql = 'SELECT * from visits ORDER BY id ASC';
$result=$conn->query($sql);
while ($row=$result->fetch_assoc()){
	echo "<tr>";
	echo "<td>" . $row['ts'] ."</td>";
	echo "<td>" . $row['city'] ."</td>";
	echo "<td>" . $row['state'] ."</td>";
	echo "</tr>";
}
?>
</table>
</body>
</html>
