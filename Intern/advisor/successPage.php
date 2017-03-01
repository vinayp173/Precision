<?php
session_start();


?>
<?php 
	$id=$_SESSION['temp'];
	$_SESSION['temp']="";
?>
 <html>
<head>
</head>
<body>

	<div>
	<center><h1> job card id:- <?php echo $id; ?></h1>
	<img src="images/finish.jpg">
	<h3> <a href="/Precision/login.php">Click here to goto homepage </a></h3>
	</center>
	</div>
</body>
</html>