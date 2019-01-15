<?php
session_start();
include_once 'dbconnect.php';

if (isset($_POST['order']))
{
		echo 'hi<br>';
		echo 'hi<br>';
		$address_id = $_POST['address_id'];
    $getID = $_SESSION['s_id'];
    $q = "SELECT * FROM Customer WHERE Customer.LogIn_UID = $getID";
      $result=$mysqli->query($q);
      $row=$result->fetch_array();
    $cid = $row['CID'];
    $j = "SELECT (CURRENT_DATE) AS d";
      $res=$mysqli->query($j);
      $row2=$res->fetch_array();
    $day = $row2['d'];
		$k = "SELECT (CURRENT_TIME) AS t";
      $resu=$mysqli->query($k);
      $row3=$resu->fetch_array();
		$time = $row3['t'];
		echo $time.'<br>';
    echo $day.'<br>';
		$cal= $_SESSION['sumc'];
		$price= $_SESSION['sump'];
    $n = count($_SESSION['food']);
if ($_SESSION['sump']!=0){
		$in = "INSERT INTO `Order`(OrderDate,OrderTime,TotalPrice, TotalCal, Address_AddressID, Customer_CID) " .
		" VALUES('".$day."','".$time."','".$price."','".$cal."','".$address_id."','".$cid."') ";
		if ($mysqli->query($in))
		{
			echo 'yes';
			$oid = "SELECT OrderID FROM `ORDER` ORDER BY OrderID DESC LIMIT 1 ";
			if ($res4=$mysqli->query($oid))
			{
				$row4=$res4->fetch_array();
				$orderID = $row4['OrderID'];
			}

		}
	}

    if ($_SESSION['sump']!=0){
      echo "There is food";
      for ($i=0; $i < count($_SESSION['food']); $i++)
      {
        $pname= $_SESSION['food'][$i];
				$pquan= $_SESSION['quantity'][$i];

				$c0 ="SET @p0='".$orderID."'";
				$c1 ="SET @p1='".$pname."'";
				$c2 ="SET @p2='".$pquan."'";
				$c4 ="SET @p3=''";
				$c3 = "CALL add_orderdetail(@p0,@p1,@p2,@p3)";
				//echo @p0;

				$mysqli->query($c0);
				$mysqli->query($c1);
				$mysqli->query($c2);
				$mysqli->query($c3);
				$mysqli->query($c4);





      }
			header ("Location: assign_delivery.php");
			// header ("Location: in_order_delivery.php");
			// unset($_SESSION['food']);
			// unset($_SESSION['quantity']);
			// unset($_SESSION['price']);
			// unset($_SESSION['cal']);
			// unset($_SESSION['sumc']);
			// unset($_SESSION['sump']);
    }
    else {
      echo "There is no food";
			header ("Location: in_shopping.php");
    }



}
?>
<html>
<head>
	<title> Confirm Order</title>
</head>
</html>
