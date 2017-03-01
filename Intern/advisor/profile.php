<?php
session_start();?>
<?php
if(isset($_POST['cancel'])){
	header("Location: /Precision/login.php");
}
?>
<html>
<head>
<title>
	Set Password
</title>
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
tfoot {color:red;}

</style>
</head>
<body>
<form method="POST" action="profile.php">
	<table>
	<tr><td colspan="2" ><center>Update Password </center></td></tr>
	<tr><td>OLD Password:-</td><td><input type="password" name="old"></td></tr>
	<tr><td>New Password:-</td><td><input type="password" name="first"></td></tr>
	<tr><td>Renter Password:-</td><td><input type="password" name="second"></td></tr>
	<tr><td colspan="2"><center><input type="submit" style="width:40%;"name="submit" value="Change!"><input type="submit" style="width:40%;" name="cancel" value="Back" ></center></td></tr>
	</table>
</form>
<?php 
if(isset($_POST['submit'])){
	include 'Mysql_connect.php';
	$sql = "SELECT id FROM emp where id=".$_SESSION["id"]." and password='".$_POST['old']."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		if($_POST['first']!=""){
			if($_POST['first']==$_POST['second']){
				$sql="update emp set password='".$_POST['first']."' where id=".$_SESSION['id'] ;
				echo '<script>alert("password updated");</script>';
				$result = $conn->query($sql);
			}else{
				echo $sql;
				echo '<script>alert("password doesnt match");</script>';
			}
		}else{
			echo $sql;
			echo '<script>alert("no password entered");</script>';
		}
	}else{
		echo $sql;
		echo '<script>alert("old password doesnt match");</script>';
	}
}?>
</body>
</html>