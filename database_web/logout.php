<?php
session_start();
include ('dbconnect.php');
if (isset($_SESSION['s_id']))
			{
        $getID = $_SESSION['s_id'];
				echo ($getID);

        $up = "UPDATE LogIn SET LogInStatus = 'off' WHERE UID = $getID";
				$mysqli->query($up);
        session_destroy();
        
      }
      header("Location: home.php");
?>
