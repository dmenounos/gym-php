<?php

include_once('base.php');

/**
 * Ελεκτής αποσύνδεσης χρήστη.
 */
class LogoutController extends BaseController {

	function execute() {
		if (empty($_SESSION['user_id']) && empty($_SESSION['admin_id'])) {
			throw new Exception("Δεν υπάρχει χρήστης");
		}

		session_destroy();

		// redirect to outcome page
		$this->redirect_view("home");
	}
}

// Αρχικοποίηση και εκτέλεση ελεκτή σελίδας
$controller = new LogoutController();
$controller->execute();

?>
