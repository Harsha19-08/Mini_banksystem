<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('config/dbconnection.php');
include('config/dbcon.php');
error_reporting(0);
if (isset($_GET['delid'])) {
  $did = $_GET['delid'];
  $brands = $con->prepare("DELETE FROM `brands`WHERE entry_id='$did' ");
  $query_execute = $brands->execute();
  if ($query_execute) {
    echo "<script>document.location.href='list_brands.php?msg=delete'</script>";
  }
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1><?= $_GET['name']; ?> table</h1>
        </div>
        <div class="col-sm-6">
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><a href="list_baners.php" class="btn btn-warning float-right">Go Back</a></h3> 
        <a href="form.php?table=<?= $_GET['name']; ?>" class="btn btn-primary float-right">Add New</a>
      </div>
      <div class="col-12">
        <?php

        if ($_GET['msg'] == 'update') { ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Updated Successfully..!
          </div>
        <?php } ?>
        <?php if ($_GET['msg'] == 'add') { ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Added Successfully..!
          </div>
        <?php } ?>
        <?php if ($_GET['msg'] == 'delete') { ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Deleted Successfully..!
          </div>
        <?php } ?>

      </div>
      <div class="card-body">
        <?php
        $table_name = $_GET['name'];


        // Build the SQL query to select all rows from the table
        $sql = "SELECT * FROM $table_name";

        // Execute the SQL query and store the results
        $result = mysqli_query($con, $sql);

        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
          // Output a table header row with column names
          echo "<table class='table table-bordered' id='example2' border='3'><tr>";
          while ($field_info = mysqli_fetch_field($result)) {
            echo "<th>{$field_info->name}</th>";
          }
          echo "</tr>";

          // Output each row of the table
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>$value</td>";
            }
            echo "</tr>";
          }

          // Close the table tag
          echo "</table>";
        } else {
          echo "<table class='table table-bordered' id='example2' border='3'><tr>";
          while ($field_info = mysqli_fetch_field($result)) {
            echo "<th>{$field_info->name}</th>";
          }
          echo "</tr>";
          echo "<tbody><tr><td>No rows found</td></tr></tbody>";
          echo "</table>";
        }

        // Close the database connection
        mysqli_close($db);
        ?>