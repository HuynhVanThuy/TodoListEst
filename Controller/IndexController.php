<?php 

namespace Controller;

require_once("Model/TodoModel.php");
require_once("Model/TodoEntity.php");

/**
 * Controller todo logic
 */
class IndexController
{
	public $model;	

	public function __construct()  
	{  
	    $this->model = new \Model\TodoModel();
	} 

	public function index()
    {
        return $this->model->getAllTodos();
    }

}

?>
