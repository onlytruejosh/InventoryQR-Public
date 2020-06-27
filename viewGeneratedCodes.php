<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generated Codes | InventoryQR</title>
	
	
<!-- Apple iOS App Support -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" href="icon.png">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta name="apple-mobile-web-app-title" content="TrombonesQR">
	
<!-- End of iOS App Code -->
	
	
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.4.1.js"></script>
</head>

<body>
<div class="jumbotron">
	  <h1 class="display-4">View Generated Barcodes</h1>
	  
</div>
	
	<?php
include("config.php");
$sql = "SELECT * FROM generatedbarcodes";
$conn = new mysqli($servername, $username, $password, $dbname);
$results = mysqli_query($conn, $sql);

			

 if(mysqli_num_rows($results) >= 1)
 {
	echo '<table class="table table-striped table-bordered table-hover">'; 
echo "<tr><th>Product</th><th>Barcode</th></tr>"; 
while($row = mysqli_fetch_array($results))
{
  echo "<tr><td>"; 
  
  echo $row['prodname'];

  
  echo "</td><td>";   
  echo $row['barcodenum'];
 
  echo "</td></tr>";  

}
echo "</table>";    
 
	

 
 }
	 ?>
	<br>
	<center>
	 <a href="index.html" draggable="false"><center><img draggable="false" src="lottie/home.svg" style="width:20vw; height: 20vh;" />  </center></a></center><br>
	</body>
</html>