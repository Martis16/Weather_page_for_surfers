<?php 
// forgotpass.php  jei nesiseka prisijungti
// is proclogin gauna:
// $_SESSION['name_login']  vartotojas
// $_SESSION['userid']  userid, bus slaptažodziui pirmi 4 simboliai
//                          !! jei e-paštu negaunate, atsirinkite 4 simbolius iš DB "userid" stulpelio
// $_SESSION['umail']   epaštas, kur pasiųsti 

session_start(); 
// cia sesijos kontrole
if (empty($_SESSION['name_login'])) { header("Location: logout.php");exit;}
  $_SESSION['prev'] = "forgotpass";



$vardenis = $_SESSION['name_login'];
$mailas = $_SESSION['umail'];
$role = $_SESSION['ulevel'];
$naujaspass = $_SESSION['name_login']; //Cia keiciasi slaptazodis ($_SESSION['userid'],0,4);----------------------------------------------------------
include("include/nustatymai.php");

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "INSERT INTO Naujas (vardas, pastas, role, naujasslapt, laikas) VALUES ('$vardenis', '$mailas', '$role', '$naujaspass', NOW())";
//echo $query;
// Assuming you have the connection object $db
if (mysqli_query($db, $query)) {
    
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}

 ?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Negali prisijungti</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
  <body>
  <div class="bg">
	  <br>  <br>  <br>  <br>  <br>  <br>  <br>
  <table class="center"><tr><td></td></tr><tr><td> 
       <table style="border-width: 2px; border-style: dotted;"><tr><td>
            Atgal į [<a href="index.php">Pradžia</a>]</td></tr>
  	   </table> 
   
       <div align="center">
       <table> <tr><td>     
           <center style="font-size:18pt;"><b>Vartotojas <?php echo $_SESSION['name_login']; ?> negali prisijungti</b></center>
           </td></tr>
           <tr><td>
            Jei paspausite "Tęsti" bus pakeistas slaptažodis.<br>
            Laikinas slaptažodis bus pasiųstas adresu <?php echo $_SESSION['umail']; ?><br><br>
                                                                                
            <table class="center">
              <form action="logout.php" method="POST">  
	               <p style="text-align:right;">
                 <input type="submit" name="login" value="Tęsti">    
                 </p>
              </form> 
            </table>
		</table>
	</table>
   </div>		  
   </body>
</html>




