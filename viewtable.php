<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>
<?php
if(isset($_GET['id'])){
  $id=mysqli_real_escape_string($con,$_GET['id']);
  $sql="SELECT * FROM users WHERE id='$id'";
  $query=mysqli_query($con,$sql);
  while($row=mysqli_fetch_assoc($query)){
   
 ?>
<div class="content-wrapper">

    <!-- Modal -->
<div class="modal fade" id="Addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="post">
      <div class="modal-body">
       <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" placeholder="Enter name" class="form-control" value="">
       </div>
       <div class="form-group">
        <label for="">phone</label>
        <input type="text" name="phone" placeholder="phone number" class="form-control" value="">
       </div>
       <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" placeholder="Email id" class="form-control" value="">
       </div>
      <div class="row">
        <div class="col-md-6">
       <div class="form-group">
        <label for="">password</label>
        <input type="password" name="password" placeholder="password" class="form-control" value="">
       </div>
     </div>
     <div class="col-md-6">
       <div class="form-group">
        <label for="">conform password</label>
        <input type="password" name="confirmpassword" placeholder="password" class="form-control" value="">
       </div>
       </div>
       </div>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="adduser" class="btn btn-primary">Save</button>
      </div>
  </form>
    </div>
  </div>
</div>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">Add Users</h1>
        <a href ="usertable.php" class="btn btn-danger float-right">Back</a>
        <div class="row mb-2 justify-content-center">
          <div class="col-sm-6">
            
            <form action="code.php" method="post">
      <div class="modal-body">
       <div class="form-group">
        <label for="">Name</label><br>
        <input type="text" name="name" value="<?php echo $row['name'];?>">
        
       </div>
       <div class="form-group">
        <label for="">phone</label><br>
        <input type="text" name="name" value="<?php echo $row['email'];?>">
        
       </div>
       <div class="form-group">
        <label for="">Email</label><br>
        <input type="text" name="name" value="<?php echo $row['phone'];?>">
       </div>
      <div class="row">
        <div class="col-md-6">
       <div class="form-group">
        <label for="">password</label><br>
        <input type="text" name="name" value="<?php echo $row['password'];?>">
       </div>
     </div>
    </div>
     </div>
      
  </form>
          </div>
        </div>
      </div>
    </div>
     
            </div>
          </div>
          </
              <?php
              include('includes/footer.php');

              ?><?php
            }}?>