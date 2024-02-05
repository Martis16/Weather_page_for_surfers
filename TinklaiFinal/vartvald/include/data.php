<?php

	//$Kaunasurl = "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=54.896870&lon=23.892429";
	$Panurl = "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=55.737438&lon=24.370331"; //Panevezys
	$Alurl = "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=54.395432&lon=24.046780"; //Alytus
	$Klaiurl = "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=55.710800&lon=21.131809"; //Klaipėda
	$Marurl = "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=54.557812&lon=23.349810"; //Marijampolė
	$Telurl = "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=55.983582&lon=22.250811"; //Telšiai

$kryptis = "";
$gusiogreitis = "";
$greitis = "";
function getresponse($url, $x){
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
    		$kryptis = $data["properties"]["timeseries"][$x]["data"]["instant"]["details"]["wind_from_direction"];
    		$gusiogreitis = $data["properties"]["timeseries"][$x]["data"]["instant"]["details"]["wind_speed_of_gust"];
			$greitis = $data["properties"]["timeseries"][$x]["data"]["instant"]["details"]["wind_speed"];
			$temperatura = $data["properties"]["timeseries"][$x]["data"]["instant"]["details"]["air_temperature"];

        return ["kryptis" => $kryptis, "greitis" => $greitis, "gusiogreitis" => $gusiogreitis, "temperatura" => $temperatura];
    } else {
        echo "Error fetching data\n";
        return null; // or handle the error in a different way
    }
}


function degreeToCardinal($degree) {
    // Normalize the degree to be within the range [0, 360)
    $degree = fmod($degree, 360);

    if (0 <= $degree && $degree < 22.5 || $degree >= 337.5) {
        return "North";
    } elseif (22.5 <= $degree && $degree < 67.5) {
        return "Northeast";
    } elseif (67.5 <= $degree && $degree < 112.5) {
        return "East";
    } elseif (112.5 <= $degree && $degree < 157.5) {
        return "Southeast";
    } elseif (157.5 <= $degree && $degree < 202.5) {
        return "South";
    } elseif (202.5 <= $degree && $degree < 247.5) {
        return "Southwest";
    } elseif (247.5 <= $degree && $degree < 292.5) {
        return "West";
    } elseif (292.5 <= $degree && $degree < 337.5) {
        return "Northwest";
    } else {
        return "North";  // Handle the case where degree is close to 360
    }
}


// Example usage:

//$responseValues = getresponse($Panurl);



?>