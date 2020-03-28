<?php

define("DB_HOSTNAME", "gym-php-db");
define("DB_USERNAME", "gym_db");
define("DB_PASSWORD", "gym_db");
define("DB_NAME",     "gym_db");

class DB {

	public static $conn = NULL;

	//
	// Ανοίγει σύνδεση στη βάση δεδομένων.
	//
	public static function open_connection() {
		self::$conn = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if (mysqli_connect_error()) {
			die("Αποτυχία σύνδεσης στη βάση δεδομένων: " . self::$conn->connect_error);
		}
	}

	//
	// Κλέινει σύνδεση στη βάση δεδομένων.
	//
	public static function close_connection() {
		if (self::$conn) {
			mysqli_close(self::$conn);
		}
	}
}

?>
