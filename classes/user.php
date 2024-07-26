<?php
/**
 * User Class.
 *
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Twilio\Rest\Client;

class UserManager extends \stdClass
{

	protected $db;
	protected $debug;
	protected $table;
	function __construct(&$db)
	{
		$this->db = &$db;
		$this->debug = false;
		$this->table = 'teachers';
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}



	function Login($data)
	{
		$data = json_decode(file_get_contents('php://input'), true);
		if (!empty($data['username']) && !empty($data['password'])) {



			$username = $this->db->escape($data['username']);
			$password = $data['password'];
			//echo password_hash($password,PASSWORD_DEFAULT);die;
			$sql = "SELECT * FROM " . $this->table . " WHERE username='$username' LIMIT 1";
			$result = $this->db->query($sql);
			if ($row = $this->db->fetch($result)) {

				if (password_verify($password, $row['password'])) {
					if ($row['status'] == 1 && $row['isDeleted'] == 0) {
						$_SESSION['uid'] = (int) $row['id'];
						$_SESSION['teacher'] = $row;
						return array('status' => true, 'data' => $_SESSION, 'message' => 'Login successfully.');
					}
					return array('status' => false, 'message' => 'Login failed. Account does not exists.');
				}
				return array('status' => false, 'message' => 'Login failed. The password may be wrong.');
			}
			return array('status' => false, 'message' => 'Login failed.  Please check your username and password.');
		}
		return array('status' => false, 'message' => 'Please enter valid username or password.');
	}

	function fetch()
	{
		$data = array();
		$sql = "SELECT * FROM student where status=1";
		$result = $this->db->query($sql);
		if ($result) {
			while ($row = $this->db->fetch($result)) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function add($data)
	{
		$data = json_decode(file_get_contents('php://input'), true);
		global $db;
		$name = $data['name'];
		$subject = $data['subject'];
		$sql = "SELECT * FROM student WHERE name='$name' AND  subject='$subject' LIMIT 1";
		$result = $this->db->query($sql);
		if (!$this->db->fetch($result)) {
			$insertArr = array(
				'teacher_id' => $_SESSION['uid'],
				'name' => $data['name'],
				'subject' => $data['subject'],
				'marks' => $data['marks'],
			);
			$result = $this->db->create('student', $insertArr);
			if ($result) {
				return array('status' => true, 'id' => $result, 'message' => 'Student added successfully. ');
			} else {
				return array('status' => false, 'message' => 'Student not added.');
			}
		} else {

			$Arr = array(
				'marks' => $data['marks']
			);
			$where = " name='$name' AND  subject='$subject'";
			$result = $this->db->update('student', $Arr, $where);
			return array('status' => true, 'id' => $result, 'message' => 'Marks updated successfully. ');
		}
	}
	function deletestu($data)
	{
		$data = json_decode(file_get_contents('php://input'), true);
		global $db;
		$id = $data['id'];
		$Arr = array(
			'status' => 0
		);
		$where = " id='$id'";
		$result = $this->db->update('student', $Arr, $where);
		if ($result) {
			return array('status' => true, 'uid' => $result, 'message' => 'Student deleted successfully. ');
		} else {
			return array('status' => true, 'uid' => $result, 'message' => 'Student not deleted .');
		}
	}
	function editstu($data)
	{
		$data = json_decode(file_get_contents('php://input'), true);
	//	print_r($data);die();
		global $db;
		$id = $data['id'];
		$column = $data['column'];
		$value = $data['value'];
		$Arr = array(
			$column => $value
		);

		//print_r($Arr);die();
		$where = " id='$id'";
		$result = $this->db->update('student', $Arr, $where);
		if ($result) {
			return array('status' => true, 'message' => 'Updated successfully. ');
		} else {
			return array('status' => false, 'message' => 'Not updated.');
		}

	}

	



}