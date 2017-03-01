<?php
session_start();
if(empty($_SESSION['jcid'])||$_SESSION['jcid']==""){
	header("Location: restrict.php");
}

?>
<html>
<style>
#footer {
    position:absolute;
    bottom:0;
    width:100%;
    height:60px;   /* Height of the footer */
    background:#6cf;
	position: fixed;
}
</style><head>
</head>
<body>

<div>
<div >
	Intermediate stage 
	<?php
		if(isset($_POST['accidental'])){
			$_SESSION['isRepair']="true";
			header("Location: accidental.php");
		}
		if(isset($_POST['next'])){
			$_SESSION['isRepair']="false";
			header("Location: costEstimate.php");
		}
		
		if(isset($_POST['cancel'])){
				include 'delOperation.php';
				$_SESSION['jcid']="";
				header("Location: \Precision\welcome.php");


		}
	?>
	</div>
	<form  method="POST" action="intermediate.php">
		<input type="submit" value="accidental and running repair" name="accidental"><br>
		<div id ="footer"><center>
			
			<input type="submit" value="next" name="next" style="height:85%;width:100px;margin-top:12px;">
			<input type="submit" value="cancel" name="cancel" style="height:85%;width:100px;margin-top:12px;">
			</center>
		</div>
	</form>
</div>
</body>
</html>