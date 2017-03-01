<?php
 session_start();
if(!isset ($_SESSION['id'])){
header("Location: login.php");
}  

?>
<html>
<head>
 <link rel='stylesheet' href='index.css'>
 <link rel="shortcut icon" href="f12.jpg" />
<title>Precision Autoworkz</title>
<style>
body {margin:0;}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    position: fixed;
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
  <li><a href="welcome.php">Home page</a></li>
  <li><a href="/Precision/Intern/advisor/addJobC.php">Repair Order</a></li>
  <li><a href="getData.php">Print Repair Order</a></li>
  <li><a href="intern/advisor/addJobC.php">Inventory admin</a></li>
  <li><a href="https://goo.gl/JzLeIm">Feedback analysis</a></li>
  <li><a href="https://goo.gl/PTlkCd">New Appointment</a></li>
  <li><a href="invoice/getData.php">Receipt</a></li>
  <li><a href="https://goo.gl/G3Dv4K">Current Status</a></li>
  <li><a href="/Precision/Intern/advisor/profile.php">Change Password</a></li>
  <li></li>
  <li></li>
  <li><a href="logout.php">Log out</a></li> 
</ul>
<br>
<br>
<br>
<br>
<center><img src="logo.png" width='35%'></center> 
<br></br>
<br></br>
<center><h1><b>Precision Autoworkz</b></h1></center>
<center><i>(Express Service and Upgrade center)</i></center>
<form method='post' action ='authenticate.php' >
<br><br><br>
<table align="center">
<tr><td colspan='3'><h1><center>WELCOME!</h1></center></td></tr>
<tr><td colspan='3'>Please select the options from the menu.</td></tr>
<tr></tr>
<tr></tr>
<tr><td>You are logged in as  : </td> <td><input type="text" name="Username" maxlength='50' value="<?php echo $_SESSION['username']; ?>"></td></td></tr>
</table>
</form>
</body>
</html>
