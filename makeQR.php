<?php

include("config.php");


$prodName = $_POST['nameOfProduct'];
echo $prodName . " prod name";
echo "<br>";
$numOfProds = $_POST['numberOfProds'];
echo $numOfProds . " Num of prods <br>";
$barcodeValue = $_POST['barcode'];
echo $barcodeValue . " Barcode Value <br>";
$location = $_POST['Location'];

$conn = new mysqli($servername, $username, $password, $dbname);



$myresult = $conn->prepare("SELECT taskid FROM itemcodes WHERE barcodenum = ?");
$myresult->bind_param("s", $barcodeValue);
$myresult->execute();

$mygottenresults = $myresult->get_result();
$thenum_rows = mysqli_num_rows($mygottenresults);
echo "$thenum_rows";
$myresult->close();
if($thenum_rows == 0) {
		
		
		 $sql = $conn->prepare("INSERT INTO itemcodes (prodname, barcodenum, quantity, location) VALUES (?, ?, ?, ?);");
		 $sql->bind_param("ssis", $prodName, $barcodeValue, $numOfProds, $location);
		 
				if ($sql->execute() === TRUE) {
						$sql->close();
 						header('Location: '.'editsuccess.html');
	
				}
					else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
		
		
	
		}


	else {
		header('Location: '.'alreadyexists.html');
	}



if ($result->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
?>