<?php include_once('index.php'); ?>
<div class="page register-page">

	<div class="banner">
		<img src="resources/images/img01.jpg" alt="" />
		<div class="container">
			<h1>Εγγραφή Χρήστη</h1>
		</div>
	</div>

	<div class="container main-container">
		<div class="row">
			<div class="col-md-4">
				<h2>Γίνε Μέλος</h2>
				<p>Απόλαυσε τα μοναδικά πλεονεκτήματα που σου προσφέρει η εγγραφή μέλους στο γυμναστήριό μας.</p>
			</div>
			<div class="col-md-8">
				<form method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->fname_validation);?>">
								<label class="sr-only" for="fname">Όνομα</label>
								<input type="text" class="form-control" id="fname" name="fname" value="<?=$this->fname?>" placeholder="Όνομα">
								<?=field_message($this->fname_validation);?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->lname_validation);?>">
								<label class="sr-only" for="lname">Επώνυμο</label>
								<input type="text" class="form-control" id="lname" name="lname" value="<?=$this->lname?>" placeholder="Επώνυμο">
								<?=field_message($this->lname_validation);?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->email_validation);?>">
								<label class="sr-only" for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email" value="<?=$this->email?>" placeholder="Email">
								<?=field_message($this->email_validation);?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->password_validation);?>">
								<label class="sr-only" for="password_1">Κωδικός</label>
								<input type="password" class="form-control" id="password_1" name="password_1" value="<?=$this->password1?>" placeholder="Κωδικός">
								<?=field_message($this->password_validation);?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->password_validation);?>">
								<label class="sr-only" for="password_2">Επιβεβαίωση κωδικού</label>
								<input type="password" class="form-control" id="password_2" name="password_2" value="<?=$this->password2?>" placeholder="Επιβεβαίωση κωδικού">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">Υποβολή</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
