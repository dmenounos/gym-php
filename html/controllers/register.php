<?php

include_once('base.php');

/**
 * Ελεκτής σελίδας εγγραφής χρήστη.
 */
class RegisterController extends BaseController {

	public $fname;
	public $lname;
	public $email;
	public $password1;
	public $password2;

	public $fname_validation;
	public $lname_validation;
	public $email_validation;
	public $password_validation;

	function execute() {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->register_user();
		}

		// render page template
		$this->template_view("register");
	}

	/**
	 * Χειρίζεται την ροή υποβολής της φόρμας.
	 */
	private function register_user() {
		$this->fname     = input_data($_REQUEST['fname']);
		$this->lname     = input_data($_REQUEST['lname']);
		$this->email     = input_data($_REQUEST['email']);
		$this->password1 = input_data($_REQUEST['password_1']);
		$this->password2 = input_data($_REQUEST['password_2']);

		$this->fname_validation    = "";
		$this->lname_validation    = "";
		$this->email_validation    = "";
		$this->password_validation = "";
		$this->validation_outcome  = true;

		if (empty($this->fname)) {
			$this->fname_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->lname)) {
			$this->lname_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->email)) {
			$this->email_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->password1) || empty($this->password2)) {
			$this->password_validation = "Τα πεδία είναι υποχρεωτικά";
			$this->validation_outcome = false;
		} elseif ($this->password1 != $this->password2) {
			$this->password_validation = "Ο κωδικός πρέπει να είναι ίδιος";
			$this->validation_outcome = false;
		}

		if (!$this->validation_outcome) {
			return; // back to temlate
		}

		// Δημιουργία λογαριασμού χρήστη
		$user_id = $this->save_user_data($this->fname, $this->lname, $this->email, $this->password1);

		$_SESSION['user_id'] = $user_id;

		// redirect to outcome page
		$this->redirect_view("member");
	}

	// DATA ACCESS FUNCTIONS

	/**
	 * Αποθηκεύει τα στοιχεία του χρήστη στη βάση δεδομένων.
	 */
	private function save_user_data($fname, $lname, $email, $password1) {
		DB::open_connection();
		$sql = "INSERT INTO gym_user (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password1')";
		mysqli_query(DB::$conn, $sql);
		$user_id = mysqli_insert_id(DB::$conn);
		DB::close_connection();
		return $user_id;
	}
}

// Αρχικοποίηση και εκτέλεση ελεκτή σελίδας
$controller = new RegisterController();
$controller->execute();

?>
