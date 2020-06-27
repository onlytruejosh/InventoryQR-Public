<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory | InventoryQR</title>
	
	
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
	  <h1 class="display-4">View Inventory</h1>
	  
</div>
<div class="container-fluid">
	  <ul id="clothingnav1" class="nav nav-tabs" role="tablist">
	    <li class="nav-item"> <a class="nav-link active" href="#home1" id="hometab1" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Stock Alerts</a> </li>
	    <li class="nav-item"> <a class="nav-link" href="#paneTwo1" role="tab" id="hatstab1" data-toggle="tab" aria-controls="hats">Full List</a> </li>
	    <li class="nav-item"> <a class="nav-link" href="#paneThree" role="tab" id="hatstab2" data-toggle="tab" aria-controls="hats">Search</a> </li>
		  <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Locations</a>
      <div class="dropdown-menu"> <a class="dropdown-item" href="#tabDropDownOne1" role="tab" id="dropdownshoestab1" data-toggle="tab" aria-controls="dropdownShoes">Cupboard</a> <a class="dropdown-item" href="#tabDropDownTwo1" role="tab" id="dropdownbootstab1" data-toggle="tab" aria-controls="dropdownBoots">Freezer</a> </div>
    </li>
  </ul>
	  <!-- Content Panel -->
<div id="clothingnavcontent1" class="tab-content">
	    
		<div role='tabpanel' class='tab-pane fade' id='paneTwo1' aria-labelledby='hatstab1'>
	      <br>
			<?php
include("config.php");		
			
$sql = "SELECT * FROM itemcodes";
$conn = new mysqli($servername, $username, $password, $dbname);
$results = mysqli_query($conn, $sql);
$stockalert_name = array();
$stockalert_quan = array();
$stockalert_loc = array();
			
			
$cupboard_name = array();
$cupboard_quan = array();
$cupboard_barc = array();
			
$freezer_name = array();
$freezer_quan = array();
$freezer_barc = array();
			

 if(mysqli_num_rows($results) >= 1)
 {
	echo '<table class="table table-striped table-bordered table-hover">'; 
echo "<tr><th>Product</th><th>Quantity</th><th>Location</th></tr>"; 
while($row = mysqli_fetch_array($results))
{
  echo "<tr><td>"; 
  if($row['quantity'] < 2){
		echo "<font color=red><b>" . $row['prodname'] . "</b></font>";
	 	$stockalert_name[] = $row['prodname'];
	  	$stockalert_quan[] = $row['quantity'];
	  	$stockalert_loc[] = $row['location'];
	}
	else{
		echo $row['prodname'];
	}
  
  echo "</td><td>";   
  echo $row['quantity'];
  echo "</td><td>";    
  echo $row['location'];
  echo "</td></tr>";  
    if($row['location'] == "Cupboard"){
		
	 	$cupboard_name[] = $row['prodname'];
	  	$cupboard_quan[] = $row['quantity'];
	  	$cupboard_barc[] = $row['barcodenum'];
	}
	if($row['location'] == "Freezer"){
		$freezer_name[] = $row['prodname'];
	  	$freezer_quan[] = $row['quantity'];
		$freezer_barc[] = $row['barcodenum'];
	}
}
echo "</table>";    
 
	

     echo "</div>";
	 echo "<div role='tabpanel' class='tab-pane fade show active' id='home1' aria-labelledby='hometab1'> <br>";
	 echo '<table class="table table-striped table-bordered table-hover">'; 
	 echo "<tr><th>Product</th><th>Quantity</th><th>Location</th></tr>"; 
	 
	 for ($x=0; $x<count($stockalert_name); $x++){
		  echo "<tr><td>"; 
		 echo $stockalert_name[$x];
		   echo "</td><td>"; 
		 echo $stockalert_quan[$x];
		 echo "</td><td>"; 
		 echo $stockalert_loc[$x];
		 echo "</td></tr>";  
	 }
	 echo "</table>";
	 echo "</div>";
	 
	 
	 /* Cupboard Dropdown Menu */
	 
	 echo "<div role='tabpanel' class='tab-pane fade' id='tabDropDownOne1' aria-labelledby='dropdownshoestab1'><br>";
	 
	 echo '<table class="table table-striped table-bordered table-hover">'; 
	 echo "<tr><th>Product</th><th>Quantity</th><th>Barcode</th></tr>"; 
	 
	 for ($x=0; $x<count($cupboard_name); $x++){
		  echo "<tr><td>"; 
		 echo $cupboard_name[$x];
		 echo "</td><td>"; 
		 echo $cupboard_quan[$x];
		 echo "</td><td>"; 
		 echo $cupboard_barc[$x];
		 echo "</td></tr>";  
	 }
	 echo "</table>";
	 
	 echo "</div>";
	 
	 /* Freezer Dropdown Menu */
	 
	 echo '<div role="tabpanel" class="tab-pane fade" id="tabDropDownTwo1" aria-labelledby="dropdownbootstab1"><br>';
	 
	 echo '<table class="table table-striped table-bordered table-hover">'; 
	 echo "<tr><th>Product</th><th>Quantity</th><th>Barcode</th></tr>"; 
	 
	 for ($x=0; $x<count($freezer_name); $x++){
		  echo "<tr><td>"; 
		 echo $freezer_name[$x];
		 echo "</td><td>"; 
		 echo $freezer_quan[$x];
		 echo "</td><td>"; 
		 echo $freezer_barc[$x];
		 echo "</td></tr>";  
	 }
	 echo "</table>";
	 
	 echo "</div>";
	 
 }

  
  
  
?>
			
			
				
	<div role='tabpanel' class='tab-pane fade' id='paneThree' aria-labelledby='hatstab2'><br>
			
		<script src="search/databaseSearch.js" ></script>
		<form onsubmit="return fetch();">
      <h1>Search</h1>
      <input type="text" id="search" required/>
      <input type="submit" class="btn btn-primary" value="Search"/>
    </form>

    <!-- [SEARCH RESULTS] -->
    	<div id="results"></div>
			
				
				
				
			
			</table>
		</div>
<br>
	<center>
	 <a href="index.html"><center><img src="lottie/home.svg" style="width:20vw; height: 20vh;" />  </center></a></center><br>
			

	

</body>
	<footer>
	
	</footer>
</html>