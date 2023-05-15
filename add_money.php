<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('config/dbconnection.php');
error_reporting(0);
$userErr = $ammountErr  = "";
$username =  $ammount = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (empty($_POST['username'])) {
		$userErr = 'This field is required';
	} else {
		$user = $_POST['username'];
	}
	if (empty($_POST['ammount'])) {
		$ammountErr = 'This field is required';
	} else {
		$ammount = $_POST['ammount'];
	}
	if ($user != '' && $ammount != '') {
		$sql = "UPDATE users SET balance=balance+'$ammount' where Sno='$user'";
			$sql = $con->query($sql);
      $balance = $_SESSION['Acbal'];
      $balance -= $ammount;
      $_SESSION['Acbal'] = $balance;
      header("Refresh:0");
			echo "<script>document.location.href='add_money.php?msg=add'</script>";
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
        <form method="POST">
          <div class="row">

          
          <div class="col-md-4">
          <label>Account Holder:</label>
          <select name="username" class="form-control select2" required>
										<option>Select Here</option>
                    <?php 
                     $users=$con->query("SELECT * FROM `users`ORDER BY Sno DESC ");
                    while($row=$users->fetch(PDO::FETCH_OBJ)){ ?>
                          <option value="<?= $row->Sno; ?>"><?= $row->Fullname; ?></option>
                    <?php } ?>
									</select>
									<span class="error" style="color:red"><?php echo $userErr; ?></span><br>
          </div>
          <div class="col-md-4">
          <label>Ammount:</label>
          <input type="number" name="ammount" class="form-control" placeholder=".00" required>
          <span class="error" style="color:red"><?php echo $ammountErr; ?></span><br>
          </div>
          <div class="col-md-2">
          <label></label>
          <input type="submit" class="btn-primary form-control" value="Add" >
          </div>
          </div>	
        </form>
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
                      <th>Gender</th>
                      <th>Email</th>
			              	<th>Mobile</th>
			              	<th>Balance</th>
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
		    <td><?php echo $row->Gender;?></td>
		    <td><?php echo $row->Email;?></td>
		    <td><?php echo $row->Mobile;?></td>
        <td><?php echo $row->balance;?></td>
	   </tr>   

<?php 
	$c++; 
}
?>
</tbody>

</table>