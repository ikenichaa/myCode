<?php

	require_once('dbconnect.php');
	
	$OID = $_GET['OID'];
	$getStatus = "SELECT orderStatus FROM `order` WHERE OrderID = '".$OID."'";
	$res = $conn->query($getStatus);
	$row = $res-> fetch_array();
	
	
	$status = $row['orderStatus'];
	
	if($status == 'cooking'){
	
		$q = "update `order` set orderStatus = 'delivery' where orderID=$OID";
		
		if(!$conn->query($q)){
			echo "Update failed: ". $conn->error;
		}
		else{
			header("Location: Admin_order.php");
		}
	}
	else if($status == 'delivery'){
	
		$q = "update `order` set orderStatus = 'success' where orderID=$OID";
		
		if(!$conn->query($q)){
			echo "Update failed: ". $conn->error;
		}
		else{
			header("Location: Admin_order.php");
		}
	}
	else{
		header("Location: Admin_order.php");
	}
	
	
?>