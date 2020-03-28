<?php

include_once('base.php');

/**
 * Ελεκτής σελίδας προφίλ χρήστη.
 */
class MemberController extends BaseController {

	public $fname;
	public $lname;
	public $email;
	public $age;
	public $sex;

	public $fname_validation;
	public $lname_validation;
	public $email_validation;

	public function execute() {
		if (empty($_SESSION['user_id'])) {
			throw new Exception("Δεν υπάρχει χρήστης");
		}

		define ("MALE",   "MALE");
		define ("FEMALE", "FEMALE");

		if (isset($_REQUEST['action'])) {
			if ($_REQUEST['action'] == "delete") {
				$this->delete_user();
			}
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			$this->init_user();
		}
		elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->update_user();
		}

		// render page template
		$this->template_view("member");
	}

	/**
	 * Χειρίζεται την ροή αρχικοποίησης των στοιχείων του χρήστη.
	 */
	private function init_user() {
		$row = $this->find_user_by_id($_SESSION['user_id']);

		$this->fname = $row["fname"];
		$this->lname = $row["lname"];
		$this->email = $row["email"];
		$this->age   = $row["age"];
		$this->sex   = $row["sex"];
	}

	/**
	 * Χειρίζεται την ροή ενημέρωσης των στοιχείων του χρήστη.
	 */
	private function update_user() {
		$this->fname = input_data($_REQUEST['fname']);
		$this->lname = input_data($_REQUEST['lname']);
		$this->email = input_data($_REQUEST['email']);
		$this->age   = input_data($_REQUEST['age']);
		$this->sex   = input_data($_REQUEST['sex']);

		$this->fname_validation   = "";
		$this->lname_validation   = "";
		$this->email_validation   = "";
		$this->validation_outcome = true;

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

		if (!$this->validation_outcome) {
			return; // back to temlate
		}

		// Ενημέρωση υποβληθέντων στοιχείων χρήστη
		$this->update_user_data($_SESSION['user_id'], $this->email, $this->fname, $this->lname, $this->age, $this->sex);

		// redirect to outcome page
		$this->redirect_view("member");
	}

	/**
	 * Χειρίζεται την ροή διαγραφής λογαριασμού του χρήστη.
	 */
	private function delete_user() {
		// Διαγραφή λογαριασμού χρήστη
		$this->delete_user_data($_SESSION['user_id']);

		// redirect to outcome page
		$this->redirect_view("logout");
	}

	// DATA ACCESS FUNCTIONS

	/**
	 * Φορτώνει τα στοιχεία του χρήστη από τη βάση δεδομένων.
	 */
	private function find_user_by_id($user_id) {
		DB::open_connection();
		$sql = "SELECT id, role, fname, lname, email, age, sex FROM gym_user WHERE id = $user_id";
		$result = mysqli_query(DB::$conn, $sql);
		$row = NULL;
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
		}
		DB::close_connection();
		return $row;
	}

	/**
	 * Αποθηκεύει τα στοιχεία του χρήστη στη βάση δεδομένων.
	 */
	private function update_user_data($user_id, $email, $fname, $lname, $age, $sex) {
		DB::open_connection();
		$sql = "UPDATE gym_user SET email = '$email', fname = '$fname', lname = '$lname', age = '$age', sex = '$sex' WHERE id = $user_id";
		mysqli_query(DB::$conn, $sql);
		DB::close_connection();
	}

	/**
	 * Διαγράφει τα στοιχεία του χρήστη στη βάση δεδομένων.
	 */
	private function delete_user_data($user_id) {
		DB::open_connection();
		$sql = "DELETE FROM gym_user WHERE id = $user_id";
		mysqli_query(DB::$conn, $sql);
		DB::close_connection();
	}
}

// Αρχικοποίηση και εκτέλεση ελεκτή σελίδας
$controller = new MemberController();
$controller->execute();

?>
