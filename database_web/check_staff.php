<?php
include('dbconnect.php');
if (
    isset($_POST['firstname']) && strlen($_POST['firstname']) > 0 &&
    isset($_POST['lastname']) && strlen($_POST['lastname']) > 0 &&
    isset($_POST['telephone']) && strlen($_POST['telephone']) > 0 &&
    isset($_POST['subject']) && strlen($_POST['subject']) > 0 &&
    isset($_POST['email']) && strlen($_POST['email']) > 0 &&
    isset($_POST['position']) && strlen($_POST['position']) > 0 &&
    isset($_POST['salary']) && strlen($_POST['salary']) > 0
   )
   {
    $var1 = $mysqli->real_escape_string($_POST['firstname']);
    $var2 = $mysqli->real_escape_string($_POST['lastname']);
    $var3 = $mysqli->real_escape_string($_POST['telephone']);
    $var4 = $mysqli->real_escape_string($_POST['subject']);
    $var5 = $mysqli->real_escape_string($_POST['email']);
    $var6 = $mysqli->real_escape_string($_POST['position']);
    $var7 = $mysqli->real_escape_string($_POST['salary']);
    $staff = "staff";
    $q = "INSERT INTO LogIn(Email, UserType, Password)" .
    "VALUES('".$var5."','".$staff."','".$staff."')";

    if(!$mysqli->query($q)){
        echo "ERROR--->" . $q;
    }
    $getUID = "SELECT UID FROM LogIn WHERE Email='".$var5."'";
    $res = $mysqli->query($getUID);
    $row = $res->fetch_array();

    $t = "INSERT INTO staff(FirstName, LastName, Tel, Address, Position, Salary, LogIn_UID)" .
    "VALUES('".$var1."','".$var2."','".$var3."','".$var4."','".$var6."','".$var7."','".$row['UID']."')";
    if(!$mysqli->query($t)){
        echo "ERROR--->" . $t;
      }
    header("Location: Admin_staff_info.php");
    }

else{
  echo "register failed!!";
  echo"<a href='Admin_staff_info.html'>Go back to add staff</a>";
}


?>