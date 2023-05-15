<?php
session_start();
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
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">update users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <!-- /.content-header -->
    <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">update  users </h3>
                <a href="usertable`.php"class="btn btn-danger float-right">Back</a>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <form action="code.php" method="post">
      <div class="modal-body">
       
        <?php
        if(isset($_GET['id']))
        {
          $id=$_GET['id'];
          $sql="SELECT * FROM `users` WHERE id ='$id' LIMIT 1";
         
          $query_run=mysqli_query($con,$sql);
          
          if(mysqli_num_rows($query_run)>0)
          {
            foreach ($query_run as $row) {

              ?>
              <input type="text" name="user_id" value="<?php echo $row["id"];?>">
             <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" placeholder="Enter name" class="form-control" value="<?php echo $row["name"];?>">
       </div>
       <div class="form-group">
        <label for="">phone</label>
        <input type="text" name="phone" placeholder="phone number" class="form-control" value="<?php echo $row["phone"];?>">
       </div>
       <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" placeholder="Email id" class="form-control" value="<?php echo$row["email"];?>">
       </div>
       <div class="form-group">
        <label for="">password</label>
        <input type="password" name="password" placeholder="password" class="form-control" value="<?php echo $row["password"];?>">
       </div>
              
<?php
}}
          
          else{
            echo "<h4>No records found!..</h4>";
          }
        }


         ?>
       
      </div>
      <div class="modal-footer">
        
        <button type="submit" name="updateuser" class="btn btn-primary">Save</button>
      </div>
  </form>

                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php 
include('includes/footer.php');
?>