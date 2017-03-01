<?php
session_start();

	if(isset($_POST['chassis'])){
		$_SESSION['cn']=$_POST['chassis'];
	}else if(isset($_SESSION['cn'])){
		
	}else{
		$_SESSION['cn']="";
	}
	
	if(isset($_POST['license'])){
		$_SESSION['ln']=$_POST['license'];
	}else if(isset($_SESSION['ln'])){
		
	}else{
		$_SESSION['ln']="";
	}
	
	if(isset($_POST['customerSaying'])){
		$_SESSION['says']=$_POST['customerSaying'];
	}else if(isset($_SESSION['says'])){
		
	}else{
		$_SESSION['says']="";
	}
	
	if(isset($_POST['del_date'])){
		$_SESSION['da']=$_POST['del_date'];
	}else if(isset($_SESSION['da'])){
		
	}else{
		$_SESSION['da']="";
	}
	
	if(isset($_POST['supervisor'])){
		$_SESSION['sup']=$_POST['supervisor'];
	}else if(isset($_SESSION['sup'])){
		
	}else{
		$_SESSION['sup']="";
	}
	include 'Mysql_connect.php';
	$sql = "SELECT * FROM job ";
	$result = $conn->query($sql);
	$str='"select JOB",';
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$str=$str.'"'.$row['job_id'].' | '.$row['job_name'].' | '.$row['total_price'].'",';
		}
	}
	$str=substr($str, 0, -1);
	$_SESSION['jobALL']=$str;

	//genrate job card id
	include 'Mysql_connect.php';
	$sql = "SELECT * FROM job_card order by card_id desc";
	$result = $conn->query($sql);
	$num=$result->num_rows;
	$row = $result->fetch_assoc();
	$_SESSION['jcid']=$row['card_id']+1;
	
		function unsetSession(){
			$_SESSION['temp']=$_SESSION['jcid'];
			$_SESSION['jcid']="";
			$_SESSION['custID']="";
			$_SESSION['chassis']="";
			$_SESSION['license']="";
			$_SESSION['da']="";
			$_SESSION['says']="";
			$_SESSION['sup']="";
			$_SESSION['cn']="";
			$_SESSION['ln']="";
		}
		function send_mail(){
			include 'Mysql_connect.php';
			require_once "PHPMailer_5.2.4/class.phpmailer.php";
			$sql = "select email from customer where id=".$_SESSION['custID'];
				$conn->query($sql);
				$result = $conn->query($sql);
				$num=$result->num_rows;
				if ( $num> 0) {
					$row = $result->fetch_assoc();
					$emailid=$row["email"];
					$id=$_SESSION['jcid'];
					if($emailid==''){
						echo '<script language="javascript">';
						echo 'alert("No email id found. ")';
						echo '</script>';
					}else{
						$msg="Job Card ID for PPRECISION AUTOWORKZ is :- ".$id." <br><h1> car details:-</h1><br>";
						$msg=$msg."chassis number:-".$_SESSION['chassis']."<br>";
						$msg=$msg."license number:-".$_SESSION['license']."<br>";
						$msg=$msg."Estimated Delivery Date:-".$_SESSION['da']."<br>";
						
						$mail = new PHPMailer(); // create a new object
						$mail->IsSMTP(); // enable SMTP
						$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
						$mail->SMTPAuth = true; // authentication enabled
						$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
						$mail->Host = "smtp.gmail.com";
						$mail->Port = 465; // or 587
						$mail->IsHTML(true);
						$mail->Username = "avsdev847@gmail.com";
						$mail->Password = "avsdev847@tempEmail";
						$mail->SetFrom("avsdev847@gmail.com");
						$mail->Subject = "PRECISION AUTOWORKZ";
						$mail->Body =$msg;
						$mail->AddAddress($emailid);

						 if(!$mail->Send()){
							echo '<script language="javascript">';
							echo 'alert("Email not Send \nMailer Error:Authentication Required or no internet connection is there")';
							echo '</script>';
						} else {
							echo '<script language="javascript">';
							echo 'alert("Customer ID sent to mail")';
							echo '</script>';
							//header("Location: addJobC.php");
						}
					}
				
			}else{
				echo '<script language="javascript">';
				echo 'alert("unable to send ID")';
				echo '</script>';
			}
		}
		function decSpare(){
			include 'Mysql_connect.php';
			$sql = "select j.job_id from job j where j.job_id in (select job_id from job_card_details where card_id=".$_SESSION['jcid'].")";
			$result = $conn->query($sql);
			$num=$result->num_rows;
			$i=0;
			if ( $num> 0) {
				while($row = $result->fetch_assoc()){
					$s="select inventory.inventory_id,inventory.quantity from inventory where inventory.inventory_id in (select inventory_id from inventory_list where list_id=(SELECT list_id from job where job_id=".$row['job_id']."))";
					$result1 = $conn->query($s);
					$num1=$result1->num_rows;
					if ( $num1> 0) {
						while($row1 = $result1->fetch_assoc()){
							if($row1['quantity']==0){
								echo '<script> alert("spare Part need to order to complete this job card");</script>';
							}
							$sdel="update inventory set quantity=quantity-1 where inventory_id='".$row1['inventory_id']."'";
							//echo $sdel;
							$result2 = $conn->query($sdel);
						}
					}
				}
			}
				include 'Mysql_connect.php';	
				$del=date("Y-m-d",strtotime($_SESSION['da']));
				$today = date('Y-m-d'); //TODO supervisor id in 4 col
				$sql = "insert into job_card values(".$_SESSION['jcid'].",".$_SESSION['custID'].",".$_SESSION["id"].",".$_SESSION['sup'].",0,0,'".$_SESSION['chassis']."','".$today."','".$del."',0,'".$_SESSION['license']."',0,0,0,'".$_SESSION['says']."')";
				$result = $conn->query($sql);
				send_mail();
				unsetSession();
				header("Location: successPage.php");
		}
				if(isset($_POST['next'])){
					$_SESSION['chassis']=$_POST['chassis'];
					$_SESSION['license']=$_POST['license'];
					if($_SESSION['jcid']==""||$_SESSION['custID']==""||$_SESSION['chassis']==""||$_SESSION['license']==""||$_SESSION['da']==""||$_SESSION['says']==""||$_SESSION['sup']==""){
						echo'<script>alert("fill all fields")</script>';
					}else{
						
						decSpare();
						
					}
				}
				if(isset($_POST['cancel'])){
					include 'delOperation.php'; 
					unsetSession();
					header("Location: /Precision/login.php");
				}
			?>
<?php

if(isset($_POST['Cadd']))
{	
	if(!empty($_POST['Cname']) &&!empty($_POST['Cemail']) && !empty($_POST['Caddress']) && !empty($_POST['Ccontact'])){

	include 'Mysql_connect.php';
	require_once "PHPMailer_5.2.4/class.phpmailer.php";
	$sql = "select id from customer order by id desc";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					$row=$result->fetch_assoc();
				}
				$num=$row['id'];
				$num=$num+1;
				$sql = "insert into customer  values (".$num.",'".$_POST['Cname']."','".$_POST['Cemail']."','".$_POST['Caddress']."',".$_POST['Ccontact'].")";
		 if($conn->query($sql)){
			 echo'<script>alert("Succesfully Created!\nYour Customer Id is:'.$num.'")</script>';
		 }else{
			 //echo $conn->error;
		 }
		//echo 'inserted succesfully';
	}

				$sql = "select * from customer where email='".$_POST['Cemail']."'";
				$conn->query($sql);
				$result = $conn->query($sql);
				$num=$result->num_rows;
				if ( $num> 0) {
					$row = $result->fetch_assoc();
					$emailid=$row["email"];
					$id=$row['id'];
					if($emailid==''){
						echo '<script language="javascript">';
						echo 'alert("No email id found. ")';
						echo '</script>';
					}else{
						$msg="Customer ID for PPRECISION AUTOWORKZ is :-\n ".$id;
						
						$mail = new PHPMailer(); // create a new object
						$mail->IsSMTP(); // enable SMTP
						$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
						$mail->SMTPAuth = true; // authentication enabled
						$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
						$mail->Host = "smtp.gmail.com";
						$mail->Port = 465; // or 587
						$mail->IsHTML(true);
						$mail->Username = "avsdev847@gmail.com";
						$mail->Password = "avsdev847@tempEmail";
						$mail->SetFrom("avsdev847@gmail.com");
						$mail->Subject = "PRECISION AUTOWORKZ";
						$mail->Body =$msg;
						$mail->AddAddress($emailid);

						 if(!$mail->Send()){
							echo '<script language="javascript">';
							echo 'alert("Email not Send \nMailer Error:Authentication Required or no internet connection is there")';
							echo '</script>';
						} else {
							echo '<script language="javascript">';
							echo 'alert("Customer ID sent to mail")';
							echo '</script>';
							//header("Location: addJobC.php");
						}
					}
				
			}else{
				echo '<script language="javascript">';
				echo 'alert("unable to send ID")';
				echo '</script>';
			}
}

else{
	//echo 'not post';
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
<body><form action ="addJobC.php" method="POST">
<div>
	<div>
		<div id="borderdiv" style="margin-left:5%;" >
		<h4>Customer Details
		<hr align="left" width="20%"></h4>
			
				Customer ID:- <input type="number" name="custID" id="custID" style="width:30%;">
				
				<input type="submit" value='Get Data' name='getData' style='width=20%;'>
				<br>
				<br>
					<div id="borderdiv">
						<?php 
							
							function fetchDataS(){
								include 'Mysql_connect.php';
								$sql = "SELECT * FROM customer where id='".$_SESSION['custID']."'";
								$result = $conn->query($sql);
								$num=$result->num_rows;
								if ( $num> 0) {
									$row = $result->fetch_assoc();
									echo '<table >';
									echo '<tr> <td>Customer ID</td> <td>'.$row['id'].'</td> </tr>';
									echo '<tr> <td>Name</td> <td>'.$row['name'].'</td> </tr>';
									echo '<tr> <td>Number</td> <td>'.$row['number'].'</td> </tr>';
									echo '<tr> <td>Email Address</td> <td>'.$row['email'].'</td> </tr>';
									echo '<tr> <td>Address</td> <td>'.$row['address'].'</td> </tr>';
									echo '</table >';
									$_SESSION['custID']=$row['id'];
								}else{
									echo '<script>alert("Customer Not Found");</script>';
								}
							}
							function fetchData(){
								include 'Mysql_connect.php';
								$sql = "SELECT * FROM customer where id='".$_POST['custID']."'";
								$result = $conn->query($sql);
								$num=$result->num_rows;
								if ( $num> 0) {
									$row = $result->fetch_assoc();
									echo '<table >';
									echo '<tr> <td>Customer ID</td> <td>'.$row['id'].'</td> </tr>';
									echo '<tr> <td>Name</td> <td>'.$row['name'].'</td> </tr>';
									echo '<tr> <td>Number</td> <td>'.$row['number'].'</td> </tr>';
									echo '<tr> <td>Email Address</td> <td>'.$row['email'].'</td> </tr>';
									echo '<tr> <td>Address</td> <td>'.$row['address'].'</td> </tr>';
									echo '</table >';
									$_SESSION['custID']=$row['id'];
								}else{
									echo '<script>alert("Customer Not Found");</script>';
								}
							}
							if(isset($_POST['getData'])){
								fetchData();
							}else if(isset($_SESSION['custID'])&&$_SESSION['custID']!=""){
								fetchDataS();
							}
						?>
						
					</div>
				<br>
				<br>
				<center>
					 <input type="submit" value="OR Create a new customer" name='creatJ' style="height:5%;width:60%;">
					 <?php
					 if(isset($_POST['creatJ'])){
					 header('Location:CustomerAdd.php');
					}
					 ?>
				</center>

		</div>
		<br>

			<div id="borderdiv" style="margin-left:5%;margin-bottom:10%;">
				<h4>Car Details
				<hr align="left" width="20%"></h4>
				<table>
				<tr><td>Chassis NO</td><td><input type="text" value="<?php echo $_SESSION['cn'];?>" name="chassis" id="chassis" style="width:80%;"  ></td></tr>
				<tr><td>License No</td><td><input type="text" value="<?php echo $_SESSION['ln'];?>" name="license" id="license" style="width:80%;" ></td></tr>
				</table>
				
			</div>
			</div>
	</div>
			

		
	
	<?php
	include 'Mysql_connect.php';	
	$str=$_SESSION['jobALL'];
	
	if(isset($_POST['Padd']) && $_POST['PselID']!=''){
			include 'Mysql_connect.php';
			$sql = "SELECT srno FROM job_card_details order by srno desc";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
			$count=$row['srno']+1;
			$sql = "insert into job_card_details values(".$count.",".$_SESSION['jcid'].",'".$_POST['PselID']."',0,1,0,0,'','')";
			$result = $conn->query($sql);
			header("Location: redirect.php");
	}
	if(isset($_POST['Sadd']) && $_POST['SselID']!=''){
			include 'Mysql_connect.php';
			$sql = "SELECT srno FROM job_card_details order by srno desc";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
			$count=$row['srno']+1;
			$sql = "insert into job_card_details values(".$count.",".$_SESSION['jcid'].",'".$_POST['SselID']."',0,2,0,0,'','')";
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
	?>
<div id="borderdiv" style="margin-left:5%;" >
		<h4> Customer Saying...
		<hr align="left" width="20%"></h4>

	<textarea id="customerSaying"  name="customerSaying" cols="100" rows="10"> <?php echo $_SESSION['says'];?></textarea>
	</div>
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


<div id="borderdiv" style="margin-left:5%;margin-bottom:10%" >
	
	Delivery Estimation Date:<input type='date' name='del_date' value="<?php echo $_SESSION['da'];?>"><br>
Assign to Supervisor<br>

Supervisors ID:<select name="supervisor"  style='width:10%;' id='tag'>
    <option value="">Select</option>
		
	<?php
	include 'Mysql_connect.php';
		
		$sql = "select id from emp ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				if($_SESSION['sup']==$row['id']){
					
					echo '<option value="'.$row['id'].'" selected="selected">'.$row['id'].'</option>';
				}else if(strlen($row['id'])==3){
					echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';
				}
			}
		}?>
	
    
  </select><br><br>
 

	</div>
	
	
	
	
	<div id="footer">
	<center>
		<input type="submit" name="next" value="add" style="height:60%;width:150px;margin-top:0px;">
		<input type="submit" name="cancel" value="cancel" style="height:60%;width:150px;margin-top:10px;">
	</center>
</div>
	
</div>
</form>
</body>
</html>