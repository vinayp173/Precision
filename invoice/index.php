<?php
session_start();
?>    
<?php 
	include 'Mysql_connect.php';
	$sql = "select chassis_no,license_no from job_card where card_id=".$_SESSION['jid'];
	$result = $conn->query($sql);

	$num=$result->num_rows;
	
	if ( $num> 0) {
		$row = $result->fetch_assoc();
		$_SESSION['lnc']=$row['license_no']."\n".$row['chassis_no'];
		
	}
	$sql = "select name,address,number from customer where id=(select customer_id from job_card where card_id=".$_SESSION['jid'].")";

	$result = $conn->query($sql);
	$num=$result->num_rows;
	
	if ( $num> 0) {
		$row = $result->fetch_assoc();
		$_SESSION['nan']=$row['name']."\n".$row['address']."\n".$row['number'];
	}
	$_SESSION['date']=date('Y-m-d');
?>
    <html>  
  
<head>  
<title>Invoice</title>  
    <style>
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
<script src="js1.js"></script>  
<script src="js2.js"></script>  
<script src="js3.js"></script>  
<script src="js4.js"></script>
<script src="js5.js"></script>
<script src="js6.js"></script>
               			
  
       
		   
		   <body>  
        Invoice Number
		<form action="" name="frm1" id="frm1" method="POST">  				

        <center> <img src="logo.png" width="35%" alt="logo" /></center>
            
			<center><b><h1>Precison Autoworkz Invoice</h1></center><br>
			               <center>(Bosch Express Service)</center>
			       <p align="left">Precision Autoworkz(Bosch Express Service Center)<br>
					 R-427/13,TTC Industrial Area,<br>
					 MIDC Rabale,<br>
					 Navi Mumbai<br>
					 Phone: 9619161027</p></center>
				
				
			

 

				
                     
                          
                    <table  id="tbl1" align="center">          
                         <thead>  
                          <th border='0'>Car Registration Number and VIN</th>
                          
						  <th>Customer Name & address</th>
						  <th>Invoice Dated</th></thead> 
                          <tr><td><textarea name="reg_no" rows="3" cols="40"><?php echo $_SESSION['lnc'];?></textarea></td> 
						  
						  <td border='0'><textarea name="customer" rows="3" cols="40"><?php echo $_SESSION['nan']; ?></textarea></td>
                          <td><input type="date" style="border:none" id="myDate" value="<?php echo $_SESSION['date'];?>"/></td></tr>
						  

<script type="text/javascript">
function SetDate()
{
var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;


document.getElementById('myDate').value = today;
}
</script>	



</table>	
<br>
<br>
<br>				  
                            
                              
                                          
                                
                                 
                                  
                                                    

					    

                                             
                    
					
					
					  <table  align="center">
                        <thead>  
                           <col width="100">
						   <col width="200">
							<th>No</th>  
                           
						    <th>Job Name</th>  
                            <th>Quantity</th>  
                            <th>Price</th>  
                            <th>Labour</th>  
                            <th>Amount</th>  
                           <div class="no-print"><th><input type="button" style="background-color:rgb(0, 255, 0);border: none" value=" " id="add" class="hide"></th></div>  
						   <th style="display:none;"></th>
                        </thead>  
                        <tbody class="detail">  
						<?php
								include 'Mysql_connect.php';
								$sql = "select j.job_id from job j where j.job_id in (select job_id from job_card_details where card_id=".$_SESSION['jid'].")";
								//echo $sql;
								$result = $conn->query($sql);
								$num=$result->num_rows;
								$i=0;
								if ( $num> 0) {
									while($row = $result->fetch_assoc()){
										$s="select inventory.name,inventory.`Current price` from inventory where inventory.inventory_id in (select inventory_id from inventory_list where list_id=(SELECT list_id from job where job_id=".$row['job_id']."))";
										$result1 = $conn->query($s);
										$num1=$result1->num_rows;
										if ( $num1> 0) {
											while($row1 = $result1->fetch_assoc()){
												$i=$i+1;
												echo '<tr>';
												echo'<td class="no">'.$i.'</td>  ';
												echo '<td align="left"><textarea rows="4" cols="42" name="productname[]">'.$row1['name'].'</textarea></td>  ';
												echo '<td><input type="number" style="text-align:center; border: none" class="form-control quantity" name="quantity[]" ></td>  ';
												echo '<td><input type="number" style="text-align:center;border: none" class="form-control price" name="price[]" value="'.$row1['Current price'].'"></td>  ';
												echo '<td><input type="number" style="text-align:center;border: none" class="form-control discount" name="discount[]" value="0"></td>  ';
												echo '<td><input type="number"  style="text-align:center;border: none" class="form-control amount" name="amount[]" ></td>  ';
												echo '<td><a href="#" class="remove"><input type="button" style="background-color:rgb(255, 0, 0);border: none" value=" "></a></td> ';
												echo '<td style="display:none;"><input type="hidden" class="form-control tax" name="tax[]"></td>';
												echo '</tr>';
											}
										}
									}
								}
							?>
                          
  
<tr>  
<th colspan="5">Grand Total</th>  
<th style="text-align:center;" id="total" name="total" class="total" colspan="2">0<b></b></th>  
</tr> 
<tr>  
<th colspan="5">Grand Total with Taxes</th> 
<th style="text-align:center;" id="tt" class="tt" name="tt" colspan="2">0<b></b></th>  
</tr>  
 
</tbody>  
</table>  
</form> 
 

		
	

<script type="text/javascript">  
function addnewrow()   
{  
var n=($('.detail tr').length-0)+1;  
var tr = '<tr>'+  
'<td class="no">'+n+'</td>'+  
'<td><textarea cols="42" rows="4" name="productname[]"></textarea></td>'+  
'<td><input type="text"  style="text-align:center;border: none" class="form-control quantity" name="quantity[]"></td>'+  
'<td><input type="text"  style="text-align:center;border: none" class="form-control price" name="price[]"></td>'+  
'<td><input type="text" style="text-align:center;border: none" class="form-control discount" name="discount[]" value="0"></td>'+  
'<td><input type="text" style="text-align:center;border: none" class="form-control amount" name="amount[]"></td>'+  
'<td><a href="#" class="remove"><input type="button" style="background-color:rgb(255, 0, 0);border: none" value=" "></a></td> '+  
'<td><input type="hidden" style="display:none;" class="form-control tax" name="tax[]"></td>'
'</tr>';  
$('.detail').append(tr);   
}



$(function()  
{  
$('#add').click(function()  
{  
addnewrow();  
});  
$('body').delegate('.remove','click',function()  
{  
$(this).parent().parent().remove();
caltax();  
});  
$('body').delegate('.quantity,.price,.discount','keyup',function()  
{  
var tr=$(this).parent().parent();  
var qty=tr.find('.quantity').val();  
var price=tr.find('.price').val();  
var dis=parseInt(tr.find('.discount').val()); 
var amt=(qty * price)+dis;
var amt1 =(qty * price)+((13.5/100) * (qty * price))+dis+((15/100) * dis);
tr.find('.tax').val(amt1);  
tr.find('.amount').val(amt);  
total();  
});  
});  
function total()  
{  
var t=0;  
$('.amount').each(function(i,e)   
{  
var amt =$(this).val()-0;  
t+=amt;  
});

var ttt=0;
$('.tax').each(function(i,e)   
{  
var amt1 =$(this).val()-0;  
ttt+=amt1;  
});
$('.tt').html(ttt);
$('.total').html(t); 
 }  

</script>
<br>
<br>
<hr>
<center> Invoice total(Grand Total) is inclusive of VAT @13.5% on total job/parts amount, 
         Service Tax@14%, Swachh Bharat Tax@0.50%, Krishi Kalyan Cess@ 0.50% on total Labour </center>
		                <br> VAT Tin no:
                         CST Tin no:
                         Ser.Tax.no:
                         Pan no:
                         CIN no:
                         Cess Tax n

</body>
</html>