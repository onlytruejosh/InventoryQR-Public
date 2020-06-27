
<?php

// (1) DATABASE CONFIG
// ! CHANGE THESE TO YOUR OWN !
include("../config.php");

// (2) CONNECT TO DATABASE
try {
  $pdo = new PDO(
    "mysql:host=" . $servername . ";charset=" . $charset . ";dbname=" . $dbname,
    $username, $password, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false ]
  );
} catch (Exception $ex) {
  die($ex->getMessage());
}

// (3) SEARCH
$stmt = $pdo->prepare("SELECT * FROM `itemcodes` WHERE `prodname` LIKE ? OR `barcodenum` LIKE ?");
$stmt->execute(["%" . $_POST['search'] . "%", "%" . $_POST['search'] . "%"]);
$results = $stmt->fetchAll();
if (isset($_POST['ajax'])) { echo json_encode($results); }
?>