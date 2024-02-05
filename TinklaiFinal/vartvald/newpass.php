<?php 
// newpass.php 
// iš proclogin per forgotpass.php gauna:
// $_SESSION['name_login']  vartotojas
// $_SESSION['userid']   id, bus slaptažodžiui pirmi 4 simboliai
//                          !! jei e-paštu negaunate, atsirinkite 4 simbolius iš DB "userid" stulpelio
// $_SESSION['umail']   epaštas, kur pasiųsti 

session_start(); 
// cia sesijos kontrole
//if (empty($_SESSION['name_login'])) { header("Location: logout.php");exit;}

$_SESSION['prev'] = "newpass";
include("include/nustatymai.php");
$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$vardenis = $_SESSION['name_login'];
$mailas = $_SESSION['umail'];
$role = $_SESSION['ulevel'];
$naujaspass = "slaptas"; //Cia keiciasi slaptazodis ($_SESSION['userid'],0,4);----------------------------------------------------------
$passdb=substr(hash('sha256', $naujaspass),5,32);
//$user=$_SESSION['name_login'];



    if(isset($_POST['selected_rows'])){
        foreach($_POST['selected_rows'] as $user_info){
            // Split the values using the pipe character
            list($username, $email) = explode('|', $user_info);

            // Now you can use $username and $email separately
            $username = mysqli_real_escape_string($db, $username);
            $email = mysqli_real_escape_string($db, $email);

            // Perform your DELETE query or any other operations
            $query = "DELETE FROM Naujas WHERE vardas = '$username' AND pastas = '$email'";
			
            mysqli_query($db, $query);
			
			$sql = "UPDATE ". TBL_USERS." SET password='$passdb' WHERE username='$username'";
			if (!mysqli_query($db, $sql)) {
            	echo " DB klaida keiciant slaptazodi: " . $sql . "<br>" . mysqli_error($db);
		    	exit;}
        }
    }


// pakeiciam slaptazodi DB
		
         //$sql = "UPDATE ". TBL_USERS." SET password='$passdb' WHERE username='$user'";
		
		 //if (!mysqli_query($db, $sql)) {
         //    echo " DB klaida keiciant slaptazodi: " . $sql . "<br>" . mysqli_error($db);
		 //    exit;}

// siunciam
//$to      = $_SESSION['umail'];
//$subject = "T120B145 demo projektas - laikinas slaptažodis";
//$message = $user . ",\n\n"
//                . "Jūsų laikinas slaptažodis:\n\n"
 //               . "Vartotojo vardas: " . $user . "\n"
//                . "Naujas slaptažodis: " . $naujaspass . "\n\n";
//$headers = "From: " . EMAIL_FROM_NAME . " <" . EMAIL_FROM_ADDR . ">\r\n";
//$headers .= "Content-type: text; charset=UTF-8\r\n";
//mail($to, $subject, $message, $headers);
?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Pamirštas slaptažodis</title>
    <link href="include/styles.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="bg">
      <br> <br> <br> <br>
      <table class="center">
		          <tr>
          <td>
          </td>
        </tr>
        <tr>
          <td>
            <div align="center">
              <font size="4" color="#ff0000"> Slaptažodžiai atnaujinti </font> <br> 
              <table class="center">
                <form action="admin.php" method="POST">
                  <p style="text-align:center;">
                    <input type="submit" name="login" value="Tęsti">
                  </p>
                </form>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
