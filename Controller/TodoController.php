<?php 

namespace Controller;

require_once("../Model/TodoModel.php");

/**
 * Controller todo logic
 */
class TodoController
{
	public $model;	

	public function __construct()  
	{  
	    $this->model = new \Model\TodoModel();
	} 

	public function index()
    {
    	if($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_REQUEST['date'])){
			$date = $_REQUEST['date'];
			return $this->model->view($date);;
    	}
    }
}

?>
