<?php
?>
<!DOCTYPE html>
<html>
<head>
<style>

body {
  background-image: url("back.jpg");
  background-repeat: no-repeat;
  background-size: 1000px 373px;
}

#p1 {
  	color: #111;
	font-family: 'Helvetica Neue', sans-serif;
	font-size: 20px;
	letter-spacing: -1px;
	line-height: 1;
	position: absolute;
	margin-left: 448px;
	margin-top: 75px;
} 

#p2 {
  	color: #111;
	font-family: 'Helvetica Neue', sans-serif;
	font-size: 20px;
	letter-spacing: -1px;
	line-height: 1;
	position: absolute;
	margin-top: 30px;
	margin-left: 600px;
} 

#p3 {
  	color: #111;
	font-family: 'Helvetica Neue', sans-serif;
	font-size: 20px;
	letter-spacing: -1px;
	line-height: 1;
	position: absolute;
	margin-top: 230px;
	margin-left: 598px;
} 

#p4 {
  	color: #111;
	font-family: 'Helvetica Neue', sans-serif;
	font-size: 20px;
	letter-spacing: -1px;
	line-height: 1;
	position: absolute;
	margin-left: 448px;
	margin-top: 190px;
} 

input[type=submit] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  margin-top: 273px;
}



</style>
</head>
<body>
<?php
	$cpu_queue = 'http://18.219.80.131:8762/api/cpu-service/queue/size';
	$cpu_center = 'http://18.219.80.131:8762/api/cpu-service/service/size';
	$io_queue = 'http://18.219.80.131:8762/api/in-out-service/queue/size';
	$io_center = 'http://18.219.80.131:8762/api/in-out-service/service/size';



	$context2 = stream_context_create(array(
    	'http' => array(
        'method' => 'GET',
        'header' => 'Connection: close\r\n',
        'content' => '',
        'timeout' => 5
    )
	));

	$p1_prefix = '<p id="p1">';
	$p2_prefix = '<p id="p2">';
	$p3_prefix = '<p id="p3">';
	$p4_prefix = '<p id="p4">';
	$p_suffix = '</p><br>';
	$jobs_in_cpu_queue = file_get_contents($cpu_queue, FALSE, $context2);
	sleep(0.3);
	$jobs_in_cpu_center = file_get_contents($cpu_center, FALSE, $context2);
	sleep(0.3);
	$jobs_in_io_queue = file_get_contents($io_queue, FALSE, $context2);
	sleep(0.3);
	$jobs_in_io_center = file_get_contents($io_center, FALSE, $context2);
	sleep(0.3);
	echo $p1_prefix.$jobs_in_cpu_queue.$p_suffix;
	echo $p2_prefix.$jobs_in_cpu_center.$p_suffix;
	echo $p3_prefix.$jobs_in_io_queue.$p_suffix;
	echo $p4_prefix.$jobs_in_io_center.$p_suffix;


 ?>

 <br>
 <br>
<form method="get" action="jobs.php">
    <input type="submit" value="Refresh jobs counter">
</form>
<form method="post" action="index.php">
    <input type="submit" value="End Simulation">
</form>
</body>
</html>
