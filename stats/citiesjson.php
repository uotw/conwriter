<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$config = parse_ini_file('/var/www/scripts/condbcred.ini');
// database login credentials
$conn   = new mysqli($config['servername'],$config['username'],$config['password'],$config['dbname']);
        // Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

if ($_GET['city']!=''){
	if ($_GET['city']=='other'){
		 $city = "%";
	} else {
		$city =  $_GET['city'];
	}
} else {
	$city = "%";
}
include('thresh.php');
$sql = "select city as city ,count(*) as count from visits where city like '$city' group by city ORDER by count desc";
$other=0;
$total=0;
$threshnum=0;
#$sql = "select responses.destination,  count(*) as count from visits, responses WHERE visits.city like \"$city\" AND visits.id=responses.id group by responses.destination";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
		$total+=$row['count'];
}
if($_GET['city']!='other'){
    $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
	    if(100*$row['count']/$total>$thresh){
                $cities[]=array(
                        "city"=>$row['city'],
                        "count"=>$row['count']
                );
	   } else {
		$other+=$row['count'];
	}
   }

   if($other>0){
	$cities[]=array(
                        "city"=>"other",
                        "count"=>$other
                );
  } 
} else {
    //$numthresh=
    //$sql = "select city as city ,count(*) as count from visits where city like '$city' where count > '5' group by city ORDER by count desc";
    	$result = $conn->query($sql);
	//echo $thresh;
        while ($row = $result->fetch_assoc()) {
		$count = $row['count'];
		if(100*$row['count']/$total<$thresh){
			$threshnum=max($threshnum, $row['count']);
		}
		//echo "\\$count\\";
	}
	//echo $threshnum;
	$threshnum++;
	$sql = "select city as city ,count(*) as count from visits group by city HAVING count < '$threshnum' ORDER by count desc";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
                $cities[]=array(
                        "city"=>$row['city'],
                        "count"=>$row['count']
                );
        }

   if($other>0){
        $cities[]=array(
                        "city"=>"other",
                        "count"=>$other
                );
  }
}
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
         echo json_encode($cities);
?>
