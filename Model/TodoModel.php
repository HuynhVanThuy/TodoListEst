<?php

namespace Model;

require_once("TodoEntity.php");

/**
 * Model connect Todo data
 */
class TodoModel
{
	
	public function __construct()
	{
		
	}

	public function view($date){
		$conn = $this->connectDB();
		$sql = "SELECT * FROM todo WHERE create_date = '".$date."'";
		$result = $conn->query($sql);
		$dataTodo = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$todo = new \Entity\TodoEntity($row['id'], $row['task_name'], $row['start_date'], $row['end_date'], $row['status'], $row['create_date']);
				array_push($dataTodo, $todo);
			}
		} 
		$conn->close();
		return $dataTodo;
	}

	public function add($todo)
	{
		$conn = $this->connectDB();
		$stmt = $conn->prepare("INSERT INTO todo (task_name, start_date, end_date, status, create_date) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param('sssss', $todo->taskName, $todo->startDate, $todo->endDate, $todo->status, $todo->createDate);
		$check = $stmt->execute();
		$stmt->close();
		$conn->close();
		return $check;
	}

	public function edit($todo)
	{
		$conn = $this->connectDB();
		$sql = "UPDATE todo SET task_name = '".$todo->taskName."', start_date = '".$todo->startDate."', end_date = '".$todo->endDate."', status = '".$todo->status."', create_date = '".$todo->createDate."' WHERE id = ".$todo->id;
    	$check = $conn->query($sql);
		$conn->close();
		return $check;
	}

	public function delete($id){
		$conn = $this->connectDB();
		$sql = "DELETE FROM todo WHERE id = ".$id;
		$check = $conn->query($sql);
		$conn->close();
		return $check;
	}

	private function connectDB(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "todoest";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			echo ("Connection failed: " . $this->conn->connect_error);
		}
		return $conn;
	}

}

?>