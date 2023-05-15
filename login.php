<?php
session_start();
include('includes/header.php');
error_reporting(0);
?>

<div class="section">
	<div class="row justify-content-center">
		<div class="col-md-5 my-5">
			<div class="card my-5">
				<div class="card-header bg-light">
					<h5>login form</h5>
				</div>
				<div class="card-body">
					<?php 
                  if(isset($_SESSION['auth_status']))
	             {
	             ?>
	           <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey</strong><?php echo $_SESSION['auth_status'];?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
           </div>
        <?php
           unset($_SESSION['auth_status']);
           }
?>
					<?php
	   if($_GET['err'] == 'log') {
	      echo "<br /><br /><h4 align='center' style='color:#FF0000;'>Invalid Login Details</h4>";
	   }
	    if($_GET['err'] == 'pwd') {
	      echo "<br /><br /><h4 align='center' style='color:#FF0000;'>Invalid Login Details</h4>";
	   }
	   if($_GET['err'] == 'timeout') {
	      echo "<br /><br /><h4 align='center' style='color:#FF0000;'>Session Time Out.To Login Again Type your user name and password to Login</h4>";
	   }
	    if($_GET['err'] == 'lout') {
	      echo "<br /><br /><h4 align='center' style='color:#FF0000;'>You Have Successfully Logged Out.</h4>";
	   }
	   if($_GET['err'] == 'location') {
	      echo "<br /><br /><h4 align='center' style='color:#FF0000;'>You Are Not authorized To Login From This Computer.</h4>";
	   }
	?>
					<form action="logincode.php" method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="username" value="" class="form-control" placeholder="Enter email">
							<!-- <span class="error" style="color:red"> <?php echo $emailErr;?></span> -->
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" value="" placeholder="Enter password" class="form-control">
							<!-- <span class="error" style="color:red"> <?php echo $passwordErr;?></span> -->
						</div>
						
						<input type="submit" name="login_btn" class="bg-primary">

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include('includes/script.php');
include('includes/footer.php');
?>