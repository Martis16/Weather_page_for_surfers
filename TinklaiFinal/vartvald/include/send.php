<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);



$server = "localhost";
$db = "vartvald";
$user = "stud";
$password = "stud";
$lentele = "Oras";




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
    		$kryptis = $data["properties"]["timeseries"][3]["data"]["instant"]["details"]["wind_from_direction"];
    		$gusiogreitis = $data["properties"]["timeseries"][3]["data"]["instant"]["details"]["wind_speed_of_gust"];
			$greitis = $data["properties"]["timeseries"][3]["data"]["instant"]["details"]["wind_speed"];
			echo "Temperature: {$kryptis}°C\n";
    		echo "Humidity: {$gusiogreitis}%\n";
			echo "Humidity: {$greitis}%\n";
		} else {
    		echo "Error fetching data\n";
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


$direction = degreeToCardinal($kryptis);


// prisijungimas prie DB
$dbc=mysqli_connect($server,$user,$password, $db);
if(!$dbc){ die ("Negaliu prisijungti prie MySQL:"	.mysqli_connect_error()); }
if (isset($_POST["Ok"]))
{
	$miestas = $_POST["dropdown"];
	echo $miestas;
	$direction = degreeToCardinal($kryptis);
	
	$sql = "INSERT INTO $lentele (Kryptis, Greitis, Miestas, Gusiogreitis) VALUES ('$direction','$greitis', '$miestas', '$gusiogreitis')";
	
	
	if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
	echo "SQL Query: $sql";
    //echo "Įrašyta";	
    header('Location: index.php');
    exit();
}

?>