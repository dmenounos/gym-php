<?php include_once('index.php'); ?>
<div class="page login-page">

	<div class="banner">
		<img src="resources/images/img03.jpg" alt="" />
		<div class="container">
			<h1>Σύνδεση Χρήστη</h1>
		</div>
	</div>

	<div class="container main-container">
		<div class="row">
			<div class="col-md-4">
				<h2>Είναι εύκολο!</h2>
				<p>Βάλε τα στοιχεία σου και γράψου στα μοναδικά προγράμματα του γυμναστηρίου μας.</p>
			</div>
			<div class="col-md-8">
				<form method="post">
					<?=alert_message($this->error_message, "danger");?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->email_validation);?>">
								<label class="sr-only" for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email" value="<?=$this->email?>" placeholder="Email">
								<?=field_message($this->email_validation);?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group <?=field_status($this->password_validation);?>">
								<label class="sr-only" for="password">Κωδικός</label>
								<input type="password" class="form-control" id="password" name="password" value="<?=$this->password?>" placeholder="Κωδικός">
								<?=field_message($this->password_validation);?>
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
