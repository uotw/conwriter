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
$sql = "select city as city ,count(*) as count from visits where city like '$city' group by city ORDER by count desc";
$other=0;
$total=0;
$thresh=5;
#$sql = "select responses.destination,  count(*) as count from visits, responses WHERE visits.city like \"$city\" AND visits.id=responses.id group by responses.destination";
$result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
		$total+=$row['count'];
}
$result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
	    if(100*$row['count']/$total<$thresh){
                $cities[]=array(
                        "city"=>$row['city'],
                        "count"=>$row['count']
                );
	   } 
}

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
         echo json_encode($cities);
?>
