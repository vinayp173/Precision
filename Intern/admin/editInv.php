<?php
	session_start();
	if(isset($_POST['jid'])){
		$_SESSION['jid']=$_POST['jid'];
	}else if(isset($_SESSION['jid'])){
		//do nothing
	}else{
		$_SESSION['jid']="";
	}
?>
<?php
	if(isset($_POST['cancel'])){
		$_SESSION['jid']="";
		header("Location: Adminhp.php");
	}
	if(isset($_POST['submit'])){
		include 'Mysql_connect.php';
		if($_POST['nprice']!=0 && $_POST['nquantity']!=0){
			$sql = "update inventory set `old price`=".$_SESSION['oldPrice'].",`Current price`=".$_POST['nprice'].",quantity=".$_POST['nquantity']." where inventory_id='".$_POST['jid']."'";
		}else if($_POST['nprice']!=0){
			$sql = "update inventory set `old price`=".$_SESSION['oldPrice'].",`Current price`=".$_POST['nprice']." where inventory_id='".$_POST['jid']."'";
		}else if($_POST['nquantity']!=0){
			$sql = "update inventory set quantity=".$_POST['nquantity']." where inventory_id='".$_POST['jid']."'";
		}
		$result = $conn->query($sql);
	}
?> 
 <html>
 <head>
 <title>
	Edit Inventory
 </title>
 <link rel="stylesheet" href="commonCSS.css">
	<style>
	table {
		border:1px solid black;
		width: 100%;
	}

	th, td {
		text-align: center;
		border:1px solid black;
		padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2}
	</style>
 </head>
 <body>
	<div>
	<form action="editInv.php" method="post">
	<br><br>
	<table>
		<tr><td>Inventory ID</td><td><input type="text" name="jid" id="jid" value="<?php echo $_SESSION['jid'];?>" style="width:60%;"></td></tr>
		<tr><td colspan="2"><center><input type="submit" name="search" value="search"style="width:70%;"></center></td></tr>
	</table>
	<div id="borderdiv" style="margin-top:5%;margin-left:3%;" >
		<?php 
			if($_SESSION['jid']!=""){
				echo '<table id="details">';
				include 'Mysql_connect.php';
				$sql = "SELECT * FROM inventory where inventory_id='".$_SESSION['jid']."'";
				$result = $conn->query($sql);
				if($result->num_rows>0){
					$row = $result->fetch_assoc();
					echo '<tr><td>Inventory ID</td><td>'.$row['inventory_id'].'</td></tr>';
					echo '<tr><td>Inventory Name</td><td>'.$row['Name'].'</td></tr>';
					echo '<tr><td>Old Price</td><td>'.$row['old price'].'</td></tr>';
					$_SESSION['oldPrice']=$row['Current price'];
					echo '<tr><td>Current Price</td><td>'.$row['Current price'].'</td></tr>';
					echo '<tr><td>Quantity</td><td>'.$row['quantity'].'</td></tr>';
				}else{
					echo '</table>';
					echo "<script>alert('No inventory with this ID');</script>";
				}
			}else if(isset($_POST['search'])&&isset($_POST['jid'])){
				echo '<table id="details">';
				include 'Mysql_connect.php';
				$_SESSION['jid']=$_POST['jid'];

				$sql = "SELECT * FROM inventory where inventory_id=".$_POST['jid'];
				$result = $conn->query($sql);
				if($result->num_rows>0){
					$row = $result->fetch_assoc();
					echo '<tr><td>Inventory ID</td><td>'.$row['inventory_id'].'</td></tr>';
					echo '<tr><td>Inventory Name</td><td>'.$row['name'].'</td></tr>';
					echo '<tr><td>Old Price</td><td>'.$row['old price'].'</td></tr>';
					$_SESSION['oldPrice']=$row['Current price'];
					echo '<tr><td>Current Price</td><td>'.$row['Current price'].'</td></tr>';
					echo '<tr><td>Quantity</td><td>'.$row['quantity'].'</td></tr>';
				}else{
					echo '</table>';
					echo "<script>alert('No inventory with this ID');</script>";
				}
				
			}
			
		 ?>
		<h4>Edit Inventory details
		<hr align="left" width="20%"></h4>
		<table>
		<tr><td>New Price</td><td style="width:70%;"><input type="number" name="nprice" ></td></tr>
		<tr><td>New Quantity</td><td style="width:70%;"><input type="number" name="nquantity" ></td></tr>
		<tr><td colspan="2"><center><input type="submit" name="submit" value="Update"style="width:45%;" ><input type="submit" name="cancel" value="cancel"style="width:45%;" ></center></td></tr>
		</table>
	</div>
	</form>
	</div>
 </body>
 </html>