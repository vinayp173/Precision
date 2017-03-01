<!DOCTYPE html>
<html>
<head>
 <link rel='stylesheet' href='index.css'>
 <link rel="shortcut icon" href="logofig.jpg" />
<title>book</title>
<style>
body {margin:0;}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    position: static;
    top: 0;
    width: 100%;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    padding: 16px;
    text-decoration: none;
}

.main {
    padding: 16px;
    margin-top: 30px;
    height: 1500px; /* Used in this example to enable scrolling */
}
</style>
</head>

<body background="t2.png">

<ul>
  <li><a href="welcome.html">Home page</a></li>
  <li><a href="intern/advisor/addJobC.php">New Repair Order</a></li>
  <li><a href="https://goo.gl/JzLeIm">Profile</a></li>
  <li><a href="https://goo.gl/BonRy1">Inventory</a></li>
  <li><a href="https://goo.gl/PTlkCd">New Appointment</a></li>
  <li><a href="receipt.php">Make Receipt</a></li>
  <li><a href="https://goo.gl/G3Dv4K">Current Status</a></li>
  <li></li>
  <li></li>
  <li></li>
  <li><a href="login.html">Log out</a></li> 
</ul>
<br>
<br>
<br>
<br>
<br>
<br><br>
<center><img src="logo.png" width='35%'></center> 
<form method='post' action ='book_action.php' >
<table align="center">
<tr><td>Repair Order No: </td><td><input type="number" name="order"></td></tr>
<tr><td><h3><b><U>Customer details<h3><b><U></td></tr>
<tr><td>Name: </td><td><input type="text" name="name"></td></tr>
<tr><td>Phone number:</td><td><input type="number" name="number"></td></tr>
<tr><td>Residential Address:</td><td><input type="text" name="address"></td></tr>
<tr><td><h3><b><U>Car Details</u></b></h3></td></tr>
<tr><td>Chassis No:</td><td><input type="text" name="name"></td></tr>
<tr><td>Reg. no:</td><td><input type="text" name="reg"></td></tr>
<tr><td>Date</td><td><input type="date" name="date"></td></tr>
<tr><td colspan='3'><center><button type='Submit' name='login_submit' >Add Job</button></center></td></tr>
<tr><td colspan='3'><center><button type='Submit' name='login_submit' >Clear</button></center></td></tr>
<tr><td colspan='3'><center><button onclick="myFunction()">Print Repair Order</button>

<script>
function myFunction() {
    window.print();
}
</script>
</center></td></tr>

<tr></tr>
</table>
</form>