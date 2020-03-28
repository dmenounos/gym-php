<?php

include_once('base.php');

/**
 * Ελεκτής σύνδεσης χρήστη.
 */
class LoginUserController extends BaseController {

	public $email;
	public $password;

	public $email_validation;
	public $password_validation;

	public $error_message;

	public function execute() {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->login_user();
		}

		// render page template
		$this->template_view("login");
	}

	/**
	 * Χειρίζεται την ροή υποβολής της φόρμας.
	 */
	private function login_user() {
		$this->email    = input_data($_REQUEST['email']);
		$this->password = input_data($_REQUEST['password']);

		$this->email_validation    = "";
		$this->password_validation = "";
		$this->validation_outcome  = true;

		if (empty($this->email)) {
			$this->email_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->password)) {
			$this->password_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (!$this->validation_outcome) {
			return; // back to temlate
		}

		// Επαλήθευση υποβληθέντων στοιχείων χρήστη
		$row = $this->find_user_id_by_email_and_password($this->email, $this->password);

		if (is_null($row)) {
			$this->error_message = "Τα στοιχεία που δώσατε δεν είναι σωστά.";
			return; // back to temlate
		}

		$_SESSION['user_id']   = $row["id"];
		$_SESSION['user_role'] = $row["role"];

		// redirect to outcome page
		$this->redirect_view("home");
	}

	// DATA ACCESS FUNCTIONS

	/**
	 * Ελέγχει τα διαπιστευτήρια του χρήστη στη βάση δεδομένων.
	 */
	private function find_user_id_by_email_and_password($email, $password) {
		DB::open_connection();
		$sql = "SELECT id, role FROM gym_user WHERE email = '$email' AND password = '$password'";
		$result = mysqli_query(DB::$conn, $sql);
		$row = NULL;
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
		}
		DB::close_connection();
		return $row;
	}
}

// Αρχικοποίηση και εκτέλεση ελεκτή σελίδας
$controller = new LoginUserController();
$controller->execute();

?>
