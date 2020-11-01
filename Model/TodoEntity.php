<?php 

namespace Entity;

/**
 * Entity todo
 */
class TodoEntity
{
	public $id;
	public $taskName;
	public $startDate;
	public $endDate;
	public $status;
	public $createDate;

	public function __construct($id, $taskName, $startDate, $endDate, $status, $createDate)
	{
		$this->id = $id;
		$this->taskName = $taskName;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->status = $status;
		$this->createDate = $createDate;
	}
}

?>