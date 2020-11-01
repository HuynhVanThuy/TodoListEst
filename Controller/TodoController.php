<?php 

namespace Controller;

require_once("../Model/TodoModel.php");
require_once("../Model/TodoEntity.php");

/**
 * Controller todo logic
 */
class TodoController
{
	public $model;	
	public $date;
	public $msOK;
	public $msERR;

	public function __construct()  
	{  
	    $this->model = new \Model\TodoModel();
	    $this->date = "";
	    $this->msOK = "";
	    $this->msERR = "";
	} 

	public function index($date)
    {
    	$this->date = $date;
		return $this->model->view($this->date);	
    }

    public function add()
    {
    	$this->date = $_REQUEST['createDate'];

    	$todo = new \Entity\TodoEntity(null, $_REQUEST['taskName'], $_REQUEST['startDate'], $_REQUEST['endDate'], $_REQUEST['status'], $_REQUEST['createDate']);

    	if($this->model->add($todo)){
    		$this->msOK = "Added data successfully!";
    	}
    	else{
			$this->msERR = "Failed to add data";
    	}
    }
}

?>
