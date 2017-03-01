
<?php
session_start();

if(empty($_SESSION['jcid'])||$_SESSION['jcid']==""){
	header("Location: restrict.php");
}
?>
<?php
			if(isset($_POST['next'])){
				checkNinsert();
				header("Location: intermediate.php");
			}
			if(isset($_POST['cancel'])){
				include 'delOperation.php';
				$_SESSION['jcid']="";
				header("Location: \Precision\welcome.php");

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
<style>
#footer {
    position:absolute;
    bottom:0;
    width:100%;
    height:60px;   
    background:#6cf;
	position: fixed;
}
</style>
</head>
<body>
<form  method="POST" action="analysisCar.php">
<div>
	<div >
	<div id="borderdiv" style="margin-left:5%;" >
		<h4>Service Jobs<hr align="left" width="20%"></h4>
		<div style="margin-left:5%;">
		<Table>
		<tr>
		<td style="width:40%">Engine Oil</td><td><select name="Eoil" style="width:90%">
					<option value="1">ok</option>
					<option value="2">Refill</option>
					</select></td>
		</tr>
		<tr>
		<td>Oil Filter</td><td><select name="oilFilter"style="width:90%">
					<option value="1">ok</option>
					<option value="2">Change</option>
					</select></td>
		</tr>
		<tr>
		<td >Transmission Oil </td><td><select name="Toil"style="width:90%">
					<option value="1">ok</option>
					<option value="2">Refill</option>
					</select></td>
		</tr>
		<tr>
		
		
		<td>Spark Plug</td><td><select name="spark"style="width:90%">
					<option value="1">ok</option>
					<option value="2">Change</option>
					</select></td>
		</tr>
		<tr>
		<td>Air Filter</td><td><select name="airFilter"style="width:90%">
					<option value="1">ok</option>
					<option value="2">Change</option>
					</select></td>
		</tr>
		<tr>
		<td>Break Fluid</td><td><select name="bfluid"style="width:90%">
					<option value="1">ok</option>
					<option value="2">Change</option>
					</select></td>
		</tr>
		<tr>
		<td>Clutch Fluid</td><td><select name="cfluid"style="width:90%">
					<option value="1">ok</option>
					<option value="2">Change</option>
					</select></td>
		</tr>
		<tr>
		<td>AC Belt</td><td><select name="acbelt"style="width:90%">
					<option value="1">ok</option>
					<option value="2">Change</option>
					</select></td>
		</tr>
		</table>
		</div>
	</div>
	<div id="borderdiv" style="margin-left:5%;" >
		<h4>Mick Jobs<hr align="left" width="20%"></h4>
	
		<div id="borderdiv" style="margin-left:5%;" >
			<h4>Wheels<hr align="left" width="20%"></h4>
			<Table>
			<tr>
			<td style="width:40%">Wheel Balancing</td><td><select name="balacing" style="width:90%">
						<option value="1">ok</option>
						<option value="2">not balanced</option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">Wheel Rotation</td><td><select name="rotation" style="width:90%">
						<option value="1">ok</option>
						<option value="2">not correct</option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">Tyre Pressure</td><td><select name="pressure" style="width:90%">
						<option value="1">ok</option>
						<option value="2">not filled</option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">no of wheels replaced</td><td><select name="wreplace" style="width:90%">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						</select></td>
			</tr>
			</table>
		</div>
		<div id="borderdiv" style="margin-left:5%;" >
			<h4>Electric/Lights<hr align="left" width="20%"></h4>
			<table>
			<tr>
			<td style="width:40%">HeadLights</td><td><select name="hlights" style="width:90%">
						<option value="1">ok</option>
						<option value="2">1 not Working </option>
						<option value="3">2 not Working </option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">Tail Lights</td><td><select name="tlights" style="width:90%">
						<option value="1">ok</option>
						<option value="2">1 not Working </option>
						<option value="3">2 not Working </option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">Light Switches</td><td><select name="slights" style="width:90%">
						<option value="1">ok</option>
						<option value="2">not Working </option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">Other Lights</td><td><select name="olights" style="width:90%">
						<option value="1">ok</option>
						<option value="2">not Working </option>
						</select></td>
			</tr>
			</table>
		</div>
		<div id="borderdiv" style="margin-left:5%;" >
			<h4>Cleanning<hr align="left" width="20%"></h4>
			<table>
			<tr>
			<td style="width:40%">Washing</td><td><select name="washing" style="width:90%">
						<option value="1">yes</option>
						<option value="2">no</option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">Wipers</td><td><select name="wiper" style="width:90%">
						<option value="1">ok</option>
						<option value="2">change</option>
						</select></td>
			</tr>
			<tr>
			<td style="width:40%">Wiper Operations</td><td><select name="wiperop" style="width:90%">
						<option value="1">working</option>
						<option value="2">not working</option>
						</select></td>
			</tr>
			</table>
		</div>
	</div>
	<div id="borderdiv" style="margin-left:5%;margin-bottom:15%;" >
		<div style="margin-left:5%;">
			<h4>remark<hr align="left" width="20%"></h4>
			<textarea name="remark" maxLength="70" rows="5" style="width:90%;" >
			</textarea>
			<h4>damages<hr align="left" width="20%"></h4>
			<table>
			<tr>
			<td style="width:40%">Number of Dents</td><td><input type="number" name="dents"></td>
			</tr>
			<tr>
			<td style="width:40%">Number of Scratches</td><td><input type="number" name="scratch" ></td>
			</tr>
			<tr>
			<td style="width:40%">Number of peelings</td><td><input type="number" name="peeling"></td>
			</tr>
			</table>
		</div>
	</div>
	
	</div>
</div>
<div id="footer">
		

			<center>
			<input type="submit" value="next" name="next" style="height:85%;width:100px;margin-top:12px;">
			<input type="submit" value="cancel" name="cancel" style="height:85%;width:100px;margin-top:12px;">
			</center>
		
</div>
</form>
</body>
</html>
<?php
	function checkNinsert(){
		include 'Mysql_connect.php';
		$sql = "update job_card set dents=".$_POST['dents'].",scratches=".$_POST['scratch'].",peelings=".$_POST['peeling'].",remark='".$_POST['remark']."' where card_id=".$_SESSION['jcid']."";
		$result = $conn->query($sql);
		$sql = "SELECT * FROM job_card_details order by srno desc";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$srno=$row['srno']+1;
		$count=0;
		if($_POST['Eoil']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",1,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['Toil']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",24,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['oilFilter']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",2,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['spark']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",3,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['airFilter']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",4,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['bfluid']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",5,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['cfluid']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",6,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['acbelt']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",7,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		$_SESSION['noOfServiceJobs']=$count;
		$count=0;
		
		if($_POST['balacing']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",8,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['rotation']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",9,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['pressure']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",10,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['wreplace']=="1"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",11,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['wreplace']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",12,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['wreplace']=="3"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",13,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['wreplace']=="4"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",14,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		$_SESSION['noOfMickJobs']=$count;
		$count=0;
		if($_POST['hlights']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",15,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['hlights']=="3"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",16,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['tlights']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",17,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['tlights']=="3"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",18,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['slights']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",19,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['olights']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",20,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		$_SESSION['noOtherJobs']=$count;
		$count=0;
		if($_POST['washing']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",21,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		if($_POST['wiper']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",22,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}if($_POST['wiperop']=="2"){
			$sql = "insert into job_card_details values(".$srno.",".$_SESSION['jcid'].",23,0,1,0,0)";
			$result = $conn->query($sql);
			$srno=$srno+1;
			$count=$count+1;
		}
		
	}
?>