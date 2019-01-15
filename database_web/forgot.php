<?php
include_once 'dbconnect.php';
// on top
$mes='';
if (isset($_POST['checkthemail']))
{
  $mail = trim($_POST['email']);
  if ($mail!="")
  {
    $w = "SELECT COUNT(*) AS c FROM LogIn WHERE Email='$mail'";

		$result = $mysqli->query($w);
		$row = $result-> fetch_array();
		if ($row['c']=='1')
		{
			header("Location: check_mail.php");
		}
		else {
			$mes='This mail has not been registered yet';
		}
  }
}
?>
<html>
<head>
<title> forget password </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="database.css">
</head>
<body>
  <div class="del">
  <!-- Navigation-->
    <?php include 'header_front.php';?>
<!--Body-->
<div class="container">

  <div class="row">

    <div class="column">
      <h2>Password Recovery</h2><hr><br>
      <form action="forgot.php" method="POST">

        <label for="tel">Email</label>
        <input type="text" id="email" name="email" placeholder="e-mail">
        <label><font color="red"><?php echo $mes?></font></label>
        <input type="submit" id="signin" name="checkthemail" value="Submit">


      </form>
    </div>
  </div>
</div>


</div>
</body>
</html>
