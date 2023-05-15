<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('config/dbconnection.php');
$fieldnameErr = $fieldtypeErr = $ageErr = $emailErr = $mobileErr = "";
$fullname =  $age = $email = $mobile = $gender = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (empty($_POST['fullname'])) {
		$fieldnameErr = 'This field is required';
	} else {
		$fieldname = $_POST['fullname'];
	}
	if (empty($_POST['gender'])) {
		$fieldtypeErr = 'This field is required';
	} else {
		$fieldtype = $_POST['gender'];
	}
	if (empty($_POST['age'])) {
		$ageErr = 'This field is required';
	} else {
		$age = $_POST['age'];
	}
	if (empty($_POST['email'])) {
		$emailErr = 'This field is required';
	} else {
		$email = $_POST['email'];
	}
	if (empty($_POST['mobile'])) {
		$mobileErr = 'This field is required';
	} else {
		$mobile = $_POST['mobile'];
	}
	if ($fieldname != '' && $fieldtype != '' && $age != '' && $email != '' && $mobile != '') {
		$sql = "INSERT INTO `mini_banksystem`.`users`( `Fullname`, `Age`, `Gender`, `Email`,`Mobile`) VALUES";
		foreach ($fieldname as $key => $value) {
			$sql .= "('" . $value . "','" . $age[$key] . "','" . $fieldtype[$key] . "','" . $email[$key] . "','" . $mobile[$key] . "'),";
		}
		$sql = rtrim($sql, ", ");
			$sql = $con->query($sql);
			echo "<script>document.location.href='list_users.php?msg=add'</script>";
	}
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="ml-5">
		<div class="col-md-12 p-2">
			<h2 style="color:red" class="text-center pb-5"> <b>Create Multiple Accounts</b></h2>
			<form method="POST">
				<div id="choices-list">
					<div class="d-flex w-100 choice-item my-3">
						<tr>
							<div class="col-3">
								<td>
									<label>Full Name</label>
									<input type="text" name="fullname[]" id="name" class="form-control" require>
									<span class="error" style="color:red"><?php echo $fieldnameErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Gender</label>
									<select name="gender[]" class="form-control select2" require>
										<option>Select Here</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
									<span class="error" style="color:red"><?php echo $fieldtypeErr; ?></span><br>
								</td>
							</div>
							<div class="col-1">
								<td>
									<label>Age</label>
									<input type="number" name="age[]" id="length" class="form-control" value="<?php echo $age; ?>" require>
									<span class="error" style="color:red"><?php echo $ageErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Email</label>
									<input name="email[]" id="email" type="email" class="form-control" value="<?php echo $email; ?>" require>
									<span class="error" style="color:red"><?php echo $emailErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Mobile</label>
									<input type="text" name="mobile[]" class="form-control" value="<?php echo $mobile; ?>" require>
									<span class="error" style="color:red"><?php echo $mobileErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label></label>
									<button id="remove0" class="btn btn-sm btn-outline-danger btn-flat rem-choice"><i class="fa fa-times"></i></button>
								</td>
							</div>
						</tr>
					</div>
				</div>
				<div class="text-left">
					<button class="btn btn-flat btn-success btn-sm border" id="add_choice_item" type="button"> <i class="fa fa-plus"></i> Add New</button>
				</div><br><br>
				<button type="submit" name="submit" class="btn btn-primary  mb-3">submit</button>
			</form>
		</div>
	</div>
</div>
<noscript id="choice-clone">
	<div class="d-flex w-100 choice-item my-3">
		<tr>
			<div class="col-3">
				<td>
					<input type="text" name="fullname[]" id="name" class="form-control" require>
					<span class="error" style="color:red"><?php echo $fieldnameErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<select name="gender[]" class="form-control select2" require>
						<option>Select Here</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
					<span class="error" style="color:red"><?php echo $fieldtypeErr; ?></span><br>
				</td>
			</div>
			<div class="col-1">
				<td>
					<input type="number" name="age[]" id="length" class="form-control" value="<?php echo $age; ?>" require>
					<span class="error" style="color:red"><?php echo $ageErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<input name="email[]" id="email" type="email" class="form-control" value="<?php echo $email; ?>" require>
					<span class="error" style="color:red"><?php echo $emailErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<input type="text" name="mobile[]" class="form-control" value="<?php echo $mobile; ?>" require>
					<span class="error" style="color:red"><?php echo $mobileErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<label></label>
					<button id="remove0" class="btn btn-sm btn-outline-danger btn-flat rem-choice"><i class="fa fa-times"></i></button>
				</td>
			</div>
		</tr>
	</div>
	</div>
</noscript>
<script>
	function new_item($val = '') {
		var item = $($('noscript#choice-clone').html()).clone()
		$('#choices-list').append(item)
		if ($val != "")
			item.find('[name="fieldname[]"]').val($val)
		item.find('[name="fieldname[]"]').focus()
		item.find('.rem-choice:not([disabled])').click(function() {
			item.remove()
		})
	}
	$(document).ready(function() {
		$('#add_choice_item:not([disabled])').click(function() {
			new_item()
		})

	})
</script>