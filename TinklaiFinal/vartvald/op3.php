

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);



$server = "localhost";
$db = "vartvald";
$user = "stud";
$password = "stud";
$lentele = "Oras";



// prisijungimas prie DB
$dbc=mysqli_connect($server,$user,$password, $db);
if(!$dbc){ die ("Negaliu prisijungti prie MySQL:"	.mysqli_connect_error()); }



include("include/data.php");
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
		<br><br>
	
	
		<div class="container">
  	<form method='post'>

       	<div class="form-group col-lg-16">
            <input type="submit" name="ok" value="Gauti duomenis apie orus" class="btn btn-default">
        </div>
	  
  	</form>	 
	</div>
	
	<center><h3>Orai</h3></center>
	<!--- o turinys bus formuojamas php nuskaičius lentelę-->
<form method='post' action='op3.php'>
    <table style="margin: 0px auto;" id="zinutes">  
        <tbody>
            <tr id="ROW1">
                <td>Kryptis</td>
                <td>Miestas</td>
                <td>Vėjo greitis (m/s)</td>
                <td>Gūsių greitis (m/s)</td>
                <td>Įkelti</td>
            </tr>
<?php
function getWeatherData($url, $miestas) {
    $responseValues = getresponse($url, 3);
    $Kryptiss = $responseValues["kryptis"];
    $Kryptis = degreeToCardinal($Kryptiss);
    $Greitis = $responseValues["greitis"];
    $Gusiogreitis = $responseValues["gusiogreitis"];
    return "<tr id='ROW2'>
                <td>" . $Kryptis . "</td> 
                <td>" . $miestas . "</td>
                <td>" . $Greitis . "</td>        
                <td>" . $Gusiogreitis . "</td>
				<td><input type='checkbox' name='selectedRows[]' value='" . $Kryptis . "|" . $miestas . "|" . $Greitis . "|" . $Gusiogreitis . "'></td>
            </tr>";
	
}			

if (isset($_POST["ok"])) {
	
	
    $Panevezys = getWeatherData($Panurl, "Panevėžys");
    $Alytus = getWeatherData($Alurl, "Alytus");
	$Marijampole = getWeatherData($Marurl, "Marijampolė");
    $Telsiai = getWeatherData($Telurl, "Telšiai");
	$Klaipeda = getWeatherData($Klaiurl, "Klaipėda");

	    // Check if all requests were successful (you can customize this condition based on your requirements)
    if ($Panevezys && $Alytus && $Marijampole && $Telsiai && $Klaipeda) {
        echo '<span style="color: green; font-weight: bold;">duomenys gauti</span>';
    }
	
    echo $Panevezys;
    echo $Alytus;
	echo $Marijampole;
	echo $Telsiai;
	echo $Klaipeda;

    //header('Location: op3.php');
    //exit();
}
			
			
			
if (isset($_POST["upload"]) && isset($_POST["selectedRows"])) {
    $selectedRows = $_POST["selectedRows"];

	//var_dump(count($selectedRows));
	//var_dump($selectedRows);
	//$mysqli->set_charset("utf8mb4");
    // Assuming you have a database connection
	if (count($selectedRows) == 0) {
		echo '<center><p style="font-weight: bold; color: red;">išsiųsta 0 duomenų</p></center>';
    }else {
    foreach ($selectedRows as $row) {
        list($Kryptis, $miestas, $Greitis, $Gusiogreitis) = explode("|", $row);

        // Assuming $conn is your database connection
        $checkQuery = "SELECT * FROM Oras WHERE miestas = '$miestas'";
        $result = mysqli_query($dbc, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // If the same "miestas" exists, delete the existing row
            $deleteQuery = "DELETE FROM Oras WHERE miestas = '$miestas'";
            mysqli_query($dbc, $deleteQuery);
        }
        // Insert the new row
        $insertQuery = "INSERT INTO Oras (kryptis, miestas, greitis, gusiogreitis) VALUES ('$Kryptis', '$miestas', '$Greitis', '$Gusiogreitis')";
        mysqli_query($dbc, $insertQuery);
    }
	        $numSelectedRows = count($selectedRows);
			echo '<p style="font-weight: bold; color: red;">išsiųsti ' . $numSelectedRows . ' duomenų</p>';
			

    // Redirect to op3.php or wherever you need to go next
    //header('Location: op3.php');
    exit();
		}
}elseif (isset($_POST["upload"])){
			
			echo '<center><p style="font-weight: bold; color: red;">išsiųsta 0 duomenų</p></center>';
			
			}
			
		

?>
			
        </tbody>
    </table>
	<br><br><br>
    <div class="container">
        <div class="form-group col-lg-16">
            <input type="submit" name="upload" value="Siųsti duomenis" class="btn btn-default">
        </div>
    </div>
</form>
	<br>



</div>
</body>
</html>