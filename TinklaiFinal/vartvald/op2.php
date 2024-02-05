<?php
$server = "localhost";
$db = "vartvald";
$user = "stud";
$password = "stud";
$lentele = "Oras";
$lentelereg = "Regionas";
$lenteleus = "users";
$lenteleats = "Ataskaita";


include("include/data.php");

// prisijungimas prie DB
$dbc=mysqli_connect($server,$user,$password, $db);
if(!$dbc){ die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc)); }
if (isset($_POST["ok"]))
{

}

?>

<!DOCTYPE html>
<html>
<head>
<title>Lab2</title>

<style>
	#zinutes {
 	   font-family: Arial; border-collapse: collapse; width: 70%; overflow-y: auto;height: 200px;
        height: 200px;
	}
	#zinutes td {
 	   border: 1px solid #ddd; padding: 8px;        position: sticky;   top: 0px;
      
	}
	#ROW2 {background-color: #FFFFFF;}
	#zinutes tr:hover {background-color: #ddd;
					}
	table tr#ROW1  {background-color:#2DC2BD;}
	.B1 {margin-right: 4px;}
	
	
</style>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
 </script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
</script>
	<link href="include/styles.css" rel="stylesheet" type="text/css" >
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="bg">
		<br><br><br>
		<div align="left">
        <br><br>
        <br><br>
		<button onclick="window.location.href='index.php';">
      	Grįžti į meniu
     	</button>
		</div>
		<br><br>
	
	
		<div class="container">
  	<form method='post'>
		
					<div class="form-group col-lg-6">
    				<label for="dropdown"style="color: white;">Pasirinkite Regioną:</label><br>
    				<select id="dropdown" name="dropdown">
        			<option value="Panevėžys">Panevėžys</option>
        			<option value="Alytus">Alytus</option>
        			<option value="Klaipėda">Klaipėda</option>
					<option value="Marijampolė">Marijampolė</option>
					<option value="Telšiai">Telšiai</option>		
    				</select>
					</div >
					
		
					<div class="form-group col-lg-6">
    				<label for="dropdowns"style="color: white;">Pasirinkite kryptį:</label><br>
    				<select id="dropdowns" name="dropdowns">
        			<option value="East">East</option>
        			<option value="North">North</option>
        			<option value="West">West</option>
					<option value="South">South</option>
					<option value="Northeast">Northeast</option>
					<option value="Nortwest">Nortwest</option>
					<option value="Southeast">Southeast</option>
					<option value="Southwest">Southwest</option>
    				</select>
					</div >
				
		

<div class="form-group col-lg-6" >
    <label for="wind-from" style="color: white;">Vėjo greitis nuo:</label><br>
    <input type="text" name="wind-from" pattern="[0-9]+(\.[0-9]+)?" title="Įveskite skaičių" oninvalid="this.setCustomValidity('Įveskite skaičių.')">
</div>

<div class="form-group col-lg-6">
    <label for="wind-to" style="color: white;">Vėjo greitis iki:</label><br>
    <input type="text" name="wind-to" pattern="[0-9]+(\.[0-9]+)?" title="Įveskite skaičių" oninvalid="this.setCustomValidity('Įveskite skaičių.')">
</div>

<div class="form-group col-lg-12">
    <label for="time" style="color: white;">Įveskite valandų skaičių per kurį seks duomenis</label><br>
    <input type="text" name="time" pattern="[0-9]+(\.[0-9]+)?" title="Įveskite skaičių" oninvalid="this.setCustomValidity('Įveskite skaičių.')">
</div>

      	<div class="form-group col-lg-12">
         	<input type='submit' name='ok' value='Gauti ataskaita' class="btnbtn-default">
      	</div>
	  
	  
  	</form>


	 
	</div>
		<?php
			

			
			
function getCityUrl($city) {
    switch ($city) {
        case "Panevėžys":
            return "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=55.737438&lon=24.370331";
        case "Alytus":
            return "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=54.395432&lon=24.046780";
        case "Klaipėda":
            return "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=55.710800&lon=21.131809";
        case "Marijampolė":
            return "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=54.557812&lon=23.349810";
        case "Telšiai":
            return "https://api.met.no/weatherapi/locationforecast/2.0/complete?lat=55.983582&lon=22.250811";
        default:
            return "";
    }
}
function generateWeatherReport($url, $startTime, $endTime) {
    $data = [];
    
    // Assuming $startTime and $endTime are valid indices for the timeseries array
    for ($x = $startTime; $x <= $endTime; $x++) {
        $weatherData = getresponse($url, $x);

        if ($weatherData !== null) {
            $kryptis = degreeToCardinal($weatherData["kryptis"]);
            $greitis = $weatherData["greitis"];
            $gusiogreitis = $weatherData["gusiogreitis"];
            $temperatura = $weatherData["temperatura"];
            $data[] = [
                "Laikas" => $data["properties"]["timeseries"][$x]["time"],
                "Vėjo kryptis" => $kryptis,
                "Vėjo greitis" => $greitis,
                "Gūsiai" => $gusiogreitis,
                "Oro temperatūra" => $temperatura,
            ];
        }
    }

    return $data;
}

			



	?>
	
	<center style="color: white;"><h3>Ataskaita</h3></center>
	<!--- o turinys bus formuojamas php nuskaičius lentelę-->
	
	<table style="margin: 0px auto;" id="zinutes">  
	    
		<tbody>
			<tr id="ROW1">
        	<td>Regionas</td>
			<td>Temperatura</td>
			<td>Kryptis</td>
			<td>Vėjo greitis (m/s)</td>
			<td>Laikas</td>
			</tr>
		

			<tr id="ROW1">
    		<td colspan="6">Darba atliko: Martynas Burneika</td>
    		</tr>
		</tbody>
		</table>
		<br>
		<br>
		<br>

</div>
</body>
</html>