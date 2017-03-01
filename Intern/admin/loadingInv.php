<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).
$(window).unload(function() {
	<?php load();?>
})
</script>
<?php
function load(){
	header("Location: loading.php");	
}
?>
 <html>
 <head>
 <style>
	.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('images/please_Wait.gif') 50% 50% no-repeat rgb(249,249,249);
	}
 </style>
 </head>
 <body>
 <div class="loader"></div>

 </body>
 </html>
