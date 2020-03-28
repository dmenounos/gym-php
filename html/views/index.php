<?php

// Αυτός ο κατάλογος είναι προστατευμένος.

if (!isset($this) || !isset($this->render_view)) {
	http_response_code(403);
	exit;
}

?>
