<?php include_once('index.php'); ?>
<!DOCTYPE html>
<html lang="el">
	<head>
		<title>Γυμναστήριο PHP</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
		<link href="resources/css/style.css" type="text/css" rel="stylesheet" />
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- Σύνδεσμοι Πλοήγησης -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#navbar"
						aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="./" class="navbar-brand">
						<img src="resources/images/logo.png" alt="Logo" />
						<span>ΓΕ3</span>
					</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li <?=$this->render_view=="home"?"class='active'":""?>>
							<a href="./">Αρχική</a>
						</li>

						<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') { ?>
							<li <?=$this->render_view=="admin_programs"?"class='active'":""?>>
								<a href="?page=admin_programs">Διαχείριση Προγραμμάτων</a>
							</li>
							<li <?=$this->render_view=="admin_classes"?"class='active'":""?>>
								<a href="?page=admin_classes">Διαχείριση Τμημάτων</a>
							</li>
							<li>
								<a href="?page=logout">Αποσύνδεση Διαχειριστή</a>
							</li>
						<?php } elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user') { ?>
							<li <?=$this->render_view=="member"?"class='active'":""?>>
								<a href="?page=member">Προφίλ Χρήστη</a>
							</li>
							<li>
								<a href="?page=logout">Αποσύνδεση Χρήστη</a>
							</li>
						<?php } else { ?>
							<li <?=$this->render_view=="login"?"class='active'":""?>>
								<a href="?page=login">Σύνδεση Χρήστη</a>
							</li>
							<li <?=$this->render_view=="register"?"class='active'":""?>>
								<a href="?page=register">Εγγραφή Χρήστη</a>
							</li>
						<?php } ?>	

					</ul>
				</div>
			</div>
		</nav>

		<?php
		// Ενσωματώνουμε το επιμέρους περιεχόμενο.
		include $this->render_view  . ".php";
		?>

		<!-- Υποσέλιδο -->
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<p class="address">Phone : <span class="m_10">210 1234567</span></p>
						<p class="address">Email : <span class="m_10">info@mycompany.com</span></p>
					</div>
					<div class="col-md-4 text-right">
						<a href="https://validator.w3.org/" target="_blank" title="Valid HTML">
							<img src="resources/images/HTML5.png" alt="" />
						</a>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>
