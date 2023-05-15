<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('config/dbconnection.php');
error_reporting(0);
if(isset($_GET['delid'])) {
  $did = $_GET['delid'];
  $sql =$con->prepare( "UPDATE `users`  SET Status='1'  WHERE Sno='$did' ");
   $query_execute=$sql->execute();
 if($query_execute)
 {
    echo "<script>document.location.href='list_users.php?msg=delete'</script>";
 }
 }
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
           <h3 class="card-title">View Users</h3> 
           <a href="add_users.php"class="btn btn-primary float-right">Add New </a>
        </div>
        <div class="col-12">
             <?php 
             
             if($_GET['msg'] == 'update') { ?>
                 <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Updated Successfully..!
                </div>
                <?php } ?>  
                <?php if($_GET['msg'] == 'add') { ?>
                 <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Added Successfully..!
                </div>
                <?php } ?>
                <?php if($_GET['msg'] == 'delete') { ?>
                 <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Deleted Successfully..!
                </div>
                <?php } ?>

        </div>
        <div class="card-body">
                <table class=" table table-bordered" id="example2" border="3">
                  	<thead>
                    	<tr>
			              	<th >Entry Id</th>
			              	<th>Full Name</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Email</th>
			              	<th>Mobile</th>
			              	<th>Action</th>
                    	</tr>
                  </thead>
                <tbody>
	<?php
	   $baners=$con->query("SELECT * FROM `users`ORDER BY Sno DESC ");
	   $c=1;
		while($row=$baners->fetch(PDO::FETCH_OBJ)){
	?>
	    <tr>
		    <td><?php echo $c;?></td>
		     <td><?php echo $row->Fullname;?></td>
         <td><?php echo $row->Age;?></td>
		    <td><?php echo $row->Gender;?></td>
		    <td><?php echo $row->Email;?></td>
		    <td><?php echo $row->Mobile;?></td>
        <td>
		      <!-- <a href="update_users.php?id=<?php echo $row->Sno;?> " class="btn btn-success btn-sm" name="update"><i class="fa fa-edit"></i></a> -->
		      <a href="?delid=<?php echo $row->Sno;?>" onclick="return confirm ('Are you sure want to delete')"class="btn btn-danger btn-sm" name="delete"><i class="fa fa-trash"></i></a>
		   </td>
	   </tr>   

<?php 
	$c++; 
}
?>
</tbody>

</table>