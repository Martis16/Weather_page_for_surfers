<?php
// procregister.php tikrina registracijos reikšmes
// įvedimo laukų reikšmes issaugo $_SESSION['xxxx_login'], xxxx-name, pass, mail
// jei randa klaidų jas sužymi $_SESSION['xxxx_error']
// jei vardas, slaptažodis ir email tinka, įraso naują vartotoja į DB, nukreipia į index.php
// po klaidų- vel į register.php 

session_start(); 
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "register"))
{ header("Location: logout.php");exit;}

  include("include/nustatymai.php");
  include("include/functions.php");
 
  $_SESSION['name_error']="";
  $_SESSION['pass_error']="";
  $_SESSION['mail_error']="";
  $user=strtolower($_POST['user']);
  $_SESSION['name_login']=$user;
  $pass=$_POST['pass'];$_SESSION['pass_login']=$pass;
  $mail=$_POST['email'];$_SESSION['mail_login']=$mail;   
  $_SESSION['prev'] = "procregister";

        // registracijos formos lauku  kontrole
        if (checkname($user))
		{ // vardas  geras,  nuskaityti vartotoja is DB
      
		 list($dbuname)=checkdb($user);  //patikrinam DB       
         if ($dbuname)  {  // jau yra toks vartotojas DB
		     $_SESSION['name_error']= 
				 "<font size=\"2\" color=\"#ff0000\">* Tokiu vardu jau yra registruotas vartotojas</font>";
				 }
         else {  // gerai, vardas naujas
			   $_SESSION['name_error']= "";
		       if (checkpass($pass,substr(hash('sha256',$pass),5,32))  && checkmail($mail)) // antra tikrinimo dalis checkpass bus true
			{ // viskas tinka sukurti vartotojo irasa DB
		 $userid=md5(uniqid($user));                          //naudojam toki userid
		 $pass=substr(hash('sha256',$pass),5,32);     // DB password skirti 32 baitai, paimam is maisos vidurio 
		 if ($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL] ) $ulevel=$_POST['role'];  // jei registravo adminas, imam jo nurodyta role
		 else $ulevel=$user_roles[DEFAULT_LEVEL]; 

		 $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		 $sql = "INSERT INTO " . TBL_USERS. " (username, password, userid, userlevel, email,timestamp)
          VALUES ('$user', '$pass', '$userid','$ulevel', '$mail', null)";
		
		 if (mysqli_query($db, $sql)) 
		      {$_SESSION['message']="Registracija sėkminga";}
         else {$_SESSION['message']="DB registracijos klaida:" . $sql . "<br>" . mysqli_error($db);}
         
		  // uzregistruotas
     
           if ($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL] )  {header("Location:admin.php");} 
		   else {header("Location:index.php");}
				
		   exit;
          }
		}
		}
        // griztam taisyti
         // session_regenerate_id(true);
          header("Location:register.php");exit;
