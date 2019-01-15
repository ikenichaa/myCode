<?php
session_start();
include_once 'dbconnect.php';
echo 'hi';
	$q = "SELECT * FROM v_delivery WHERE Deliver_time IS NULL";
	$result=$mysqli->query($q);
	$row=$result->fetch_array();
	var_dump ($row['SID']);
	if ($row['SID']!=''){
		$staff=$row['SID'];
	}
	else
	{
		echo 'No more null';
		$q4 = "SELECT MIN(C) FROM (SELECT COUNT(Deliver_time) AS C FROM v_delivery GROUP BY SID)x";
		$result4=$mysqli->query($q4);
		$row4=$result4->fetch_array();
		$min= $row4['MIN(C)'];
		echo ($min);

		$q5 = "SELECT SID FROM v_delivery WHERE Deliver_time =$min";
		$result5=$mysqli->query($q5);
		$row5=$result5->fetch_array();
		$staff=$row5['SID'];



	}


	$q1 = "SELECT CURRENT_DATE AS d";
	$result1=$mysqli->query($q1);
	$row1=$result1->fetch_array();
	var_dump ($row1['d']);

	$q2 = "SELECT CURRENT_TIME AS t";
	$result2=$mysqli->query($q2);
	$row2=$result2->fetch_array();
	var_dump ($row2['t']);

	$oid = "SELECT OrderID AS o FROM `ORDER` ORDER BY OrderID DESC LIMIT 1 ";
	$result3=$mysqli->query($oid);
	$row3=$result3->fetch_array();
	var_dump ($row3['o']);





	$q3 = "INSERT INTO Delivery(DeliveryDate,DeliveryTime, Order_OrderID, Staff_SID)
	VALUES ('".$row1['d']."','".$row2['t']."','".$row3['o']."','".$staff."') ";
	$mysqli->query($q3);

	header ("Location: in_order_delivery.php");
	unset($_SESSION['food']);
	unset($_SESSION['quantity']);
	unset($_SESSION['price']);
	unset($_SESSION['cal']);
	unset($_SESSION['sumc']);
	unset($_SESSION['sump']);








?>
