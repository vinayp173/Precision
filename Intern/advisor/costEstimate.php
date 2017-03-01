<?php
session_start();

if(empty($_SESSION['jcid'])||$_SESSION['jcid']==""){
	header("Location: restrict.php");
}

?>
	<?php
		if(isset($_POST['next'])){
			
			include 'Mysql_connect.php';
			//$sql = "update job_card set date stage2=".$_POST['supervisor']." where card_id=".$_SESSION['jcid'];
			$sql = "update job_card set delivery_date='".$_POST['del_date']."', stage2=".$_POST['supervisor']."  where card_id=".$_SESSION['jcid'];
			echo $sql;
			$result = $conn->query($sql);
			//header("Location: successPage.php");
		}
		if(isset($_POST['cancel'])){
				include 'delOperation.php';
				$_SESSION['jcid']="";
				header("Location: \Precision\welcome.php");

		}
	?> 
<html>
<head>
<style>
.fieldset-auto-width{
	display:inline-block;
	width:100%;
}
#footer {
    position:absolute;
    bottom:0;
    width:100%;
    height:60px;   /* Height of the footer */
    background:#6cf;
	position: fixed;
}
fieldset{
	
	border-color:green;
}
</style>
</head>
<body>
	
  
  
<form action='costEstimate.php' method='post'>

<fieldset class='fieldset-auto-width'>
<legend>Cost Estimation</legend>
<div style='display:inline;'>
<table style='display:inline;'>
<tr><td>Service Job:</td><td><input tyep='text' name='s_job' value="<?php echo $_SESSION['noOfServiceJobs']; ?>"></td><tr>
<tr><td>Mick Job:</td><td><input tyep='text' name='m_job' value="<?php echo $_SESSION['noOfMickJobs']; ?>"></td><tr>
<tr><td>Other:</td><td><input tyep='text' name='o_job' value="<?php echo $_SESSION['noOtherJobs']; ?>"></td><tr>
<tr><td>Primary Job:</td><td><input tyep='text' name='p_job' value="3"></td><tr>
<tr><td>Secondary Job:</td><td><input tyep='text' name='se_job' value="2"></td><tr>
</table>
</div>
<div style='display:inline; padding-left:50px; padding-top:200px;  '>
<fieldset style='width:15%; display:inline; '><legend>Total Cost</legend><input tyep='text' name='Tcost'></fieldset>
</div>
</fieldset>
<fieldset class='fieldset-auto-width'>
<!--<form action='costEstimate.php' method='post'>-->
Delivery Estimation Date:<input type='date' name='del_date'><br>
Assign to Supervisor<br>
Supervisors ID:<select name="supervisor" onchange="superV(this);" style='width:10%;' id='tag'>
    <option value="">Select</option>
		
	<?php
	include 'Mysql_connect.php';
		
		$sql = "select * from emp where post='Supervisor'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';
				
			}
		}
		
		?>
	
    
  </select>
  
	
 
  <br>
<script>
function superV(selTag){
	
	var x = selTag.options[selTag.selectedIndex].text;					
			var table = document.getElementById("myTable");
			var rowCount = table.rows.length;
			//if(rowCount>0){
								
			for(var i=1; i<rowCount; i++) {
			
					//alert(chkbox+x);
				//if(x!=chkbox){
					//table.deleteRow(i);
					for(var i=1; i<rowCount; i++) {
					var row = table.rows[i];
					row.style.display='none';
					}
					for(var i=1; i<rowCount; i++) {
					var row = table.rows[i];
					var chkbox = row.cells[0].innerHTML;
					if(x==chkbox){
					row.style.display='';	
					}
					
					}
					//var row = table.rows[i];
				    //var chkbox = row.cells[0].innerHTML;
				
					
					//rowCount--;
					//i--;
			//	}
				//else{
					//var r1=table.row[i+1];
					
				}
			
			document.getElementById('myTable').style.display='block';
	
			}
</script>
<fieldset style='width:50%;height:30%'>
<legend>details</legend>
<div>
<!--Details of Supervisor-->
<script>
  //id,name,email,no of cars,no of cars handled,contact No
		function myFunction(id,name,email,no_of_cars,no_of_cars_handled,contact_No) {
			var table = document.getElementById("myTable");
			var x = document.getElementById("myTable").rows.length;
			var row = table.insertRow(x);
			//var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(0);
			var cell3 = row.insertCell(1);
			var cell4 = row.insertCell(2);
			var cell5 = row.insertCell(3);
			var cell6 = row.insertCell(4);
			var cell7 = row.insertCell(5);
			//var cell8 = row.insertCell(6);
			var checkbox = document.createElement('input');
			checkbox.type = "radio";
			checkbox.name = "id[]";
			checkbox.value = id;
//checkbox.checked=true;
			checkbox.id = "id";
			
			//cell1.innerHTML =sr;
			cell2.innerHTML =id;
			cell3.innerHTML = name;
			cell4.innerHTML = email;
			cell5.innerHTML = no_of_cars;
			cell6.innerHTML = no_of_cars_handled;
			cell7.innerHTML = contact_No;
			//cell8.appendChild(checkbox);
						//cell4.appendChild(checkbox);
		}
	</script>  

<table id='myTable' border='1px solid black' style='display:none;'>
<tr><th>Id</th><th>Name</th><th>Email</th><th>No of cars </th><th>No of cars handled</th><th>Contact</th></tr>
</table>
<?php
 //function superv(){
 //}
 	include 'Mysql_connect.php';
			$sql = "select * from emp where post='Supervisor'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				//echo '<option value="">'.$row['id'].'</option>';
				//id,name,email,no of cars,no of cars handled,contact No
				echo '<script type="text/javascript">',
				 'myFunction("'.$row['id'].'","'.$row['name'].'","'.$row['email'].'","'.$row['no of cars'].'","'.$row['no of cars handled'].'","'.$row['contact No'].'");',
				 '</script>';
				
			}
		}
	
	 ?>
</div>
</fieldset>
</fieldset>
<div>
	<div id="footer">
	<center>
			
			<input type="submit" value="next" name="next" style="height:85%;width:100px;margin-top:12px;">
			<input type="submit" value="cancel" name="cancel" style="height:85%;width:100px;margin-top:12px;">
			
		
	</center>
	</div>
</div>
</form>
</body>
</html>