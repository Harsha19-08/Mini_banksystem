<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('config/dbconnection.php');
$headingErr = $pageErr = $fieldnameErr = $fieldtypeErr = $typeErr = $orderErr = $lengthErr = $tabnumErr = $statusErr = "";
$heading = $fieldname =  $page = $type = $fieldtype = $order = $length = $tabnum = $status = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (empty($_POST['pagename'])) {
		$pageErr = 'This field is required';
	} else {
		$page = trim($_POST['pagename']);
	}
	if (empty($_POST['tablename'])) {
		$headingErr = 'This field is required';
	} else {
		$heading = $_POST['tablename'];
	}
	if (empty($_POST['fieldname'])) {
		$fieldnameErr = 'This field is required';
	} else {
		$fieldname = $_POST['fieldname'];
	}
	if (empty($_POST['fieldtype'])) {
		$fieldtypeErr = 'This field is required';
	} else {
		$fieldtype = $_POST['fieldtype'];
	}
	if (empty($_POST['type'])) {
		$typeErr = 'This field is required';
	} else {
		$type = $_POST['type'];
	}
	if (empty($_POST['length'])) {
		$lengthErr = 'This field is required';
	} else {
		$length = $_POST['length'];
	}
	if (empty($_POST['tab_num'])) {
		$tabnumErr = 'This field is required';
	} else {
		$tabnum = $_POST['tab_num'];
	}
	if (empty($_POST['order'])) {
		$orderErr = 'This field is required';
	} else {
		$order = $_POST['order'];
	}
	if (empty($_POST['status'])) {
		$statusErr = 'This field is required';
	} else {
		$status = $_POST['status'];
	}

	if ($heading != '' && $page != '') {
		$query = "CREATE TABLE `gotaxesnow`.`$heading` (";

		foreach ($fieldname as $key => $value) {
			$query .= "" . $value . " " . $type[$key] . "(" . $length[$key] . ") NOT NULL, ";
		}
		// Remove the trailing comma and space from the query
		$query = rtrim($query, ", ") . ") ENGINE = InnoDB;";
		$baners = $con->query($query);
		$sql = "INSERT INTO `gotaxesnow`.`form_fields`( `field_name`, `field_label`, `field_type`, `table`,`tab_num`,`order`) VALUES";
		foreach ($fieldname as $key => $value) {
			$sql .= "('" . $value . "','" . $value . "','" . $fieldtype[$key] . "','" . $heading . "','" . $tabnum[$key] . "','" . $order[$key] . "'),";
		}
		$sql = rtrim($sql, ", ");
		$sql = $con->query($sql);
		echo "<script>document.location.href='list_baners.php?msg=add'</script>";
	}
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row ml-5">
		<div class="col-md-9  mt-4 p-2">
			<form method="POST">
				<h2 style="color:red" class="offset-3"> <b>Admin</b></h2>
				<label><b>html page name:</b></label>
				<input type="text" name="pagename" class="form-control" value="<?php echo $page; ?>">
				<span class="error" style="color:red"><?php echo $pageErr; ?></span><br>
				<label><b>Table Name:</b></label>
				<input type="text" name="tablename" class="form-control" value="<?php echo $heading; ?>">
				<span class="error" style="color:red"><?php echo $headingErr; ?></span><br><br>
				<div id="choices-list">
					<div class="d-flex w-100 choice-item my-3">
						<tr>
							<div class="col-2">
								<td>
									<label>Name</label>
									<input type="text" name="fieldname[]" id="name" class="form-control" require>
									<span class="error" style="color:red"><?php echo $fieldnameErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Form Field Type</label>
									<select name="fieldtype[]" class="form-control select2" require>
										<option>Select Here</option>
										<option value="text">Text</option>
										<option value="number">Number</option>
										<option value="textarea">Textarea</option>
									</select>
									<span class="error" style="color:red"><?php echo $fieldtypeErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Datatype</label>
									<select name="type[]" class="form-control select2" require>
										<option>Select type</option>
										<option value="INT" title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option>
										<option value="VARCHAR" title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option>
										<option value="TEXT" title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option>
									</select>
									<span class="error" style="color:red"><?php echo $typeErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Length</label>
									<input type="number" name="length[]" id="length" class="form-control" value="<?php echo $length; ?>" require>
									<span class="error" style="color:red"><?php echo $lengthErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Page Tab Number</label>
									<input name="tab_num[]" id="tab_num" type="number" class="form-control" value="<?php echo $tabnum; ?>" require>
									<span class="error" style="color:red"><?php echo $tabnumErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Order By</label>
									<input type="number" name="order[]" class="form-control" value="<?php echo $order; ?>" require>
									<span class="error" style="color:red"><?php echo $orderErr; ?></span><br>
								</td>
							</div>
							<div class="col-2">
								<td>
									<label>Status</label>
									<select name="status[]" class="form-control select2" require>
										<option value="active">Active</option>
										<option value="inactive">In Active</option>
									</select>
									<span class="error" style="color:red"><?php echo $statusErr; ?></span><br>
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
					<button class="btn btn-flat btn-default btn-sm border" id="add_choice_item" type="button"> <i class="fa fa-plus"></i> Add New</button>
				</div><br><br>
				<button type="submit" name="submit" class="btn btn-primary form-control mb-3">submit</button>
			</form>
		</div>
	</div>
</div>
<noscript id="choice-clone">
	<div class="d-flex w-100 choice-item my-3">
		<tr>
			<div class="col-2">
				<td>
					<input type="text" name="fieldname[]" id="name" class="form-control" require>
					<span class="error" style="color:red"><?php echo $fieldnameErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<select name="fieldtype[]" class="form-control select2" onchange="showOptions(this)" require>
						<option>Select Here</option>
						<option value="text">Text</option>
						<option value="number">Number</option>
						<option value="textarea">Textarea</option>
					</select>
					<span class="error" style="color:red"><?php echo $fieldnameErr; ?></span><br>
				</td>
				<div id="options-container" style="display:none;">
					<label for="options">Options:</label>
					<input type="text" name="options[]" id="options">
					<button type="button" onclick="addOption()">Add</button>
				</div>
			</div>
			<div class="col-2">
				<td>
					<select name="type[]" class="form-control select2" require>
						<option>Select Type</option>
						<option value="INT" title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option>
						<option value="VARCHAR" title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option>
						<option value="TEXT" title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option>
					</select>
					<span class="error" style="color:red"><?php echo $typeErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<input type="number" name="length[]" id="length" class="form-control" value="<?php echo $length; ?>" require>
					<span class="error" style="color:red"><?php echo $lengthErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<input name="tab_num[]" id="tab_num" type="number" class="form-control" value="<?php echo $tabnum; ?>" require>
					<span class="error" style="color:red"><?php echo $tabnumErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<input type="number" name="order[]" class="form-control" value="<?php echo $order; ?>" require>
					<span class="error" style="color:red"><?php echo $orderErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
					<select name="status[]" class="form-control select2" require>
						<option value="active">Active</option>
						<option value="inactive">In Active</option>
					</select>
					<span class="error" style="color:red"><?php echo $statusErr; ?></span><br>
				</td>
			</div>
			<div class="col-2">
				<td>
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

	function showOptions(select) {
		var container = document.getElementById("options-container");
		if (select.value == "selectbox") {
			container.style.display = "block";
		} else {
			container.style.display = "none";
		}
	}

	function addOption() {
		var optionsInput = document.getElementById("options");
		var optionsSelect = document.getElementsByName("fieldtype[]")[0];
		var option = document.createElement("option");
		option.value = optionsInput.value;
		option.text = optionsInput.value;
		optionsSelect.add(option);
		optionsInput.value = "";
	}
</script>