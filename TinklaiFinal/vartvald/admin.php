<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]))   { header("Location: logout.php");exit;}
$_SESSION['prev']="admin";
date_default_timezone_set("Europe/Vilnius");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Administratoriaus sąsaja</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
		<div class="bg">
			<br><br><br>
        <table class="center" ><tr><td>
            
            </td></tr><tr><td>
		<center><font size="5">Vartotojų registracija, peržiūra ir įgaliojimų keitimas</font></center></td></tr></table> <br>
		<center><b><?php echo $_SESSION['message']; ?></b></center>
		<form name="vartotojai" action="procadmin.php" method="post">
	    <table class="center" style=" width:75%; border-width: 2px; border-style: solid;">
		         <tr><td width=30%><a href="index.php">[Atgal]</a></td><td width=30%> 
	<?php
		   if ($uregister != "self") echo "<a href=\"register.php\"><b>Registruoti naują vartotoją<b></a><td>";
		   else echo "</td>";
	?>
		   
			<td width="30%">Atlikite reikalingus pakeitimus ir</td><td width="10%"> <input type="submit" value="Vykdyti"></td></tr></table> <br> 
<?php
    
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT username,userlevel,email,timestamp "
            . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
?>
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vartotojo vardas</b></td><td><b>Rolė</b></td><td><b>E-paštas</b></td><td><b>Paskutinį kartą aktyvus</b></td><td><b>Šalinti?</b></td></tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
	{	 
	    $level=$row['userlevel']; 
	  	$user= $row['username'];
	  	$email = $row['email'];
      	$time = date("Y-m-d G:i", strtotime($row['timestamp']));
      	echo "<tr><td>".$user. "</td><td>";
    	echo "<select name=\"role_".$user."\">";
      	$yra=false;
		foreach($user_roles as $x=>$x_value)
  			{echo "<option ";
        	 if ($x_value == $level) {$yra=true;echo "selected ";}
             echo "value=\"".$x_value."\" ";
         	 echo ">".$x."</option>";
        	 }
		if (!$yra)
        {echo "<option selected value=".$level.">Neegzistuoja=".$level."</option>";}
        $UZBLOKUOTAS=UZBLOKUOTAS; echo "<option ";
        if ($level == UZBLOKUOTAS) echo "selected ";
          echo "value=".$UZBLOKUOTAS." ";
        echo ">Užblokuotas</option>";      // papildoma opcija
      echo "</select></td>";
          
      echo "<td>".$email."</td><td>".$time."</td>";
      echo "<td><input type=\"checkbox\" name=\"naikinti_".$user."\">";
   }
?>
        </table>
        <br> <input type="submit" value="Vykdyti">
		</form> 
        
		<br><br>	
		<table class="center" ><tr><td>
            
        </td></tr><tr><td>
		
		<center><font size="4">Vartotojų slaptažodžių atnaujinimas</font></center></td></tr></table> <br>
<form action="newpass.php" method="POST"> 

<table class="center" border="1" cellspacing="0" cellpadding="3">
    <tr>
        <td><b>Vartotojo vardas</b></td>
        <td><b>Rolė</b></td>
        <td><b>E-paštas</b></td>
        <td><b>Naujas slaptažodis</b></td>
		<td><b>Laikas</b></td>
		<td><b>Atnaujinti?</b></td>
    </tr>
	    <?php
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // Assuming you're using PHP and have a database connection
    $query = "SELECT vardas, role, pastas, naujasslapt, laikas FROM Naujas";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
		
        echo "<td>" . $row['vardas'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td>" . $row['pastas'] . "</td>";
        echo "<td>" . $row['naujasslapt'] . "</td>";
		echo "<td>" . $row['laikas'] . "</td>";
		echo "<td><input type='checkbox' name='selected_rows[]' value='" . $row['vardas'] . "|" . $row['pastas'] . "'></td>";
        echo "</tr>";
    }
    ?>

             
              
	                <p style="text-align:center;">
                  <input type="submit" name="login" value="Tęsti">    
                  </p>
               
            </table>
		</form> 
		
		</div>
    </body>
</html>
