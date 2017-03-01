<?php
	include 'Mysql_connect.php';
	$sql = "delete FROM job_card where card_id=".$_SESSION['jcid'];
	$result = $conn->query($sql);
	$sql = "delete FROM job_card_details where card_id=".$_SESSION['jcid'];
	$result = $conn->query($sql);
?>