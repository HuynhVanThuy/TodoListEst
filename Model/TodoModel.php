<?php

namespace Model;

require_once("TodoEntity.php");

/**
 * Model connect Todo data
 */
class TodoModel
{

	public $conn;
	
	public function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "todoest";

		$this->conn = mysqli_connect($servername, $username, $password, $dbname);

		if ($this->conn->connect_error) {
			echo ("Connection failed: " . $this->conn->connect_error);
		}
	}

	public function view($date){
		$sql = "SELECT * FROM todo WHERE create_date = '".$date."'";
		$result = $this->conn->query($sql);
		$dataTodo = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$todo = new \Entity\TodoEntity($row['id'], $row['task_name'], $row['start_date'], $row['end_date'], $row['status'], $row['create_date']);
				array_push($dataTodo, $todo);
			}
		} 
		return $dataTodo;
	}

	public function add($todo){
		$stmt = $this->conn->prepare("INSERT INTO todo (task_name, start_date, end_date, status, create_date) VALUES (?, ?, ?, ?, ?)");

		$stmt->bind_param('sssss', $todo->taskName, $todo->startDate, $todo->endDate, $todo->status, $todo->createDate);

		$stmt->execute();

		$stmt->close();
		$this->conn->close();

	}

	public function edit(){
		// $sql = "UPDATE todo SET task_name=".$todo->taskName." ,".$todo->startDate." ,".$todo->endDate." ,".$todo->status.", ".$todo->createDate."WHERE id=$id";
		$todo = new \stdClass();
		$todo->id = 1;
		$todo->taskName = "thuy";
		$todo->startDate = "2020-11-02";
		$todo->endDate = "2020-11-02";
		$todo->status = "okok";
		$todo->createDate = "2020-11-02";
		$sql = "UPDATE todo SET task_name=".$todo->taskName." ,".$todo->startDate." ,".$todo->endDate." ,".$todo->status.", ".$todo->createDate."WHERE id = ".$todo->id;
		echo $sql;
  //   	if ($this->conn->query($sql) === TRUE) {
		// 	echo "Record updated successfully";
		// } else {
		// 	echo "Error updating record: " . $conn->error;
		// }
	}
}

?>