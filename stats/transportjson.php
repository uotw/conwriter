<?php
$config = parse_ini_file('/var/www/scripts/condbcred.ini');
// database login credentials
$conn   = new mysqli($config['servername'],$config['username'],$config['password'],$config['dbname']);
        // Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
if ($_GET['city']!=''){
        $city =  $_GET['city'];
} else {
        $city = "%";
}
$sql = "select responses.transport,  count(*) as count from visits, responses WHERE visits.city like \"$city\" AND visits.id=responses.id group by responses.transport";

#$sql = "select transport as transport, count(*) as count from responses group by transport";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
		$transindex = $row['transport'];
		if($transindex==1){
			$transport = "Friends/Family";
		} else if($transindex==2){
			$transport = "Ambulance";
		} else if($transindex==3){
			$transport = "Sheriff/Law Enforcement";
		}
                $transports[]=array(
                        "transport"=>$transport,
                        "count"=>$row['count']
                );
}

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
        echo json_encode($transports);

?>
