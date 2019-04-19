<?php

    $curl = curl_init();

    curl_setopt_array($curl, [
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'http://18.224.128.142:8762/api/cpu-service/queue/size'
    ]);

    $resp = curl_exec($curl);

    curl_close($curl);   



    var_dump($resp);


    $curl = curl_init();

	curl_setopt_array($curl, [
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'http://testcURL.com',
    	CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    	CURLOPT_POST => 1,
    	CURLOPT_POSTFIELDS => [
        	job1 => 'job1'
    	]
	]);

	$resp2 = curl_exec($curl);

	curl_close($curl);

	$curl = curl_init();

    curl_setopt_array($curl, [
    	CURLOPT_RETURNTRANSFER => 1,
    	CURLOPT_URL => 'http://18.224.128.142:8762/api/cpu-service/queue/size'
    ]);

    $resp = curl_exec($curl);

    curl_close($curl);   

    var_dump($resp);
?>