<?php

	$url = "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=54.896870&lon=23.892429";
	$headers = [
    	"User-Agent: YourApp/1.0 (your@email.com)",
	];

	$options = [
    	"http" => [
        	"header" => implode("\r\n", $headers),
        	"method" => "GET",
    	],
	];
		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);

		if ($response !== false) {
    		$data = json_decode($response, true);

    		// Extract specific information
    		//$temperature = $data["properties"]["timeseries"][3]["data"]["instant"]["details"]["air_temperature"];
    		//$humidity = $data["properties"]["timeseries"][3]["data"]["instant"]["details"]["relative_humidity"];
			//echo "Temperature: {$temperature}°C\n";
    		//echo "Humidity: {$humidity}%\n";
			header("Content-Type: application/json");
			echo json_encode($data);
		} else {
    		echo "Error fetching data\n";
		}


?>	
	