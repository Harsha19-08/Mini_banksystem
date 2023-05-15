<?php
include('authentication.php');
include('includes/header.php');
include('includes/script.php');
include('config/dbconnection.php');
extract($_POST);
print_r($_POST);
// Retrieve form data
$fieldtype = isset($_POST['fieldtype']) ? $_POST['fieldtype'][0] : null;
echo $fieldtype;
$options = isset($_POST['options']) ? $_POST['options'] : [];
// Insert data into table
$stmt = $con->prepare("INSERT INTO select_options (field_id, Name) VALUES (?, ?)");
foreach ($options as $option) {
  $stmt->execute([$fieldtype, $option]);
}
?>