<?php

include("config.php");

$barcode = $_POST['barcode'];
echo $barcode . "<br>";
$conn = new mysqli($servername, $username, $password, $dbname);


$myresult = $conn->prepare("SELECT taskid FROM itemcodes WHERE barcodenum = ?");
$myresult->bind_param("s", $barcode);
$myresult->execute();

$mygottenresults = $myresult->get_result();
$thenum_rows = mysqli_num_rows($mygottenresults);
echo "$thenum_rows";
$myresult->close();
if($thenum_rows == 0) {

	header('Location: '.'quandownerror.html');

}


else {

echo "else";

$go = $conn->prepare("UPDATE itemcodes SET quantity = quantity - 1 WHERE barcodenum = ?;");
$go->bind_param("s", $barcode);

		
		
	if ($go->execute() === TRUE) {
		$go->close();
 		header('Location: '.'quandowndone.html');
	
	}
	else{
		echo "Error: " . $go . "<br>" . $conn->error;
	}	

}
?>