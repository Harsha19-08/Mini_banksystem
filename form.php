<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
//include('config/dbcon.php');
include('config/dbconnection.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$table = $_GET['table'];
	$sql = "INSERT INTO $table (";
	$fields = array();
	$values = array();

	foreach ($_POST as $field_name => $value) {
		if ($field_name !== 'submit') {
			$fields[] = "`$field_name`";
			$values[] = "'$value'";
		}
	}

	$sql .= implode(",", $fields) . ") VALUES (" . implode(",", $values) . ")";
	if ($con->query($sql)) {
		echo "<script>document.location.href='table.php?name=$table&msg=add'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row justify-content-center">
		<div class="col-md-9  mt-4 p-2">
			<form method="POST">
				<h2 style="color:red" class="offset-3"> <b>User form</b></h2><br>
				<?php
				$table = $_GET['table'];
				?>
				<div class="card card-primary card-outline card-outline-tabs">
					<div class="card-header p-0 border-bottom-0">
						<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">Tab 1</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tab 2</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Tab 3</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content" id="custom-tabs-four-tabContent">
							<div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
								<?php
							    $query="SELECT * FROM form_fields where `table`='$table' and tab_num='1' order by `order` ASC";
								$brands = $con->query($query);
								$c = 1;
								while ($row = $brands->fetch(PDO::FETCH_OBJ)) {
								?>
									<label><b><?php echo $row->field_label; ?> :</b></label><br>
									<input type="<?php echo $row->field_type; ?>" class="form-control" name="<?php echo $row->field_name; ?>" required><br>
								<?php $c++;
								} ?>
							</div>
							<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
								<?php
								$query="SELECT * FROM form_fields where `table`='$table' and tab_num='2' order by `order` ASC";
								$brands = $con->query($query);
								$c = 1;
								while ($row = $brands->fetch(PDO::FETCH_OBJ)) {
								?>
									<label><b><?php echo $row->field_label; ?> :</b></label><br>
									<input type="<?php echo $row->field_type; ?>" class="form-control" name="<?php echo $row->field_name; ?>" required><br>
								<?php $c++;
								} ?>
							</div>
							<div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
								<?php
								$query="SELECT * FROM form_fields where `table`='$table' and tab_num='3' order by `order` ASC";
								$brands = $con->query($query);
								$c = 1;
								while ($row = $brands->fetch(PDO::FETCH_OBJ)) {
								?>
									<label><b><?php echo $row->field_label; ?> :</b></label><br>
									<input type="<?php echo $row->field_type; ?>" class="form-control" name="<?php echo $row->field_name; ?>" required><br>
								<?php $c++;
								} ?>
							</div>
						</div>
					</div>

				</div>
				<br>
				<?php if (!isset($_POST['submit'])) { ?>
					<input type="submit" name="submit" class="btn btn-primary form-control mb-3" value="submit">
				<?php } ?>
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
					<select name="fieldtype[]" class="form-control select2" require>
						<option>Select Here</option>
						<option value="text">Text</option>
						<option value="number">Number</option>
						<option value="textarea">Textarea</option>
					</select>
					<span class="error" style="color:red"><?php echo $fieldnameErr; ?></span><br>
				</td>
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
</script>