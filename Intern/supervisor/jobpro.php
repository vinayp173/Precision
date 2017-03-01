<html>
<style>
table,tr,td,th{
	border:1px solid black;
	border-collapse: collapse;
}
</style>
<?
session_start();
$_SESSION['card_no']=0;

if(isset($_POST['back'])){
	header("Location: Supervisorhp.php")
}
?>
<body>
<form action='jobpro.php' method='post'>
<script>
		function myFunction(job_name,chassis_no,job_id,tech,name,status,dt,tt) {
			var table = document.getElementById("myTable");
			var x = document.getElementById("myTable").rows.length;
			var row = table.insertRow(x);
			
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			var cell5 = row.insertCell(4);
			var cell6 = row.insertCell(5);
			var cell7 = row.insertCell(6);
			var cell8 = row.insertCell(7);
			var checkbox = document.createElement('input');
			checkbox.type = "radio";
			checkbox.name = "id[]";
			checkbox.value = job_id;

			checkbox.id = "job_id";
			cell1.appendChild(checkbox);
			cell2.innerHTML =job_name ;
			cell3.innerHTML = chassis_no;
			cell4.innerHTML = tech;
			cell5.innerHTML =name;
			
			if(status==0){
					cell6.innerHTML ='Incomplete!';
					cell7.innerHTML =dt;
					cell8.innerHTML ='NA';
		}
			else{
					cell6.innerHTML ='Completed!!';
					cell7.innerHTML =dt;
					cell8.innerHTML =tt;
			}
		}
		function update(job_id,tech_id,tech_nm){
			var job=job_id;
			var tech_id=tech_id;
			var table = document.getElementById("myTable");
			var rowCount = table.rows.length;
				/* var row = table.rows[2];
				row.cells[3].childNodes[0].innerHTML='sachin'; */
			if(rowCount>0){
								
			for(var i=1; i<rowCount; i++) {
			
						var row = table.rows[i];
							var chkbox = row.cells[0].childNodes[0];
						if(job == chkbox.value) {
							row.cells[3].childNodes[0].nodeValue=tech_id;
							alert(row.cells[4]);
								//alert('updated');
							
							//alert(document.getElementById('s').innerHTML=row.cells[3].childNodes[0].nodeValue);
							
						rowCount--;
							//i--;
						}
					}
				//'alert("Deleted Successfully");',
			}
			
		}

</script>

<table id='myTable' style='width:40%;'>
<tr>
<th>Select</th>
<th>job name</th>
<th>chasis no.</th>
<th>Technician</th>
<th>Name</th>
<th>Status</th>
<th>Date and Time</th>
<th>Time taken to complete(Hours)</th>
</tr>
<?php
//$card;
if(isset($_POST['bt'])){
$arr1=$_POST['bt'];
foreach($_POST['bt'] as $ch){
				//echo'->'.$ch;
				//echo'<h1>Job Card->'.$ch.'</h1>';
				//$GLOBALS['card']=$ch;
							//global $card=$ch;
				printJ($ch);
			}


}
function printJ($card_id){
	include 'Mysql_connect.php';
	//echo'<h1>Job Card->'.$card_id.'</h1>';
	$sql='select chassis_no from job_card where card_id="'.$card_id.'"';
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$chassis_no=$row['chassis_no'];
$sql='select * from job_card_details where card_id="'.$card_id.'"';
		$result1 = $conn->query($sql);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()){
				//echo $row1['job_id'].'<br>';
				$sql='select * from job where job_id="'.$row1['job_id'].'"';
				$result2 = $conn->query($sql);
				if ($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()){
						$sql='select name from emp where id ='.$row1['Technician'].'';
						$result3=$conn->query($sql);
						$row3=$result3->fetch_assoc();
						//for status of job
						$sql='select Status,Assign_DT,Complete_DT from job_card_details where job_id ='.$row1['job_id'].' and card_id='.$card_id.'';
						$result4=$conn->query($sql);
						$row4=$result4->fetch_assoc();
						/* $t1=strtotime($row4['Complete_DT']);
						$t2=strtotime($row4['Assign_DT']);
						$t= time('2017-01-07  00:16:33');
						echo(date("Y-m-d H:i:s",$t));
						$ft=abs($t1-$t2).'<br>';
						 *///echo $row4['Complete_DT'];
						$ft=timeC($row4['Complete_DT'],$row4['Assign_DT']);
						//echo'difference->'.$ft;
						if($row4['Complete_DT']>0){
							//echo'in if';
							$dt= $ft;; 
						}
						else{
							$dt=0;
						}
						//echo $dt;
					echo '<script type="text/javascript">',
					 'myFunction("'.$row2['job_name'].'","'.$chassis_no.'","'.$row1['srno'].'","'.$row1['Technician'].'","'.$row3['name'].'","'.$row4['Status'].'","'.$row4['Assign_DT'].'","'.$dt.'");',
					 '</script>'; 
					}
				}
			}
			
		}	

}
function timeC($value1,$value2){

$datetime1 = new DateTime($value1);
$datetime2 = new DateTime($value2);

$date1 = $datetime1->format('Y-m-d');
$time1 = $datetime1->format('H:i:s');
//echo'First Date->'.$date1.'  Time->'.$time1.'<br>';

$date2 = $datetime2->format('Y-m-d');
$time2= $datetime2->format('H:i:s');
/* echo'Second Date->'.$date2.'Time->'.$time2.'<br>';
echo '<br>date2->'.strtotime($date2).'<br>';
echo '<br>date1->'.strtotime($date1).'<br>'; */
$diff=abs(strtotime($date2)-strtotime($date1));
//echo 'date difference->'.$diff/3600;
$fdd=$diff/3600;

sscanf($time1, "%d:%d:%d", $hours, $minutes, $seconds);
$time_seconds1 = $hours * 3600 + $minutes * 60 + $seconds;
//echo  'time in seconds2->'.$time_seconds1 ;
sscanf($time2, "%d:%d:%d", $hours1, $minutes1, $seconds1);
$time_seconds2 = $hours1 * 3600 + $minutes1 * 60 + $seconds1;
//echo  'time in seconds2->'.$time_seconds2;
$tdiff=abs($time_seconds2-$time_seconds1)/3600;
//echo 'time calculation'.$tdiff;
$fdtd=abs($fdd+$tdiff);
//echo 'Final date time Difference'.floor($fdtd);

return floor($fdtd);
//echo 'total datetime difference in hours->'.abs(($diff/3600)+(($time_seconds2-$time_seconds1)/3600));

}
?>



<?php
			
			?>
		
</table><br><br>
<!--<form actin='Assignjob.php' method='post'>-->

<span style='font-size:15px;'>Select Technician</span>
  <select id="tech" onchange="if (this.selectedIndex) changeName(this);" name='' style='width:170px;' class='container'>
	<option value="">Select Technician</option>
    <?php
		include 'Mysql_connect.php';
		$sql = "select id,name from emp where post='Technician'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				echo '<option value="'.$row['name'].'">'.$row['id'].'</option>';
				
			}
		}
		
	?>
	</select>
	<script>
			function changeName(selTag){
			var e=document.getElementById('tech');
			document.getElementById('tech_nm').value=e.value;
			var x = selTag.options[selTag.selectedIndex].text;
			document.getElementById('tech_id').value=x;
		}
		</script>
<br><br>Name:<input type='text' name='tech_nm' id='tech_nm' style='margin-left:70px;'>
<br>
<!--Name:<label id='tech_nm'></label>-->
<input type='hidden' name='tech_id' id='tech_id'><br>
<input type='submit' name='assing' value='Assign job'><br><br>
<input type='submit' name='back' value='back '><br><br>

</form>
<?php
		if(isset($_POST['assing']))		
				if(!empty($_POST['id'])){
				include 'Mysql_connect.php';
				//echo'inserted';	
				foreach($_POST['id'] as $check) {
					//$card=$_POST['bt'];
						//$date = date('Y-m-d H:i:s');
						$sql = "UPDATE job_card_details SET Technician=".$_POST['tech_id'].",Assign_DT=now(),Complete_DT=0 where srno=".$check."";
					
					if($conn->query($sql)==true){
						//echo'inserted';
						/* echo '<script>',
						'update("'.$check.'","'.$_POST['tech_id'].'","'.$_POST['tech_nm'].'");',
						'</script>';
						 */
						 $sql='select card_id from job_card_details where srno='.$check.'';
						$result=$conn->query($sql);
						$row=$result->fetch_assoc();
						printJ($row['card_id']);
						//	printJ(2);
						
					}else{
						echo $conn->error.'Error';
						
					}
				
				}
				
				}
				
		
?>

</html></body>