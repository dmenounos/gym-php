<?php

/**
 * Αφαιρετική κλάση ελεκτή.
 */
class BaseController {

	/* Η σελίδα που θα ενσωματωθεί στο template. */
	protected $render_view = NULL;

	/**
	 * Θέτει τη σελίδα που θα ενσωματωθεί στο template και 
	 * μεταφέρει την κλήση στο template που θα αποδωθεί.
	 */
	protected function template_view($view) {
		$this->validate_view($view);
		$this->render_view = $view;
		include "views/template.php";
		exit();
	}

	/**
	 * Μεταφέρει τον browser σε άλλη σελίδα.
	 */
	protected function redirect_view($view, $statusCode = 302) {
		$this->validate_view($view);
		header('Location: ./?page=' . $view, true, $statusCode);
		exit();
	}

	/**
	 * Έλεγχος εγκυρότητας σελίδας.
	 */
	protected function validate_view($view) {
		if (!is_valid_page($view)) {
			throw new Exception("Εσωτερικό σφάλμα");
		}
	}
}

?>
