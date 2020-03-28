<?php include_once('index.php'); ?>
<div class="page member-page">

	<div class="container main-container">
		<div class="row">
			<div class="col-md-4">
			<?php if (!empty($this->sex)) { ?>
				<img src='resources/images/user_<?=strtolower($this->sex)?>.png' alt='' class="user-icon" />
			<?php } ?>
			</div>
			<div class="col-md-8">
				<form method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->fname_validation);?>">
								<label for="fname">Όνομα</label>
								<input type="text" class="form-control" name="fname" value="<?=$this->fname?>" placeholder="Όνομα">
								<?=field_message($this->fname_validation);?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->lname_validation);?>">
								<label for="lname">Επώνυμο</label>
								<input type="text" class="form-control" name="lname" value="<?=$this->lname?>" placeholder="Επώνυμο">
								<?=field_message($this->lname_validation);?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->email_validation);?>">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" value="<?=$this->email?>" placeholder="Email">
								<?=field_message($this->email_validation);?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="fname">Ηλικία</label>
								<input type="text" class="form-control" name="age" value="<?=$this->age?>" placeholder="Ηλικία">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="radio">
								<label>
									<input type="radio" name="sex" value="<?=MALE?>" <?= $this->sex == MALE ? "checked" : "" ?>>
									Άνδρας
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="sex" value="<?=FEMALE?>" <?= $this->sex == FEMALE ? "checked" : "" ?>>
									Γυναίκα
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-left">
							<button type="submit" class="btn btn-primary">Ενημέρωση Στοιχείων</button>
						</div>
						<div class="col-md-6 text-right">
							<a class="btn btn-danger" id="delete-account" href="?page=member&action=delete">Διαγραφή Λογαρισμού</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>

<script>
$(function() {
	$('#delete-account').on('click', function () {
		if (!confirm("Επιβεβαίωση διαγραφής λογαριασμού;")) {
			return false;
		}
	});
});
</script>
