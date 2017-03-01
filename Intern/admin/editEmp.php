<?php
if(isset($_POST['cancel'])){
	header("Location: Adminhp.php");
}
?>
<?php
session_start();?>
<html>
<head>
<title>
	EDIT Employee
</title>
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

</style>
</head>
<body>
<form method="POST" action="editEmp.php">
	<div id="borderdiv" style="margin-left:5%;margin-bottom:10%" >
	<input type="number" name="id">
	<input type="submit" style="width:40%;" name="search" value="search" >
	<input type="submit" style="width:30%;" name="cancel" value="Back" >
	<?php
		if(isset($_POST['search'])){
			include 'Mysql_connect.php';
			$sql = "SELECT * FROM emp where id=".$_POST['id'];
			$_SESSION['empid']=$_POST['id'];
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
	echo '<Table>';
	echo '<tr><td>Name</td><td><input type="Text" name="empName" id="empName" style="width:80%;" value="'.$row['name'].'" ></td></tr>';
	echo '<tr><td>Address</td><td><TextArea name="addr" id="addr" cols="10" rows="5" style="width:80%;"  >'.  $row['address'].'</TextArea></td></tr>';
	echo '<tr><td>POST</td><td><select id="dest" name="dest"  style="width:80%;" >';
						echo '<option value="">Select</option>';
						if($row['post']=="Admin")
							echo '<option value="Admin" selected="selected"> Admin</option>';
						else
							echo '<option value="Admin" > Admin</option>';
						if($row['post']=="Service Advisor")
							echo '<option value="Service Advisor" selected="selected"> Service Advisor</option>';
						else
							echo '<option value="Service Advisor" > Service Advisor</option>';
						if($row['post']=="Supervisor")
							echo '<option value="Supervisor" selected="selected"> Supervisor</option>';
						else
							echo '<option value="Supervisor" > Supervisor</option>';
						if($row['post']=="Technician")
							echo '<option value="Technician" selected="selected"> Technician</option>';
						else
							echo '<option value="Technician" > Technician</option>';
						echo '</select></td></tr>';
	echo '<tr><td>Email ID</td><td><input type="Email" name="email" id="email" style="width:80%;" value="' . $row['email'].'" ></td></tr>';
	echo '<tr><td>Conatct number</td><td><input type="number" name="mob" id="mob"  style="width:80%;" value="'.  $row['contact No'].'"></td></tr>';
	echo '<tr><td colspan="2"><center><input type="submit" style="width:40%;" name="update" value="Update" ></center></td></tr>';
	echo '</table>';
	
		}
	?>
	</div>
	<?php 
	function send_mail($id,$email){
			include 'Mysql_connect.php';
			require_once "PHPMailer_5.2.4/class.phpmailer.php";
					if($email==''){
						echo '<script language="javascript">';
						echo 'alert("No email id found. ")';
						echo '</script>';
					}else{
						$msg="<h2>PRECISION AUTOWORKZ profile Update</h2>\n Your new login credential are:-\nID:-".$id."\n Password:-pass123";
						
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
						$mail->AddAddress($email);

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

		}
		if(isset($_POST['update'])){
			include 'Mysql_connect.php';
			
			$sql="delete from emp where id=".$_SESSION['empid'];
			$result = $conn->query($sql);
			$sql = "SELECT id FROM emp where post='".$_POST['dest']."'order by id desc";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); 
			$id=$row['id']+1;
			$sql="insert into emp values(".$id.",'".$_POST['empName']."','".$_POST['addr']."','".$_POST['dest']."',0,0,'".$_POST['email']."','".$_POST['mob']."','pass123')";
			echo '<script>alert("employee updated with new id='.$id.'");</script>';
	
			$result = $conn->query($sql);
			send_mail($id,$_POST['email']);
		}
	?>
</form>
</body>
</html>