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
$sql = "select responses.destination,  count(*) as count from visits, responses WHERE visits.city like \"$city\" AND visits.id=responses.id group by responses.destination";
#$sql = "select destination as destination, count(*) as count from responses group by destination";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
		if($row['destination']==1){
			$destination = "Psychiatric Facility";
		} else if($row['destination']==2){
			$destination = "Telehealth Location";
		} 
                $destinations[]=array(
                        "destination"=>$destination,
                        "count"=>$row['count']
                );
}

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
        echo json_encode($destinations);

?>
