<html>
<head>
<script src="js1.min.js"></script>  
<title>Repair Order</title>
  <style>
  input{
	  font-size:1.1em;
  }
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
<?php
session_start();

//manual customer id and job card id
include 'Mysql_connect.php';
$sql='select name,address from customer where id=(select customer_id from job_card where card_id='.$_SESSION['jid'].')';
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql='select chassis_no,remark from job_card where card_id='.$_SESSION['jid'];
$result1=$conn->query($sql);
$row1 = $result1->fetch_assoc();

?>
<img src="logo.png" align="right" alternate="logo"></img>
<p align="left">
<h3>Precision Autoworkz</h3>
R-427/13,TTC Industrial Area,<br>
 MIDC Rabale,Navi Mumbai<br>
Phone: 9619161027</p>
<center><h2>Repair Order</h2>   <h2>Job Card Id:- <?php echo $_SESSION['jid'] ; ?></h2></center>
<form action="" id="frm2" method="POST">  
<table>
<tr><td><b>Name</b></td><td><input type="text" id="name" style="border: none" value='<?php echo $row['name']?>'></td><td><b>Regn no:</b></td><td><input type="text" id="reg_no" style="border: none"></td></tr>
<tr><td><b>Address</b></td><td><textarea rows="4" cols="55" value='' style='font-size:1.1em;'><?php echo $row['address']?></textarea></td><td><b>Mileage</b></td><td><input type="number" id="reg_no" style="border: none"></td></tr>
<tr><td><b>Contact Person</b></td><td><input type="text" style="border: none"><td><b>Chassis no.</b></td><td><input type="text" id="reg_no" style="border: none" value='<?php echo $row1['chassis_no'];?>'></td></tr>
<tr><td><b>Engine no:</b></td><td><input type="text" id="reg_no" style="border: none"></td><td><b>Model</b></td><td><input type="text" id="reg_no" style="border: none"></td></tr>

<script>
$("t1").keyup(function(e){
	if(e.keyCode==13){
		var rowC=$(this).attr("rows");
		$(this).attr({rows:rowC + 5});
	}
});
</script>
<tr><th colspan=""><b>Customer Request</b></th><th></th><th>Service Advisor Instructions</th></tr>
<tr><td colspan="2"><p contenteditable="true"><?php echo $row1['remark'];?></p></td><td colspan="2"><p contenteditable="true"> <?php 
include 'Mysql_connect.php';
$sql='select j.job_name,j.total_price from job j  where j.job_id in (select job_id from job_card_details where card_id=9);';
$result2 = $conn->query($sql);
$num=$result2->num_rows;
$i=1;
//echo $num;
while($num>0){
	//echo '<br>';
$row2 = $result2->fetch_assoc();
echo  $i.':'.$row2['job_name']."<br>";
$num--;
$i++;
}

?></p></td></tr>
</table>
<img src="img.jpg" width="1024" height="700">
</form>

</body>
</html>