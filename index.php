<?php
if(isset($_POST['post1']) && isset($_POST['post2'])){
	$exec = "sudo cfy deployments list | grep service | wc -l";
	exec($exec,$out,$rcode);

	if ($out[0] < 1) {

		$start_services = "sudo cfy install https://github.com/OOrsoos/registry/archive/master.zip -n services-deploy.yaml -i server_ip=18.219.80.131";
		exec($start_services, $services_output, $rcode_services);
		sleep(140);
		

		$url2 = 'http://18.219.80.131:8762/api/simulator-service/run';

		$context2 = stream_context_create(array(
    		'http' => array(
        	'method' => 'POST',
        	'header' => ["Content-type: application/json",
        				"Connection: close"],
        	'content' => '',
        	'timeout' => 60
    	)
		));

		$resp2 = file_get_contents($url2, FALSE, $context2);

		$counter = 0;
		$url2 = 'http://18.219.80.131:8762/api/cpu-service/queue/add';

		while($counter < $_POST['post1']){
		$job = array( 'cpujob' => 'job'.$counter);
		$context2 = stream_context_create(array(
    		'http' => array(
        	'method' => 'POST',
        	'header' => ["Content-type: application/json",
        				"Connection: close"],
        	'content' => '',
        	'timeout' => 60,
		'content' => json_encode($job)
    		)
		));

		$resp3 = file_get_contents($url2, FALSE, $context2);

		$counter = $counter + 1;
		}

		$counter = 0;
		$url2 = 'http://18.219.80.131:8762/api/in-out-service/queue/add';

		while($counter < $_POST['post2']){
		$job = array( 'iojob' => 'job'.$counter);
		$context2 = stream_context_create(array(
    		'http' => array(
        	'method' => 'POST',
        	'header' => ["Content-type: application/json",
        				"Connection: close"],
        	'content' => '',
        	'timeout' => 60,
		'content' => json_encode($job)
    		)
		));

		$resp3 = file_get_contents($url2, FALSE, $context2);
		$counter = $counter + 1;
		}


  		header("Location:jobs.php");
  		exit();

	} else {

		$counter = 0;
		$url2 = 'http://18.219.80.131:8762/api/cpu-service/queue/add';

		while($counter < $_POST['post1']){
		$job = array( 'cpujob' => 'job'.$counter);
		$context2 = stream_context_create(array(
    		'http' => array(
        	'method' => 'POST',
        	'header' => ["Content-type: application/json",
        				"Connection: close"],
        	'content' => '',
        	'timeout' => 60,
		'content' => json_encode($job)
    		)
		));

		$resp3 = file_get_contents($url2, FALSE, $context2);

		$counter = $counter + 1;
		}

		$counter = 0;
		$url2 = 'http://18.219.80.131:8762/api/in-out-service/queue/add';

		while($counter < $_POST['post2']){
		$job = array( 'iojob' => 'job'.$counter);
		$context2 = stream_context_create(array(
    		'http' => array(
        	'method' => 'POST',
        	'header' => ["Content-type: application/json",
        				"Connection: close"],
        	'content' => '',
        	'timeout' => 60,
		'content' => json_encode($job)
    		)
		));

		$resp3 = file_get_contents($url2, FALSE, $context2);
		$counter = $counter + 1;
		}


		$url = 'http://18.219.80.131:8762/api/simulator-service/run';

		$context = stream_context_create(array(
    		'http' => array(
        	'method' => 'POST',
        	'header' => ["Content-type: application/json",
        				"Connection: close"],
        	'content' => '',
        	'timeout' => 60
    	)
		));

		$resp = file_get_contents($url, FALSE, $context);



		sleep(1);
  		header("Location:jobs.php");
  		exit();

	}
	
}else{

?>
<!DOCTYPE html>
<html>
<head>
<style>
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  font-family: 'Helvetica Neue', sans-serif;
}

input[type=button], input[type=submit], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}

h1 { color: #111;
	 font-family: 'Helvetica Neue', sans-serif;
	 font-size: 100px;
	 font-weight: bold;
	 letter-spacing: -1px;
	 line-height: 1;
	 text-align: center;
}
</style>
</head>
<body>

<h1>Simulator</h1>
<br>
<form action="/index.php" method="post">
  Jobs in CPU queue: <input type="text" name="post1"><br>
  Jobs in I/O queue: <input type="text" name="post2"><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>

<?php

}

?>

