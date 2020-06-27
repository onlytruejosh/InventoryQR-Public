<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Custom Barcode | InventoryQR</title>
<link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	
	<div class="jumbotron">
	  <h1 class="display-4">Generate Barcode</h1>
	  <p class="lead">Please use this service to generate custom 7 digit barcode numbers validated not to conflict with any existing database entries</p>
	  
    </div>
		
    </body>
</html>

<?php
$productName = $_POST['productName'];
$servername = "localhost";
$username = "inventoryuser";
$password = "DsTz2p6Vhsibrbodaci9MUqPzujJXMJdm5gZtKu7oQyqN2mcAD4CK55f363QE8NLoQJaVJiDj";
$dbname = "homeinventory";
$barcodeNum = rand(1000000,9999999);

$conn = new mysqli($servername, $username, $password, $dbname);

$existYetONE = $conn->query("SELECT taskid FROM generatedbarcodes WHERE barcodenum = '$barcodeNum'");
$existYetTWO = $conn->query("SELECT taskid FROM itemcodes WHERE barcodenum = '$barcodeNum'");
if($existYetONE->num_rows == 0){
	if($existYetTWO->num_rows == 0){
		
		$insert = $conn->prepare("INSERT INTO generatedbarcodes (barcodenum, prodname) VALUES (?, ?)");
		$insert->bind_param("is", $barcodeNum, $productName);
		if($insert->execute() == TRUE){
			echo "<p class='lead extraPad'>Your generated barcode number for '$productName' is: $barcodeNum</p>";
			echo "<p class='extraPad'>Please use this code to generate a barcode using an external service. <b>You WILL need to add this number using the Add Item page.</b></p>";
			echo "<a href='generateBarcode.html' draggable='false'><button type='button' class='btn btn-primary' style='margin: 1vw;''>Add another custom item</button></a>";
		}
		else{
			echo "bad";
		}
	}
	else{
		echo("<p class='extraPad'>FATAL ERROR, please run this again!</p>");
	}
	
}
else{
	echo("<p class='extraPad'>FATAL ERROR, please run this again!</p>");
}


?>