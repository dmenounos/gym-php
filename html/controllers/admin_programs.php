<?php

include_once('base.php');

/**
 * Ελεκτής σελίδας διαχείρισης προγραμμάτων.
 */
class ProgramsAdminController extends BaseController {

	public $id;
	public $name;
	public $description;
	public $cost;
	public $programs;

	public $name_validation;
	public $description_validation;
	public $cost_validation;
	public $minage_validation;
	public $maxage_validation;

	public function execute() {
		if (empty($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
			throw new Exception("Δεν υπάρχει χρήστης");
		}

		if (isset($_REQUEST['action'])) {
			if ($_REQUEST['action'] == "delete") {
				$this->delete_program();
			}
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			$this->init_programs();
		}
		elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->update_program();
		}

		// render page template
		$this->template_view("admin_programs");
	}

	/**
	 * Χειρίζεται την ροή εμφάνισης των προγραμμάτων.
	 */
	private function init_programs() {
		$this->programs = $this->find_all_programs();
		$this->validation_outcome = true;

		if (isset($_REQUEST['id'])) {
			$row = $this->find_program_by_id($_REQUEST['id']);

			$this->id          = $row["id"];
			$this->name        = $row["name"];
			$this->description = $row["description"];
			$this->cost        = $row["cost"];
		}
	}

	/**
	 * Χειρίζεται την ροή ενημέρωσης ενός προγράμματος.
	 */
	private function update_program() {
		$this->programs = $this->find_all_programs();

		$this->id          = input_data($_REQUEST['id']);
		$this->name        = input_data($_REQUEST['name']);
		$this->description = input_data($_REQUEST['description']);
		$this->cost        = input_data($_REQUEST['cost']);

		$this->name_validation        = "";
		$this->description_validation = "";
		$this->cost_validation        = "";
		$this->validation_outcome     = true;

		if (empty($this->name)) {
			$this->name_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->description)) {
			$this->description_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->cost)) {
			$this->cost_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (!$this->validation_outcome) {
			return; // back to temlate
		}

		// Ενημέρωση στοιχείων προγράμματος
		$this->update_program_data($this->id, $this->name, $this->description, $this->cost);

		// redirect to outcome page
		$this->redirect_view("admin_programs");
	}

	/**
	 * Χειρίζεται την ροή διαγραφής ενός προγράμματος.
	 */
	private function delete_program() {
		if (!isset($_REQUEST['id'])) {
			throw new Exception("Δεν δώθηκε πρόγραμμα");
		}

		// Διαγραφή στοιχείων προγράμματος
		$this->delete_program_data($_REQUEST['id']);

		// redirect to outcome page
		$this->redirect_view("admin_programs");
	}

	// DATA ACCESS FUNCTIONS

	/**
	 * Φορτώνει τα στοιχεία όλων των προγραμμάτων από τη βάση δεδομένων.
	 */
	private function find_all_programs() {
		DB::open_connection();
		$sql = "SELECT id, name, description, cost FROM gym_program";
		$result = mysqli_query(DB::$conn, $sql);
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($rows, $row);
			}
		}
		DB::close_connection();
		return $rows;
	}

	/**
	 * Φορτώνει τα στοιχεία ενός προγράμματος από τη βάση δεδομένων.
	 */
	private function find_program_by_id($id) {
		DB::open_connection();
		$sql = "SELECT id, name, description, cost FROM gym_program WHERE id = $id";
		$result = mysqli_query(DB::$conn, $sql);
		$row = NULL;
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
		}
		DB::close_connection();
		return $row;
	}

	/**
	 * Αποθηκεύει τα στοιχεία ενός προγράμματος στη βάση δεδομένων.
	 */
	private function update_program_data($id, $name, $description, $cost) {
		DB::open_connection();
		if (empty($id)) {
			$sql = "INSERT INTO gym_program (name, description, cost) VALUES ('$name', '$description', $cost)";
		} else {
			$sql = "UPDATE gym_program SET name = '$name', description = '$description', cost = $cost WHERE id = $id";
		}
		//echo $sql;
		mysqli_query(DB::$conn, $sql);
		DB::close_connection();
		//exit();
	}

	/**
	 * Διαγράφει τα στοιχεία ενός προγράμματος στη βάση δεδομένων.
	 */
	private function delete_program_data($id) {
		DB::open_connection();
		$sql = "DELETE FROM gym_program WHERE id = $id";
		mysqli_query(DB::$conn, $sql);
		DB::close_connection();
	}
}

// Αρχικοποίηση και εκτέλεση ελεκτή σελίδας
$controller = new ProgramsAdminController();
$controller->execute();

?>
