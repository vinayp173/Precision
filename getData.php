<?php
session_start();?>
<?php
	if(isset($_POST['submit'])){
		include 'Mysql_connect.php';
		$sql = "select card_id from job_card where card_id=".$_POST['jc'];
		$result=$conn->query($sql);
		if($result->num_rows>0){
			$_SESSION['jid']=$_POST['jc'];
			header("Location: Ro.php");
		}else{
			echo'<script>alert("no Job card with ID:-'.$_POST['jc'].'")</script>';
		}
	}
	
?>
<html>
<head>
<link rel="stylesheet" href="commonCSS.css">
<style>
table {
    border:1px solid black;
    width: 100%;
}

th, td {
    text-align: left;
	border:1px solid black;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>
<form action ="getData.php" method="POST">
	<div id="borderdiv" style="margin-left:5%;" >
		<table>
			<tr><td>Job card ID</td><td><input type="number" name="jc" id="jc"></td></tr>
			<tr><td colspan="2"><center><input type="submit" name="submit" id="submit"></center></td></tr>
		</table>
	</div>
</form>
</body>
</html>