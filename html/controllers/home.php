<?php

include_once('base.php');

/**
 * Ελεκτής αρχικής σελίδας.
 */
class HomeController extends BaseController {

	function execute() {
		// render page template
		$this->template_view("home");
	}
}

// Αρχικοποίηση και εκτέλεση ελεκτή σελίδας
$controller = new HomeController();
$controller->execute();

?>
