
<?php
session_start();// on top
//session_destroy();
// session_destroy();
if(isset($_SESSION['s_role'])){
		if ($_SESSION['s_role'] == 'Admin')
	{
		header("Location: Admin_customer_info.php");
	}
	else if ($_SESSION['s_role'] == 'Delivery Staff')
	{
		header("Location: Delivery_order.php");

	}

	else if ($_SESSION['s_role'] == 'Customer')
	{
		header("Location: in_home.php");

	}
} else {
	$mes='';
	if (isset($_POST['u_login']))
	{
		$l_user = trim($_POST['email']);
		$l = trim($_POST['pass']);

		$l_pass = MD5($l);
		//echo ($l);
		//echo '<br>';
		//echo ($l_pass);

		//$l_pass = trim($_POST['pass']);



		if ($l_user != "" && $l_pass !="")
		{
			$q = "SELECT * FROM LogIn ".
			"WHERE Email='".$l_user."' AND Password='".$l_pass."'";

			require_once('dbconnect.php');

			if ($res = $mysqli->query($q))
			{
				if (mysqli_num_rows($res) == 1)
				{
					$row = $res-> fetch_array();



					$_SESSION['s_id'] = $row['UID'];
					$_SESSION['s_role'] = $row['UserType'];

					$_SESSION['food'] = array();
					$_SESSION['quantity'] = array();
					$_SESSION['price'] = array();
					$_SESSION['cal'] = array();
					$_SESSION['sumc'] = 0;
					$_SESSION['sumd'] = 0;


					$up = "UPDATE LogIn SET LogInStatus = 'on'" ."WHERE UID ='".$row['UID']."'";
					$mysqli->query($up);

					if ($_SESSION['s_role'] == 'Admin')
					{
					header("Location: Admin_customer_info.php");
					}
					else if ($_SESSION['s_role'] == 'Delivery Staff')
					{
						// echo "<script>alert('".test."')</script>";
						header("Location: Delivery_order.php");

					}

					else if ($_SESSION['s_role'] == 'Customer')
					{
						header("Location: in_home.php");

					}

				}
				else{
					$mes='Invalid Email or Password. Please Try Again';
				}
			}

		}

	}
}



?>

<html>
<head>
<title> log in </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
</head>
<body>
  <div class="del">
  <!-- Navigation-->
    <?php include 'header_front.php';?>
    <!-- Contact us-->
        <div class="container">

          <div class="row">

            <div class="column">
              <h2>LOG IN</h2><hr><br>
              <form action="login.php" method="POST">
                <label>Email</label>
                <input type="text" name="email" placeholder="Email">
                <label>password</label>
                <input type="password" name="pass" placeholder="password">
                <label><font color="red"><?php echo $mes?></font></label>

            <input type="submit" id="signin" name="u_login" value="Sign In"><hr>
            <p style="color: #9494b8"> <a href="forgot.php" style="color: #9494b8">forgot password?</a> or
              <a href="signup.php" style="color: #9494b8">sign up</a>
              </p>

              </form>
            </div>
          </div>
        </div>
</div>
</body>
</html>
