<?php
session_start();
$server = "localhost";
$db = "vartvald";
$user = "stud";
$password = "stud";
$lentele = "Oras";
$lentelereg = "Regionas";
$lenteleus = "users";


// prisijungimas prie DB
$dbc=mysqli_connect($server,$user,$password, $db);
if(!$dbc){ die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc)); }
$vardas = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
<title>Lab2</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
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
  <meta charset="utf-8">
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
    <input type="text" name="wind-from" pattern="[0-9]+(\.[0-9]+)?" title="Įveskite skaičių" >
</div>

<div class="form-group col-lg-6">
    <label for="wind-to" style="color: white;">Vėjo greitis iki:</label><br>
    <input type="text" name="wind-to" pattern="[0-9]+(\.[0-9]+)?" title="Įveskite skaičių" >
</div>
		
<div class="form-group col-lg-6">
    <label for="gust-from" style="color: white;">Gūsio greitis nuo:</label><br>
    <input type="text" name="gust-from" pattern="[0-9]+(\.[0-9]+)?" title="Įveskite skaičių" >
</div>

<div class="form-group col-lg-6">
    <label for="gust-to" style="color: white;">Gūsio greitis iki:</label><br>
    <input type="text" name="gust-to" pattern="[0-9]+(\.[0-9]+)?" title="Įveskite skaičių" >
</div>


<div class="form-group">
    <input type="submit" name="ok" value="Pateikti užklausa" class="btn btn-default">
</div>
  	</form>

	 
</div>
	
	

	
	
	
	
	
	<center><h3 style="color: white;">Orai</h3></center>
	<!--- o turinys bus formuojamas php nuskaičius lentelę-->
	
	<table style="margin: 0px auto;" id="zinutes">  
	    
		<tbody>
			<tr id="ROW1">
        	<td>Miestas</td>
        	<td>Kryptis</td>
			<td>Vėjo Greitis</td>
			<td>Gūsio Greitis</td>
			
			</tr>
		
	<?php

if (isset($_POST["ok"]))
{
if (empty($_POST["dropdown"]) || empty($_POST["dropdowns"]) || $_POST["wind-from"]== "" || $_POST["wind-to"]== "" || $_POST["gust-from"]== "" || $_POST["gust-to"]== "") {
        echo '<center><div style="width: 200px; height: 30px; background-color: white; color: red; font-weight: bold;">Įveskite visus duomenis</div></center>';
    } else {
	$Region = $_POST["dropdown"];
    $Direction = $_POST["dropdowns"];
    $windFrom = $_POST["wind-from"];
    $windTo = $_POST["wind-to"];
    $gustFrom = $_POST["gust-from"];
    $gustTo = $_POST["gust-to"];
	
	
	 $sql = "INSERT INTO Uzklausa (miestas, kryptis, vnuo, viki, gnuo, giki, vardas) VALUES ('$Region', '$Direction', '$windFrom', '$windTo', '$gustFrom', '$gustTo', '$vardas')";
	 $result = mysqli_query($dbc, $sql);


        // else {
        // Handle the case where the query fails
        //echo "<span style=\"color: red; font-size: larger;\">Nesuvesti duomenys</span>";
    	
 }
	
}
			
if (isset($_POST["atnaujinti"]))
{
	
$selectOrasQuery = "SELECT * FROM Oras";
$resultOras = mysqli_query($dbc, $selectOrasQuery);

// Retrieve data from the Uzklausa table
$selectUzklausaQuery = "SELECT * FROM Uzklausa";
$resultUzklausa = mysqli_query($dbc, $selectUzklausaQuery);
	
	if ($resultOras && $resultUzklausa) {

		while ($dataUzklausa = mysqli_fetch_assoc($resultUzklausa)) {
        // Fetch data from the Uzklausa result set
        $vnuo = floatval($dataUzklausa['vnuo']);
        $gnuo = floatval($dataUzklausa['gnuo']);
        $giki = floatval($dataUzklausa['giki']);
		 // Reset Oras result set pointer to the beginning for each Uzklausa row
        mysqli_data_seek($resultOras, 0);

        while ($dataOras = mysqli_fetch_assoc($resultOras)) {
            // Fetch data from the Oras result set
            $greitis = floatval($dataOras['greitis']);
            $gusiogreitis = floatval($dataOras['gusiogreitis']);
          // Compare values
            if (
                ($dataUzklausa['kryptis'] == $dataOras['kryptis']) &&
                ($dataUzklausa['miestas'] == $dataOras['miestas']) &&
                ($vnuo < $greitis && $greitis < $giki) &&
                ($gnuo < $gusiogreitis && $gusiogreitis < $giki) &&
                ($dataUzklausa['vardas'] == $vardas)
            ) {
                // Values match
                $kry = $dataOras['kryptis'];
                $mie = $dataOras['miestas'];
                $vej = $dataOras['greitis'];
                $gus = $dataOras['gusiogreitis'];
                $var = $dataUzklausa['vardas'];

                echo '<tr id=ROW2>';
                echo '<td>' . $mie . '</td>';
                echo '<td>' . $kry . '</td>';
                echo '<td>' . $vej . '</td>';
                echo '<td>' . $gus . '</td>';
                echo '</tr>';
            }
        }
    }
	// Close result sets
    mysqli_free_result($resultOras);
    mysqli_free_result($resultUzklausa);
		
} else {
    // Handle query errors
    echo "Error in executing one of the queries.";
}

}		
	?>
			<tr id="ROW1">
    		<td colspan="5">Darba atliko: Martynas Burneika</td>
    		</tr>
		</tbody>
		</table>
		<br>
		<br>
		<br>
	<form method='post'>
	<div class="form-group">
    <input type="submit" name="atnaujinti" value="Atnaujinti" class="btn btn-default">
</div>
  	</form>

</div>
	
</body>
</html>