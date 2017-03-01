<?php  
$cn=mysql_connect('localhost','root','');  
if ($cn)  
{  
mysql_select_db('tbl',$cn);  
}  
if(isset($_POST['save']))  
{  
$name=$_POST['name'];  
$location=$_POST['location'];
$ph=$_POST['ph'];
mysql_query("insert into tbl_order(name,location,ph) VALUES ('$name','$location','$ph')");  
$id=mysql_insert_id();  
for($i = 0; $i<count($_POST['productname']); $i++)  
{  
mysql_query("INSERT INTO tbl_orderdetail  
SET   
order_id = '{$id}',  
product_name = '{$_POST['productname'][$i]}',  
quantity = '{$_POST['quantity'][$i]}',  
price = '{$_POST['price'][$i]}',  
discount = '{$_POST['discount'][$i]}',  
amount = '{$_POST['amount'][$i]}'");   
}  
}   
?> 














<!DOCTYPE html>  
    <html>  
  
    <head>  
        <title>Job Estimate</title>  
    </head>  
    <script src="js1.js">  
        </script>  
        <script src="js2.js">  
            </script>  
            <link rel="stylesheet" href="bootstrap.css">  
            <link rel='stylesheet' type='text/css' href='style.css' />
			<link rel='stylesheet' type='text/css' href='print.css' media="print" />
			<script src="js3.js"></script>  
            <script src="js4.js"></script>  
  
            <body>  
                	<div id="static">

		<center><h1><b>Job Estimate</b><h1></center>
		
		<div id="identity">
		
            <textarea id="address">Precision AutoWorkz
MIDC, Rabale
Navi Mumbai

Phone: (555) 555-5555</textarea>

 <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="logo.png" alt="logo" />
            </div>
				
				
				<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title">Precision AutoWorkz.
c/o Rohit Rhijwani</textarea>

				<form action="" method="POST">  
                    <div class="box box-primary">  
                        <div class="box-header">  
                            <h3 class="box-title">Job Estimate </h3>  
                        </div>  
                        <div class="box-body">  
                            <div class="form-group">  
                                ReceiptName  
                                <input type="text" name="name" class="form-control">  
                            </div>  
                            <div class="form-group">  
                                Location  
                                <input type="text" name="location" class="form-control">  
                            </div>  
                                <div class="form-group">  
                                phone Number 
                                <input type="text" name="ph" class="form-control">  
                            </div>                        

					   </div>  
                        <input type="submit" class="btnbtn-primary" name="save" value="Save Record">  
                    </div><br/>  
                    <table class="table table-bordered table-hover">  
                        <thead>  
                            <th>No</th>  
                            <th>Product Name</th>  
                            <th>Quantity</th>  
                            <th>Price</th>  
                            <th>Discount</th>  
                            <th>Amount</th>  
                            <th><input type="button" value="+" id="add" class="btnbtn-primary"></th>  
                        </thead>  
                        <tbody class="detail">  
                            <tr>  
                                <td class="no">1</td>  
                                <td><input type="text" class="form-control productname" name="productname[]"></td>  
                                <td><input type="text" class="form-control quantity" name="quantity[]"></td>  
                                <td><input type="text" class="form-control price" name="price[]"></td>  
                                <td><input type="text" class="form-control discount" name="discount[]"></td>  
                                <td><input type="text" class="form-control amount" name="amount[]"></td>  
                                <td><a href="#" class="remove">Delete</td>  
</tr>  
</tbody>  
<tfoot>  
<th></th>  
<th></th>  
<th></th>  
<th></th>  
<th></th>  
<th style="text-align:center;" class="total">0<b></b></th>  
</tfoot>  
  
</table>  
</form> 
<div id="terms">
		  <h4>Terms</h4>
		  <textarea>Job Estimates are subject to change depending on the actual work being carried out on the vehicle.</textarea>
		</div> 

 

<script type="text/javascript">  
function addnewrow()   
{  
var n=($('.detail tr').length-0)+1;  
var tr = '<tr>'+  
'<td class="no">'+n+'</td>'+  
'<td><input type="text" class="form-control productname" name="productname[]"></td>'+  
'<td><input type="text" class="form-control quantity" name="quantity[]"></td>'+  
'<td><input type="text" class="form-control price" name="price[]"></td>'+  
'<td><input type="text" class="form-control discount" name="discount[]"></td>'+  
'<td><input type="text" class="form-control amount" name="amount[]"></td>'+  
'<td><a href="#" class="remove">Delete</td>'+  
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
});  
$('body').delegate('.quantity,.price,.discount','keyup',function()  
{  
var tr=$(this).parent().parent();  
var qty=tr.find('.quantity').val();  
var price=tr.find('.price').val();  
  
var dis=tr.find('.discount').val();  
var amt =(qty * price)-(qty * price *dis)/100;  
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
$('.total').html(t);  
}  

</script>
</body>
</html>