<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <!-- <h1></h1> -->
        </div>
        <div class="col-sm-6">
        </div>
      </div>
    </div>
  </section>
      <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>
           <a href="add_view.php"class="btn btn-primary float-right">Add User</a>
        </div>
        <div class="card-body">
                <table class=" table table-bordered" id="example2">
                  <thead>
                    <tr>
                      <th >Id</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <!-- <th>Password</th> -->
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                  	<?php
include('config/dbcon.php');
$c=1;
$sql= "SELECT * FROM `users` ";
$result= $con->query($sql);
  while($row=mysqli_fetch_assoc($result)){
    ?>
      <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["name"];?></td>
      <td><?php echo $row["phone"];?></td>
      <td><?php echo $row["email"];?></td>
      <!-- <td><?php echo $row["password"];?></td> -->
      <td>
     <a href=" viewtable.php?id=<?php echo $row["id"];?>"class="btn btn-primary btn-sm">View</a>
      <a href="update.php?id=<?php echo $row["id"];?> " class="btn btn-success btn-sm">Edit</a>
     <a href=" delete.php?id=<?php echo $row["id"];?>"class="btn btn-danger btn-sm">Delete</a>
      
      </td>
  </tr>
  
<?php 
$c++;
}
?>
</tbody>

</table>

</div>
</div>
</section>
</div>
<?php
              include('includes/footer.php');

              ?>
                    