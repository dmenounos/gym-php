<?php include_once('index.php'); ?>
<div class="page programs-admin-page">

	<div id="form-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-title">Πρόγραμμα</h4>
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
								<div class="form-group <?=field_status($this->description_validation);?>">
									<label for="description">Περιγραφή</label>
									<textarea class="form-control" rows="3" name="description" placeholder="Περιγραφή"><?=$this->description?></textarea>
									<?=field_message($this->description_validation);?>
								</div>
								<div class="form-group <?=field_status($this->cost_validation);?>">
									<label for="cost">Κόστος</label>
									<input type="text" class="form-control" name="cost" value="<?=$this->cost?>" placeholder="Κόστος" />
									<?=field_message($this->cost_validation);?>
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
				<h3 class="pull-left">Προγράμματα</h3>
				<a class="btn btn-primary pull-right" href='?page=admin_programs&action=create'>
					Εισαγωγή Προγράμματος
				</a>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td>ID</td>
							<td>Όνομα</td>
							<td>Περιγραφή</td>
							<td>Κόστος</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < count($this->programs); $i++) {
							$program = $this->programs[$i];
							echo "<tr>";
							echo "<td>$program[id]</td>";
							echo "<td>$program[name]</td>";
							echo "<td>$program[description]</td>";
							echo "<td>$program[cost]</td>";
							echo "<td>";
							echo "  <a href='?page=admin_programs&action=update&id=$program[id]'>";
							echo "    <span class='glyphicon glyphicon-edit' title='Επεξεργασία προγράμματος'></span>";
							echo "  </a>";
							echo "  <a href='?page=admin_programs&action=delete&id=$program[id]'>";
							echo "    <span class='glyphicon glyphicon-trash' title='Διαγραφή προγράμματος'></span>";
							echo "  </a>";
							echo "</td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
