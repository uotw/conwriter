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
        $city =  $_GET['city'];
} else {
        $city = "%";
}
#$sql = "select responses.transport,  count(*) as count from visits, responses WHERE visits.city like \"$city\" AND visits.id=responses.id group by responses.transport";



$sql = "SELECT COUNT(*) as count,DAY(ts) as day, MONTH(ts) as month, YEAR(ts) as year FROM visits WHERE city LIKE '$city' GROUP BY year, month, day";
$result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $days[]=array(
                        "date"=>$row['year']."-".sprintf("%02d", $row['month'])."-".sprintf("%02d",$row['day']),
                        "visits"=>$row['count']
                );
}

$sql="SELECT COUNT(*) as count,MONTH(ts) as month, YEAR(ts) as year FROM visits WHERE city LIKE '$city' GROUP BY year, month"; //monthly
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $months[]=array(
                        "date"=>$row['year']."-".sprintf("%02d", $row['month']),
                        "visits"=>$row['count']
                );
}
$sql="SELECT COUNT(*) as count, YEAR(ts) as year FROM visits WHERE city LIKE '$city' GROUP BY year ";//yearly
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $years[]=array(
                        "date"=>$row['year'].'-06-01',
                        "visits"=>$row['count']
                );
	}
	$lastyearArr=array_pop($years);//[count($years)-1];
	//echo $lastyearArr['visits'];
	$lastyearArr['visits']= (365-intval(date("z"))-1) * intval($lastyearArr['visits']) / (intval(date("z"))+1);
	$years[]=$lastyearArr;


$sql="SELECT COUNT(*) as count, FROM_DAYS(TO_DAYS(ts) -MOD(TO_DAYS(ts) -1, 7)) AS week_beginning  FROM visits  WHERE city LIKE '$city' GROUP BY week_beginning ";//weekly
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $weeks[]=array(
                        "date"=>$row['week_beginning'],
                        "visits"=>$row['count']
                );
}

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
        echo '{';
        echo '"days": ';
         echo json_encode($days);
        echo ',"months": ';
        echo json_encode($months);
        echo ',"years": ';
        echo json_encode($years);
        echo ',"weeks": ';
        echo json_encode($weeks);

        echo '}';

?>
