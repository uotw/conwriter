<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if($_POST['key']!="maQCVP4tXpVZCUkw"){
	exit();
}

$config = parse_ini_file('/var/www/scripts/condbcred.ini');
// database login credentials
$conn   = new mysqli($config['servername'],$config['username'],$config['password'],$config['dbname']);
        // Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

$ipAddress = $_SERVER['HTTP_X_REAL_IP'];
if(strpos($ipAddress,"10.0.0.")!== false){
	echo "exiting";
	exit();
}
$details = json_decode(file_get_contents("http://ipinfo.io/{$ipAddress}/json"));
$city=$details->city;
$region=$details->region;
$country=$details->country;

//$sql = 'INSERT INTO visits ( ip, city, state) VALUES ("'.$ipAddress.'","'.$city.'","'.$region.'",)';
$sql = "INSERT INTO visits ( ip, city, state, user_type) VALUES ('$ipAddress', '$city','$region', 'le')";
if ($conn->query($sql) === TRUE) {
	echo "success!";
} else {
	echo "add failed: " . $sql;
}
/*
$sql = 'SELECT LAST_INSERT_ID() as id';
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$id = $row['id'];

$sql = 'INSERT INTO responses ( id, destination, transport, county) VALUES ("'.$id.'","'.$_POST['destination'].'","'.$_POST['transport'].'","'.$_POST['county'].'")';
if ($conn->query($sql) === TRUE) {
        echo "success!";
} else {
        echo "add failed: " . $sql;
}
 */
?>
