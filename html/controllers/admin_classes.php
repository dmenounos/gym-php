<?php

include_once('base.php');

/**
 * Ελεκτής σελίδας διαχείρισης τμημάτων.
 */
class ClassesAdminController extends BaseController {

	public $id;
	public $name;
	public $day;
	public $start;
	public $end;
	public $program_id;
	public $classes;
	public $programs;

	public $name_validation;
	public $day_validation;
	public $start_validation;
	public $end_validation;
	public $program_id_validation;

	public function execute() {
		if (empty($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
			throw new Exception("Δεν υπάρχει χρήστης");
		}

		if (isset($_REQUEST['action'])) {
			if ($_REQUEST['action'] == "delete") {
				$this->delete_class();
			}
		}

		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			$this->init_classes();
		}
		elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->update_class();
		}

		// render page template
		$this->template_view("admin_classes");
	}

	/**
	 * Χειρίζεται την ροή εμφάνισης των τμημάτων.
	 */
	private function init_classes() {
		$this->classes  = $this->find_all_classes();
		$this->programs = $this->find_all_programs();
		$this->validation_outcome = true;

		if (isset($_REQUEST['id'])) {
			$row = $this->find_class_by_id($_REQUEST['id']);

			$this->id         = $row["id"];
			$this->name       = $row["name"];
			$this->day        = $row["day"];
			$this->start      = $row["start"];
			$this->end        = $row["end"];
			$this->program_id = $row["program_id"];
		}
	}

	/**
	 * Χειρίζεται την ροή ενημέρωσης ενός τμήματος.
	 */
	private function update_class() {
		$this->classes  = $this->find_all_classes();
		$this->programs = $this->find_all_programs();

		$this->id         = input_data($_REQUEST['id']);
		$this->name       = input_data($_REQUEST['name']);
		$this->day        = input_data($_REQUEST['day']);
		$this->start      = input_data($_REQUEST['start']);
		$this->end        = input_data($_REQUEST['end']);
		$this->program_id = input_data($_REQUEST['program_id']);

		$this->name_validation       = "";
		$this->day_validation        = "";
		$this->start_validation      = "";
		$this->end_validation        = "";
		$this->program_id_validation = "";
		$this->validation_outcome    = true;

		if (empty($this->name)) {
			$this->name_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->day)) {
			$this->day_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->start)) {
			$this->start_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->end)) {
			$this->end_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (empty($this->program_id)) {
			$this->program_id_validation = "Το πεδίο είναι υποχρεωτικό";
			$this->validation_outcome = false;
		}

		if (!$this->validation_outcome) {
			return; // back to temlate
		}

		// Ενημέρωση στοιχείων τμήματος
		$this->update_class_data($this->id, $this->name, $this->day, $this->start, $this->end, $this->program_id);

		// redirect to outcome page
		$this->redirect_view("admin_classes");
	}

	/**
	 * Χειρίζεται την ροή διαγραφής ενός τμήματος.
	 */
	private function delete_class() {
		if (!isset($_REQUEST['id'])) {
			throw new Exception("Δεν δώθηκε τμήμα");
		}

		// Διαγραφή στοιχείων τμήματος
		$this->delete_class_data($_REQUEST['id']);

		// redirect to outcome page
		$this->redirect_view("admin_classes");
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
	 * Φορτώνει τα στοιχεία όλων των τμημάτων από τη βάση δεδομένων.
	 */
	private function find_all_classes() {
		DB::open_connection();
		$sql = "SELECT id, name, day, start, end, program_id FROM gym_class";
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
	 * Φορτώνει τα στοιχεία ενός τμήματος από τη βάση δεδομένων.
	 */
	private function find_class_by_id($id) {
		DB::open_connection();
		$sql = "SELECT id, name, day, start, end, program_id FROM gym_class WHERE id = $id";
		$result = mysqli_query(DB::$conn, $sql);
		$row = NULL;
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
		}
		DB::close_connection();
		return $row;
	}

	/**
	 * Αποθηκεύει τα στοιχεία ενός τμήματος στη βάση δεδομένων.
	 */
	private function update_class_data($id, $name, $day, $start, $end, $program_id) {
		DB::open_connection();
		if (empty($id)) {
			$sql = "INSERT INTO gym_class (name, day, start, end, program_id) VALUES ('$name', '$day', '$start', '$end', $program_id)";
		} else {
			$sql = "UPDATE gym_class SET name = '$name', day = '$day', start = '$start', end = '$end', program_id = $program_id WHERE id = $id";
		}
		//echo $sql;
		mysqli_query(DB::$conn, $sql);
		DB::close_connection();
		//exit();
	}

	/**
	 * Διαγράφει τα στοιχεία ενός τμήματος στη βάση δεδομένων.
	 */
	private function delete_class_data($id) {
		DB::open_connection();
		$sql = "DELETE FROM gym_class WHERE id = $id";
		mysqli_query(DB::$conn, $sql);
		DB::close_connection();
	}
}

// Αρχικοποίηση και εκτέλεση ελεκτή σελίδας
$controller = new ClassesAdminController();
$controller->execute();

?>
