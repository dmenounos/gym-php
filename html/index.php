<?php

include_once 'common.php';
include_once 'database.php';

// Μια απλή υλοποίηση MVC

try {
	// 1. Βρίσκουμε τη σελίδα που ζητείται
	$page = 'home';

	if (isset($_REQUEST['page'])) {
		$page = $_REQUEST['page'];
	}

	// 2. Ελέγχουμε την εγκυρότητα της σελίδας
	if (!is_valid_page($page)) {
		throw new Exception('Δεν βρέθηκε η σειλίδα ' . $page);
	}

	// 3. Αναθέτουμε την κλήση στον ανάλογο controller
	include_once './controllers/' . $page . '.php';
}
catch (Exception $e) {
	http_response_code(400);
	echo $e->getMessage();
	exit;
}

?>
