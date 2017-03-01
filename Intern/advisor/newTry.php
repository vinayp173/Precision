<html>
<head>
<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<link href="js/select2.min.css" rel="stylesheet" />
		<script src="js/select2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var pcountry=[<?php echo $str; ?>];
				$("#Pcountry").select2({
				  data: pcountry
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				var scountry=[<?php echo $str; ?>];
				$("#Scountry").select2({
				  data: scountry
				});
			});
		</script>
<link rel="stylesheet" href="commonCSS.css">
<style>
table {
    border:1px solid black;
    width: 100%;
}

th, td {
    text-align: left;
	border:1px solid black;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>
<div>