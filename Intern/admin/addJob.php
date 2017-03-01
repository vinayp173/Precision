<?php
	session_start();
	include 'Mysql_connect.php';	
	$str=$_SESSION['inventoryALL'];
	
	$sql = "SELECT job_id,list_id,job_name FROM job order by job_id desc";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc(); 
	$_SESSION['jobID']=$row['job_id']+1;
	$_SESSION['listID']=$row['list_id']+1;
	if(isset($_POST['jobName'])){
		$_SESSION['jobName']=$_POST['jobName'];
	}else if(isset($_SESSION['jobName'])){
		//do nothing
	}else{
		$_SESSION['jobName']="";
	}
	if(isset($_POST['FinalSubmit'])){
			$sql = "insert into job values(".$_SESSION['jobID'].",'".$_SESSION['jobName']."',".$_SESSION['listID'].",".$_POST['cost'].")";
			$result = $conn->query($sql);
			session_unset();
			header("Location: Adminhp.php");
			session_destroy();
	}
	if(isset($_POST['cancel'])){
			$sql = "delete from inventory_list where list_id=".$_SESSION['listID'];
			$result = $conn->query($sql);
			session_unset();
			session_destroy();
			header("Location: Adminhp.php");
	}
	if(isset($_POST['delete'])&& !empty($_POST['srno'])){
			foreach ($_POST['srno'] as $hobys=>$value) {
				$sql = "delete from inventory_list where srno=".(int)$value;
				$conn->query($sql)or trigger_error($conn->connect_error);
				header("Location: redirect.php");
			}
	}
	if(isset($_POST['add']) && $_POST['selID']!=''){
			include 'Mysql_connect.php';
			$sql = "SELECT srno FROM inventory_list order by srno desc";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
			$count=$row['srno']+1;
			$sql = "insert into inventory_list values(".$count.",".$_SESSION['listID'].",'".$_POST['selID']."')";
			$result = $conn->query($sql);
			header("Location: redirect.php");
		}
?>
<html>
<head>

 <title>
	Add Job
 </title>
<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<link href="js/select2.min.css" rel="stylesheet" />
		<script src="js/select2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var country=[<?php echo $str; ?>];
				$("#country").select2({
				  data: country
				});
			});
		</script>
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
tfoot {color:red;}
#fullinput{
	width:90%;
}
</style>
</head>
<body>
<div>
<form method="POST" action="addJob.php">
	<div id="borderdiv" style="margin-left:5%;margin-bottom:10%" >
	<h4>Add New Job <hr align="left" width="20%"></h4>
	<Table>
	<tr><td>Job ID</td><td><input type="text" name="jobId" value="<?php echo $_SESSION['jobID']; ?>" id="fullinput"> </td></tr>
	<tr><td>Job NAME</td><td><input type="text" name="jobName" id="fullinput" value="<?php echo  $_SESSION['jobName'];?>"> </td></tr>
	</Table>
	<div id="subborderdiv" style="margin-left:2%; ma" >
		<div>
		<br><br><center>
			<select id="country" onchange="if (this.selectedIndex) changeName(this);" style="width:95%;">
			</select>
			<input type="submit" name="add" value="Add" style="width:40%;margin-top:2%;">
			<input type="submit" name="delete" value="Delete" style="width:40%;margin-bottom:2%;">
			</center>
		</div>
		
		<Table name="sparelist" id="sparelist" style=" border:1px solid black;">
		<tr>
			<td>checkbox</td>
			<td>Part ID</td>
			<td>Part Name</td>
			<td>Part Price</td>
		</tr>
		<?php 
			include 'Mysql_connect.php';
			$sql = "select * from inventory_list ilist,inventory inv where list_id=".$_SESSION['listID']." and ilist.inventory_id=inv.inventory_id order by srno asc";
			$result = $conn->query($sql);
			$cost=0;
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
					global $cost;
					echo "<tr>";
					echo "<td><input type='checkbox' name='srno[]' id='srno' value=".$row['srno']."</td>";
					echo "<td>".$row['inventory_id']."</td>";
					echo "<td>".$row['Name']."</td>";
					echo "<td>".$row['Current price']."</td>";
					echo "</tr>";
					$cost+=$row['Current price'];
				}
			}
		
		?>
		<tfoot>
		<tr><td colspan="2">Cost Estimate:</td><td colspan="2"><input type="number" name="cost" id="cost" value="<?php echo $cost;?>" style="width:85%;"></td></tr>
		</tfoot>
		</Table>
		
		<script>
				function changeName(selTag){
					var e=document.getElementById('country');
					var x = selTag.options[selTag.selectedIndex].text;
					document.getElementById("selDetails").value = x;
					var details = document.getElementById("selDetails").value;
					var res = details.split(" | ", 1);
					document.getElementById("selID").value = res;
				}/*
				function addToHTMLTable(details,count){
					var res = details.split(" | ");
					var id = res[0];
					var name=res[1];
					var price=res[2];
					var table = document.getElementById("sparelist");
					var x = document.getElementById("sparelist").rows.length;
					var row = table.insertRow(x);
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
					var cell4 = row.insertCell(3);
					var checkbox = document.createElement('input');
					checkbox.type = "checkbox";
					checkbox.name = "srno[]";
					checkbox.value = count;
					checkbox.id = "srno";
					cell1.appendChild(checkbox);
					cell2.innerHTML = id;
					cell3.innerHTML = name;
					cell4.innerHTML = price;
				}*/
				
			</script>
		<?php
		/*
		if(isset($_POST['add']) && $_POST['selID']!=''){
			include 'Mysql_connect.php';
			$sql = "SELECT srno FROM inventory_list order by srno desc";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
			$count=$row['srno']+1;
			$sql = "insert into inventory_list values(".$count.",".$_SESSION['listID'].",".$_POST['selID'].")";
			$result = $conn->query($sql);
			echo '<script type="text/javascript">',
				 'addToHTMLTable("'.$_POST['selDetails'].'",'.$count.');',
				 '</script>';
		}
		if(isset($_POST['delete'])&& !empty($_POST['srno'])){
			
			foreach ($_POST['srno'] as $hobys=>$value) {
				echo '<script type="text/javascript">',			
					'var table = document.getElementById("sparelist");',
					'var rowCount = table.rows.length;',
					'if(rowCount>0){',			
					'for(var i=0; i<rowCount; i++) {',
						'var row = table.rows[i];',
						'var chkbox = row.cells[0].childNodes[0];';
				echo 'if("'.$value.'" == chkbox.value) {',
							'table.deleteRow(i);',
							'rowCount--;',
							'i--;',
						'}',
					'}',
					'}',
				'</script>';
			}
			foreach ($_POST['srno'] as $hobys=>$value) {
				$sql = "delete from inventory_list where srno=".(int)$value;
				$conn->query($sql)or trigger_error($conn->connect_error);
				header("Location: redirect.php");
			}
		}*/
		?>
		
		<!-- hidden data -->
		<input type="hidden" name="selDetails" id="selDetails">
		<input type="hidden" name="selID" id="selID">
	</div>
	</div>
	<div id="footer">
			<center>
				<input type="submit" name="FinalSubmit" value="next" style="height:60%;width:150px;margin-top:0px;">
				<input type="submit" name="cancel" value="cancel" style="height:60%;width:150px;margin-top:10px;">
			</center>
	</div>
</form>
</div>
</body>
</html>