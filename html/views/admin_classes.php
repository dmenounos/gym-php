<?php include_once('index.php'); ?>
<div class="page classes-admin-page">

	<div id="form-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-title">Τμήμα</h4>
				</div>
				<form method="post">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?=$this->id?>" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group <?=field_status($this->name_validation);?>">
									<label for="name">Όνομα</label>
									<input type="text" class="form-control" name="name" value="<?=$this->name?>" placeholder="Όνομα" />
									<?=field_message($this->name_validation);?>
								</div>
								<div class="form-group <?=field_status($this->day_validation);?>">
									<label for="day">Ημέρα</label>
									<input type="text" class="form-control" name="day" value="<?=$this->day?>" placeholder="Ημέρα" />
									<?=field_message($this->day_validation);?>
								</div>
								<div class="form-group <?=field_status($this->program_id_validation);?>">
									<label for="program_id">Πρόγραμμα</label>
									<select class="form-control" name="program_id">
									<?php
									for ($i = 0; $i < count($this->programs); $i++) {
										$program = $this->programs[$i];
										echo "<option value='$program[id]'" . ($program[id] == $this->program_id ? "selected" : "") . ">";
										echo "$program[name]";
										echo "</option>";
									}
									?>
									</select>
									<?=field_message($this->program_id_validation);?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group <?=field_status($this->start_validation);?>">
									<label for="start">Ώρα έναρξη</label>
									<input type="text" class="form-control" name="start" value="<?=$this->start?>" placeholder="Ώρα έναρξης" />
									<?=field_message($this->start_validation);?>
								</div>
								<div class="form-group <?=field_status($this->end_validation);?>">
									<label for="end">Ώρα ήξης</label>
									<input type="text" class="form-control" name="end" value="<?=$this->end?>" placeholder="Ώρα λήξης" />
									<?=field_message($this->end_validation);?>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Κλείσιμο</button>
						<button type="submit" class="btn btn-primary">Υποβολή</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	if (isset($_REQUEST['action']) && ($_REQUEST['action'] == "create" || $_REQUEST['action'] == "update")) {
		echo "<script>$('#form-modal').modal('show')</script>";
	}
	?>

	<div class="container main-container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="pull-left">Τμήματα</h3>
				<a class="btn btn-primary pull-right" href='?page=admin_classes&action=create'>
					Εισαγωγή Τμήματος
				</a>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td>ID</td>
							<td>Όνομα</td>
							<td>Περιγραφή</td>
							<td>Ηλικία min</td>
							<td>Ηλικία max</td>
							<td>Κόστος</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < count($this->classes); $i++) {
							$class = $this->classes[$i];
							$program = NULL;
							for ($j = 0; $j < count($this->programs); $j++) {
								if ($this->programs[$j]['id'] == $class['program_id']) {
									$program = $this->programs[$j];
									break;
								}
							}
							echo "<tr>";
							echo "  <td>$class[id]</td>";
							echo "  <td>$class[name]</td>";
							echo "  <td>$class[day]</td>";
							echo "  <td>$class[start]</td>";
							echo "  <td>$class[end]</td>";
							echo "  <td>";
							if (!empty($program)) {
								echo "$program[name]";
							}
							echo "  </td>";
							echo "  <td>";
							echo "    <a href='?page=admin_classes&action=update&id=$class[id]'>";
							echo "      <span class='glyphicon glyphicon-edit' title='Επεξεργασία τμήματος'></span>";
							echo "    </a>";
							echo "    <a href='?page=admin_classes&action=delete&id=$class[id]'>";
							echo "      <span class='glyphicon glyphicon-trash' title='Διαγραφή τμήματος'></span>";
							echo "    </a>";
							echo "  </td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
