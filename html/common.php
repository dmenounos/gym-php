<?php

ini_set('display_errors', 1); 
error_reporting(E_ALL);

session_start();

/**
 * Επιστρέφει τις επιτρεπτές σελίδες.
 */
function is_valid_page($page) {
	$pages = array('home', 'admin_programs', 'admin_classes', 'login', 'logout', 'register', 'member');
	return !empty($page) && in_array($page, $pages);
}

// Προσαρμόζει τα δεδομένα που έρχονται από το χρήστη.
function input_data($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Bootstrap form field helper.
function field_status($field_validation) {
	if (isset($field_validation)) {
		if (!empty($field_validation)) {
			return "has-error";
		} else {
			return "has-success";
		}
	}
	return "";
}

// Bootstrap form field helper.
function field_message($field_validation) {
	if (isset($field_validation)) {
		if (!empty($field_validation)) {
			return "<span class='help-block'>" . $field_validation . "</span>";
		}
	}
	return "";
}

// Bootstrap alert message helper.
function alert_message($message, $type = "info") {
	if (isset($message)) {
		if (!empty($message)) {
			return "<div class='alert alert-" . $type . "' role='alert'>" . $message . "</div>";
		}
	}
	return "";
}

?>
