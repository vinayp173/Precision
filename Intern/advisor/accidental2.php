<?php
	session_start();
	include 'Mysql_connect.php';	
	$str=$_SESSION['jobALL'];
	if(empty($_SESSION['jcid'])||$_SESSION['jcid']==""){
	header("Location: restrict.php");
	}
	if(isset($_POST['Padd']) && $_POST['PselID']!=''){
			include 'Mysql_connect.php';
			$sql = "SELECT srno FROM job_card_details order by srno desc";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
			$count=$row['srno']+1;
			$sql = "insert into job_card_details values(".$count.",".$_SESSION['jcid'].",'".$_POST['PselID']."',0,1,0,0)";
			$result = $conn->query($sql);
			header("Location: redirect.php");
	}
	if(isset($_POST['Sadd']) && $_POST['SselID']!=''){
			include 'Mysql_connect.php';
			$sql = "SELECT srno FROM job_card_details order by srno desc";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
			$count=$row['srno']+1;
			$sql = "insert into job_card_details values(".$count.",".$_SESSION['jcid'].",'".$_POST['SselID']."',0,2,0,0)";
			$result = $conn->query($sql);
			header("Location: redirect.php");
	}
	if(isset($_POST['Pdelete'])&& !empty($_POST['srnop'])){
			foreach ($_POST['srnop'] as $hobys=>$value) {
				$sql = "delete from job_card_details where srno=".(int)$value;
				$conn->query($sql)or trigger_error($conn->connect_error);
				header("Location: redirect.php");
			}
	}
	if(isset($_POST['Sdelete'])&& !empty($_POST['srnos'])){
			foreach ($_POST['srnos'] as $hobys=>$value) {
				$sql = "delete from job_card_details where srno=".(int)$value;
				$conn->query($sql)or trigger_error($conn->connect_error);
				header("Location: redirect.php");
			}
	}
	if(isset($_POST['FinalSubmit'])){
		header("Location: costEstimate.php");
	}
	if(isset($_POST['cancel'])){
				include 'delOperation.php';
				$_SESSION['jcid']="";
				header("Location: \Precision\welcome.php");

			}
	?>

<html>
<head>
<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<link href="js/select2.min.css" rel="stylesheet" />
		<script src="js/select2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var pcountry=[<?php echo $str; ?>];
				$("#Pcountry").select2({
				  data: pcountry
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				var scountry=[<?php echo $str; ?>];
				$("#Scountry").select2({
				  data: scountry
				});
			});
		</script>

<style>
  <style>
table, td, th {
	 border: 1px solid #ddd;
	text-align: left;
}


table {
    
    
	width: 100%;
	border-collapse: collapse;
	border-spacing: 5px;
}

th, td {
	 padding: 5px;
}

textarea { border: none; }
</style>
</head>
<body>

<form method="POST" action="accidental2.php">

	<div id="borderdiv" style="margin-left:5%;margin-bottom:10%" >
		<div id="subborderdiv" style="margin-left:2%;" >
		<h4>PRIMARY JOBS
		<hr align="left" width="20%"></h4>

			<Table name="PRIMARY" id="sparelist" style=" border:1px solid black;">
			<tr>
				<td>checkbox</td>
				<td>Job ID</td>
				<td>Job Name</td>
				<td>Job Price</td>
			</tr>
			<?php 
				include 'Mysql_connect.php';
				$sql="select jc.srno,j.job_name,j.job_id,j.total_price from job_card_details jc, job j where jc.job_id=j.job_id and jc.card_id=".$_SESSION['jcid']." and jc.job_id in (select job_id FROM job_card_details where jc.card_id=".$_SESSION['jcid']." and jc.priority=1)";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()){
						echo "<tr>";
						echo "<td><input type='checkbox' name='srnop[]' id='srnop' value=".$row['srno']."</td>";
						echo "<td>".$row['job_id']."</td>";
						echo "<td>".$row['job_name']."</td>";
						echo "<td>".$row['total_price']."</td>";
						echo "</tr>";
					}
				}
			
			?>
			</table>
			<br>
			<select id="Pcountry" onchange="if (this.selectedIndex) changeNameP(this);" style="width:95%;">
			</select>
			<input type="submit" name="Padd" value="Add" style="width:40%;margin-top:2%;">
			<input type="submit" name="Pdelete" value="Delete" style="width:40%;margin-bottom:2%;">
		</div>
		<br><br>
		<div id="subborderdiv" style="margin-left:2%;" >
		<h4>SECONDARY JOBS
		<hr align="left" width="20%"></h4>
			<Table name="SECONDARY" id="sparelist" style=" border:1px solid black;">
			<tr>
				<td>checkbox</td>
				<td>Job ID</td>
				<td>Job Name</td>
				<td>Job Price</td>
			</tr>
			<?php 
				include 'Mysql_connect.php';
				$sql="select jc.srno,j.job_name,j.job_id,j.total_price from job_card_details jc, job j where jc.job_id=j.job_id and jc.card_id=".$_SESSION['jcid']." and jc.job_id in (select job_id FROM job_card_details where jc.card_id=".$_SESSION['jcid']." and jc.priority=2)";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()){
						echo "<tr>";
						echo "<td><input type='checkbox' name='srnos[]' id='srnos' value=".$row['srno']."</td>";
						echo "<td>".$row['job_id']."</td>";
						echo "<td>".$row['job_name']."</td>";
						echo "<td>".$row['total_price']."</td>";
						echo "</tr>";
					}
				}
			
			?>
			</table><br>
			<select id="Scountry" onchange="if (this.selectedIndex) changeNameS(this);" style="width:95%;">
			</select>
			<input type="submit" name="Sadd" value="Add" style="width:40%;margin-top:2%;">
			<input type="submit" name="Sdelete" value="Delete" style="width:40%;margin-bottom:2%;">
		</div>
		
		<script>
				function changeNameP(selTag){
					var e=document.getElementById('Pcountry');
					var x = selTag.options[selTag.selectedIndex].text;
					document.getElementById("PselDetails").value = x;
					var details = document.getElementById("PselDetails").value;
					var res = details.split(" | ", 1);
					document.getElementById("PselID").value = res;
				}
				function changeNameS(selTag){
					var e=document.getElementById('Scountry');
					var x = selTag.options[selTag.selectedIndex].text;
					document.getElementById("SselDetails").value = x;
					var details = document.getElementById("SselDetails").value;
					var res = details.split(" | ", 1);
					document.getElementById("SselID").value = res;
				}
		</script>
		
		<!-- hidden data -->
		<input type="hidden" name="PselDetails" id="PselDetails">
		<input type="hidden" name="PselID" id="PselID">
		
		<input type="hidden" name="SselDetails" id="SselDetails">
		<input type="hidden" name="SselID" id="SselID">
	</div>
<div id="footer">
	<center>
		<input type="submit" name="FinalSubmit" value="next" style="height:60%;width:150px;margin-top:0px;">
		<input type="submit" name="cancel" value="cancel" style="height:60%;width:150px;margin-top:10px;">
	</center>
</div>
</form>
</body>
</html>