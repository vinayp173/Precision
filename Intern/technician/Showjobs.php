<?php
session_start();?>
<html>
<!--change all technician id with session variable-->
<style>
table,tr,td,th{
	border:1px solid black;
	border-collapse: collapse;
}
</style>
<body>
<form action='Showjobs.php' method='post'>
<script>
var st=1;
		function myFunction(chassis_no,job_name,job_id,status,dt,cdt) {
			
			var table = document.getElementById("myTable");
			var x = document.getElementById("myTable").rows.length;
			var row = table.insertRow(x);
			
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			var cell5 = row.insertCell(4);
			var cell6 = row.insertCell(5);
			var checkbox = document.createElement('input');
			checkbox.type = "checkbox";
			checkbox.name = "id[]";
			checkbox.value = job_id;

			checkbox.id = "job_id";
			cell1.appendChild(checkbox);
			cell2.innerHTML =chassis_no ;
			cell3.innerHTML =job_name;
			cell5.innerHTML =dt;
			if(status==0){
				table.rows[st].style.backgroundColor='RED';
				st++;
				cell4.innerHTML ='Incomplete';
				cell6.innerHTML ='NA';
			}
			else{
				checkbox.checked=true;	
				table.rows[st].style.backgroundColor='#7FFF00';
				st++;
				cell4.innerHTML ='complete';
				cell6.innerHTML =cdt;
			}
		}
</script>
<table id='myTable'>
<tr>
<th>Select</th>
<th>chassis no</th>
<th>job name</th>
<th>Status</th>
<th>Assigned Date and Time</th>
<th>Completed Date and Time</th>
</tr>
</table>
<?php
if(isset($_POST['set'])){
	if(!empty($_POST['id'])){
			include 'Mysql_connect.php';
			
			foreach($_POST['id'] as $selected){
				$sql='update job_card_details set Status=1,Complete_DT=now() where job_id="'.$selected.'"';
				$conn->query($sql);
				//printT();
			}
	}
}
if(isset($_POST['setAll'])){
	
			include 'Mysql_connect.php';
				$sql='update job_card_details set Status=1,Complete_DT=now()  where Technician="'.$_SESSION['id'].'"';
				$conn->query($sql);
				
	
	}

if(isset($_POST['Reset'])){
	
			include 'Mysql_connect.php';
				$sql='update job_card_details set Status=0,Complete_DT=0 where Technician="'.$_SESSION['id'].'"';
				if($conn->query($sql)==true){}
					//echo'inserted';
				else
					echo'erro'.$conn->error;
	
	}

?>
<?php
printT();
function printT(){
	include 'Mysql_connect.php';
	
		$sql='select * from job_card_details where Technician="'.$_SESSION['id'].'"';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				//for chassis_no
				$sql='select chassis_no from job_card where card_id="'.$row['card_id'].'"';
				$result1 = $conn->query($sql);
				$row1 = $result1->fetch_assoc();
				//for job_name
				$sql='select job_name from job where job_id="'.$row['job_id'].'"';
				$result2 = $conn->query($sql);
				$row2 = $result2->fetch_assoc();
				$sql='select Status,Assign_DT,Complete_DT from job_card_details where job_id="'.$row['job_id'].'" and card_id="'.$row['card_id'].'"';
				$result3 = $conn->query($sql);
				$row3 = $result3->fetch_assoc();
							echo '<script type="text/javascript">',
					 'myFunction("'.$row1['chassis_no'].'","'.$row2['job_name'].'","'.$row['job_id'].'","'.$row3['Status'].'","'.$row3['Assign_DT'].'","'.$row3['Complete_DT'].'");',
					 '</script>'; 
				
			}
		}
}
?><br><br>
<input type='submit' name='set' value='set'>
<input type='submit' name='setAll' value='setAll'>
<input type='submit' name='Reset' value='Reset'>
</form>

<button style='width:6em;'><a href='Technician.php' style=' text-decoration:none; color:black; '>Finish</a></Button>
</body>
</html>

