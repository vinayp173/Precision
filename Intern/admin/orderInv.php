<?php
session_start();
	if(isset($_POST['lower'])){

		$_SESSION['low']=$_POST['lower'];
	}else if(isset($_SESSION['low'])){
	}else{
		$_SESSION['low']="";
	}
	if(isset($_SESSION['check'])){
	}else{
		$_SESSION['check']="";
	}
?><?php
if(isset($_POST['cancel'])){
	header("Location: Adminhp.php");
}
?>
<html>
<head>
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

#header {
    position:fixed;
    top:0;
    width:100%;
    height:10%;   
    background:#6cf;
	position: fixed;
	display: block;
}
</style>
</head>
<body>
<form action="orderInv.php" method="post">
<div id="header" >
<center>
Enter minimum limit:-<input type="number" name="lower" id="lower" value="<?php echo $_SESSION['low'];?>"style="width:35%;">
<input type="submit" name="apply" id="apply" value="Apply" style="width:20%;">
<br>
Enter number of Order :-<input type="number" name="or" id="or" style="width:35%;">
<br>
<input type="submit" name="selAll" id="selAll" value="SELECT ALL" style="width:20%;">

<input type="submit" name="order" id="order" value="order Selected" style="width:20%;">
<input type="submit" style="width:20%;" name="cancel" value="Back" >
</center>
</div>
<div style="margin-top:12%;">

<?php

	if(isset($_POST['apply'])){
		include 'Mysql_connect.php';
		$sql = "SELECT * FROM inventory where quantity<=".$_POST['lower'];
		$result = $conn->query($sql);
		$num=$result->num_rows;
		$_SESSION['low']=$_POST['lower'];
		echo '<table>';
		echo '<tr><td></td><td>Inventory Id </td><td>Name</td><td>Price</td><td>Quantity</td></tr>';
		if ( $num> 0) {
			while($row = $result->fetch_assoc()){
				echo '<tr>';
				echo "<td><input type='checkbox'  name='srnop[]' id='srnop' value='".$row['inventory_id']."' ".$_SESSION['check']."></td>";
				echo '<td>'.$row['inventory_id']."</td>";
				echo '<td>'.$row['Name']."</td>";
				echo '<td>'.$row['Current price']."</td>";
				echo '<td>'.$row['quantity']."</td>";
				echo '</tr>';
			}
		}
		echo '</table>';
	}else if($_SESSION['low']!=""){
		include 'Mysql_connect.php';
		$sql = "SELECT * FROM inventory where quantity<=".$_SESSION['low'];
		$result = $conn->query($sql);
		$num=$result->num_rows;
		echo '<table>';
		echo '<tr><td></td><td>Inventory Id </td><td>Name</td><td>Price</td><td>Quantity</td></tr>';
		if ( $num> 0) {
			while($row = $result->fetch_assoc()){
				echo '<tr>';
				echo "<td><input type='checkbox' name='srnop[]' id='srnop' value='".$row['inventory_id']."' ".$_SESSION['check']."></td>";
				echo '<td>'.$row['inventory_id']."</td>";
				echo '<td>'.$row['Name']."</td>";
				echo '<td>'.$row['Current price']."</td>";
				echo '<td>'.$row['quantity']."</td>";
				echo '</tr>';
			}
		}
		echo '</table>';
	}
	
	if(isset($_POST['order'])&&!empty($_POST['srnop'])){
		$quantity=$_POST['or'];
		include 'Mysql_connect.php';
		foreach ($_POST['srnop'] as $hobys=>$value) {
				$sql = "update inventory set quantity=quantity+".$quantity." where inventory_id='".$value."'";
				$result = $conn->query($sql);
		}
		header("Location: redirectOrder.php");

	}
	if(isset($_POST['selAll'])){
		if($_SESSION['check']=="checked"){
			$_SESSION['check']="unchecked";
		}else{
			$_SESSION['check']="checked";
		}
		header("Location: redirectOrder.php");
	}
?>
</script>
</div>
</form>
</body>
</html>