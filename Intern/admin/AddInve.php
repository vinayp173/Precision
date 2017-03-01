<html>
<head>
<link rel="stylesheet" href="commonCSS.css">
</head>
<style>
table {
    border:1px solid black;
	border-collapse: collapse;
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

<button><a href='Adminhp.php' style='text-decoration: none; color:black;'>Back</a></Button>
	<h1 align='left'>Add Inventory<h1/>
	<div id="borderdiv" style="margin-left:5%;" >
	<form action='AddInve.php' method='POST'  >
	<table>
	<tr><td>Inventory ID</td><td><input type='text' name='Iid'style="width:80%;"></td></tr>	
	<tr><td>Inventory Name:</td><td><input type='text' name='Iname' style="width:80%;"></td></tr>
	<tr><td>Current Price</td><td><input type='number' name='Iprice' style="width:80%;"></td></tr>
	<tr><td>Previous Price</td><td><input type='number' name='IPprice'style="width:80%;"></td></tr>
	<tr><td>Quantity</td><td><input type='number' name='Iquantity'style="width:80%;"></td></tr>
<tr><td  colspan='2' ><input type='submit' name='addP' value='Add' style='margin-left:30em; width:20%;'></td></tr>
</table>
</form>

</div>
<?php
		if(isset($_POST['addP'])){
		if(!empty($_POST['Iname']) && !empty($_POST['Iprice']) && !empty($_POST['Iquantity']) && !empty($_POST['IPprice']) && !empty($_POST['Iid']) ){
				include 'Mysql_connect.php';
				/* $sql = "select inventory_id from inventory order by inventory_id desc";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					$row=$result->fetch_assoc();
				}
				$num=$row['inventory_id'];
				$num=$num+1; */
				$sql = "insert into inventory values('".$_POST['Iid']."','".$_POST['Iname']."',".$_POST['Iprice'].",".$_POST['IPprice'].",".$_POST['Iquantity'].") ";
				if($conn->query($sql)==TRUE){
					/*$sql='select * from inventory';
					$result=$conn->query($sql);
					$row=$result->fetch_assoc();*/
					echo '<script>alert("product Successfully Added");</script>';
					
				}else{
				
				//echo "Error: " . $sql . "<br>" . $conn->error;
				echo '<script>alert("product not Added");</script>';
				}
									
	
		}else{
					echo '	<script type="text/javascript">',
				 'alert("Fill the Fields!!");',
				 '</script>';
		}	 						
			}
?>
	
</body>
</html>