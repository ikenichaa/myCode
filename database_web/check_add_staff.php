
<?php include_once 'dbconnect.php';
if (isset($_POST['regist']))
{
		echo 'hi<br>';
		echo 'hi<br>';

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		//$gender = $_POST['gender'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$position = $_POST['position'];
		$salary = $_POST['salary'];
		echo $firstname.'<br>';
		echo $lastname.'<br>';
		//echo $gender.'<br>';
		echo $telephone.'<br>';
		echo $email.'<br>';
		//echo $pass.'<br>';
		echo $address.'<br>';
	if (
					$firstname != "" &&
					$lastname != "" &&
					//$gender != "" &&
					$telephone != "" &&
					$address != "" &&
					$position != "" &&
					$salary != "" &&
					$email != ""
					//$pass != ""
					)
						{
							echo 'inhere';
							$q = "INSERT INTO LogIn(Email,Password,UserType) " .
							" VALUES('".$email."','1234','".$position."') ";
							$mysqli->query($q);

							$getUID = "SELECT UID FROM LogIn WHERE Email= '".$email."'";
							$res = $mysqli->query($getUID);
							$row = $res-> fetch_array();


							$t = "INSERT INTO staff(Firstname,Lastname, Tel,Address,Position,Salary,LogIn_UID) " .
							" VALUES('".$firstname."','".$lastname."','".$telephone."','".$address."','".$position."','".$salary."','".$row['UID']."') ";

/*
							$getCID = "SELECT CID FROM Customer WHERE LogIn_UID= '".$row['UID']."'";
							$result = $conn->query($getCID);
							$roww = $result-> fetch_array();
							echo $roww['CID'];

							$y = "INSERT INTO Address(Address,Customer_CID) " .
							" VALUES('".$address."','".$roww['CID']."') ";
*/
							if ($mysqli->query($t))
							{
								header("Location: Admin_staff_info.php");
							}


						}
				else{
				  $mysqli->connect_error;
					header("Location: check_info.php");
						}


}
?>
