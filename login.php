<?php
 session_start();
 ?>
<?php
include 'Mysql_connect.php';
if(!empty($_SESSION["id"])){
	switch(strlen($_SESSION["id"])){
			case 1:
				header("Location: intern/admin/Adminhp.php");
                break;
			case 2:
				header("Location: welcome.php");
                break;
            case 3:
				header("Location: intern/supervisor/Supervisorhp.php");
                break;
            case 4:
				header("Location: intern/technician/Technician.php");
                break;
            
		}
}
if(isset($_POST['loginB'])){
 if(isset($_POST['Login_id'])&&!empty($_POST['Login_id'])&&isset($_POST['password'])&&!empty($_POST['password'])){
	$username=$_POST['Login_id'];
	$password=$_POST['password'];
	$sql = "SELECT id,name,password FROM emp where id='".$username."' and password='".$password."'";
	$result = $conn->query($sql);
	$num=$result->num_rows;
	if ( $num> 0) {
		$row = $result->fetch_assoc();
		$_SESSION['username']=$row['name'];
		echo '<script language="javascript">';
		echo 'alert("Login success';
		$type="uk";
		switch(strlen($row["id"])){
			case 1:
				$type="Admin";             
                echo '\n                       :-'.$type;
                echo '")';
                echo '</script>';
					
                    $_SESSION["id"] = $row["id"];
            
                header("Location: Intern/admin/Adminhp.php");
                break;
			case 2:
				$type="Service Advisor";
				echo '\n                       :-'.$type;
                echo '")';
                echo '</script>';
                $_SESSION["id"] = $row["id"];
                header("Location:welcome.php");
                break;
            case 3:
                $type="Supervisor";
				echo '\n                       :-'.$type;
                echo '")';
                echo '</script>';
                $_SESSION["id"] = $row["id"];
				header("Location: Intern/supervisor/Supervisorhp.php");
   
	// destroy the session 
                break;
            case 4:
                $type="Technician";
				echo '\n                       :-'.$type;
                echo '")';
                echo '</script>';
                $_SESSION["id"] = $row["id"];
				header("Location: Intern/technician/Technician.php");
                break;
            
		}
    		
	}else{
		echo '<script language="javascript">';
		echo 'alert("Login Failed")';
		echo '</script>';
	}
}
}
	
	
?>

<html>
<head>
 <link rel='stylesheet' href='index.css'>
 <link rel="shortcut icon" href="f12.jpg" />
<title>Precision Autoworkz</title>
</head>
<body background="t2.png">
<center><img src="logo.png" width='35%'></center> 
<br></br>
<br></br>
<center><h1><b>Precision Autoworkz</b></h1></center>
<center><i>(Express Service and Upgrade center)</i></center>
<form method='post' action ='login.php' >
<table align="center">
<tr><td>Login id : </td> <td><input type="text" name="Login_id"><br></td></tr>
<tr>
<tr>
<tr>
<tr><td>Password : </td> <td><input type="password" name="password" maxlength='50'></td></td></tr>
<tr><td colspan='3'><center><button type='Submit' name='loginB' >Login</button></center></td></tr>
<tr><td colspan='3'><center><a href='https://goo.gl/BonRy1'>Inventory</a></center></td></tr>
<tr><td><a href='https://goo.gl/PTlkCd'>Take an appointment</a></td><td></td><td><a href='about.html'>About Precision Autoworkz</a></td></tr>
<tr></tr>

</table>
</form>
</body>
</html>