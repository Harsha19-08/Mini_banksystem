<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <?php
          include('message.php');
          ?>
        </div>

      </div>
      <!-- /.row -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <?php
          include('config/dbconnection.php');
          //error_reporting(0);
          $stmt = $con->prepare("Select * from users");
          $stmt->execute();

          // Count the number of rows returned
          $table_count = $stmt->rowCount();
          ?>
          <div class="inner">
            <a href="list_users.php" style="color:white">
              <h3><?php echo $table_count; ?>
              </h3>
            </a>

            <a href="list_banners.php" style="color:white">
              <p>Total Account Holders</p>
            </a>
          </div>

          <a href="list_contact.php">
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
<?php
include('includes/footer.php');
?>