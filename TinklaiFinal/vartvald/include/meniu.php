<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";

if (isset($_GET['gauti_duomenis'])) {
    header("Location: op1.php");
    exit();
}

{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=25% border=\"0\" cellspacing=\"5\" cellpadding=\"8\" class=\"center\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "[<a href=\"op1.php?gauti_duomenis=1\">Gauti Duomenis</a>] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "[<a href=\"op2.php\">Gauti ataskaitas</a>] &nbsp;&nbsp;";
     //Trečia operacija galima tik aukštesnių userlevel vartotojams , čia >=5:
        if ($userlevel >=5 ) {
            echo "<center><br>[<a href=\"op3.php\">Įkelti duomenis</a>]</center> &nbsp;&nbsp;";
       		}

  
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "<center><br>[<a href=\"admin.php\">Administratoriaus sąsaja</a>] </center>&nbsp;&nbsp;";
        }
        echo "<br><br><center>[<a href=\"logout.php\">Atsijungti</a>]</center>";
      echo "</td></tr></table>";
?>       
