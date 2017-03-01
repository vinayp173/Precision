<?php
include 'connect.php'
?>
<html>
<head>
<link rel='stylesheet' href='index.css'>
<link rel="shortcut icon" href="logofig.jpg" />
<title> Registration Page </title>
</head>
<body>
<center><img src="logo.png" width='35%'></center> 
<form method='post' action ='register_insert.php' >
<table align="center">
<tr><td>Name : </td> <td colspan='2'><input type="Text" name="name" maxlength='50'></td></tr>
<tr><td>Email : </td> <td colspan='2'><input type="email" name="email" maxlength='50'></td></tr>
<tr><td>Address :</td> <td colspan='2'><input type="Text" name="addr" maxlength='50'></td></tr>
<tr><td>Post :</td><td colspan='2'><input type="Text" name="post" maxlength='50'></td></tr>
<tr><td>Contact:</td> <td  colspan='2'><input type="Text" name="contact" maxlength='50'></td></td></tr>
<tr><td colspan='3'><center><button type='Submit' name='register_submit' >Submit</Button></center></td></tr>
</table>
</form>
</body>
</html>