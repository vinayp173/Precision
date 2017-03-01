<html>
<head><link rel="stylesheet" href="commonCSS.css">
<style>
input::-webkit-input-placeholder {
    font-size: 15px;
    line-height: 3;
	
	//*background-color: red !important;
	background-clip: content-box;
}
input :focus{
     //background-color: white !important;

}
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset;
}

</style>
</head>

<body>
<button><a href='addJobC.php' style='text-decoration: none; color:black;'>Back</a></Button>
<div id="borderdiv" style="margin-left:5%; align:center;" align='left'>

<legend><label style='font-size:3em; border-bottom:1px solid black;'>Customer Details</label></legend>
<form action='addJobC.php' method='post'>
<div>
<label style='font-size:2em;'>Name</label><br>
<input type='text' name='Cname' style='margin-left:2em; margin-top:0.5em; height:6%; width:30%;' placeholder='Name'>
</div>
<div>
<label style='font-size:2em;'>E-Mail</label><br><input type='email' name='Cemail' style='margin-left:2em; margin-top:0.5em;height:6%; width:30%;' placeholder='E-Mail'>
</div>
<div>
<label style='font-size:2em;'>Address</label><br><input type='text' name='Caddress' style='margin-left:2em; margin-top:0.5em;height:6%; width:30%;'placeholder='Address'>
</div>
<div>
<label style='font-size:2em;'>Contact</label><br><input type='number' name='Ccontact' style='margin-left:2em; margin-top:0.5em;height:6%; width:30%;'placeholder='Contact Number'>
</div>
<div>
<input type='submit' name='Cadd' value='Create'style='margin-left:4.2em; margin-top:2.5em; width:10%; height:5%;'>
</div>

</form>

</div>


</body>
</html>


