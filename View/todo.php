<?php
	require_once("../Controller/TodoController.php");
	$todoController = new Controller\TodoController();
	$todos = null;
	// load default template todo task list
	if($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_REQUEST['date'])){
		$todos = $todoController->index($_REQUEST['date']);		
	}
	// Add new task
	if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['type'] == "ADD"){
		$todoController->add();
		$todos = $todoController->index($todoController->date);
	}
	// Edit current task
	if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['type'] == "EDIT"){
		$todoController->edit();
		$todos = $todoController->index($todoController->date);
	}
	// Delete task by id
	if($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_REQUEST['delete'])){
		$todoController->delete();
		$todos = $todoController->index($_REQUEST['date']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Todo-List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../assets/css/todo.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php if($todoController->date){ ?>
		<div class="container">
			<div class="col-md-12">
				<?php if($todoController->msOK){ ?>
						<div class="alert alert-success" role="alert">
							<?= $todoController->msOK ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
				<?php } ?>
				<?php if($todoController->msERR){ ?>
						<div class="alert alert-danger" role="alert">
							<?= $todoController->msERR ?>
						</div>
				<?php } ?>
			</div>
			<div class="col-md-12 text-center">
				<h6><?= $todoController->date ?></h6>
			</div>
			<div class="col-md-12">
				<!--begin:: Widgets/User Progress -->
				<div class="m-portlet m-portlet--full-height ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									<a href="../index.php" class="btn"><i class="fa fa-home"></i></a>
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
								<li class="nav-item m-tabs__item">
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">
										Add
									</button>
								</li>
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="tab-content">
							<div class="tab-pane active" id="m_widget4_tab1_content">
								<div class="m-widget4 m-widget4--progress">
									<?php foreach ($todos as $todo) { ?>
										<div class="m-widget4__item">
											<div class="m-widget4__info">
												<span class="m-widget4__sub">
													Start : <?= $todo->startDate ?>
												</span>
												<br>
												<span class="m-widget4__sub">
													End : <?= $todo->endDate ?>
												</span>
											</div>
											<div class="m-widget4__progress" data-id="<?= $todo->id ?>">
												<div class="m-widget4__progress-wrapper">
													<span class="m-widget17__progress-number">
														<?= $todo->taskName ?>
													</span>
													<span class="m-widget17__progress-label">
														<?= $todo->status ?>
													</span>
													<?php 
														$colorStatus = "";
														switch ($todo->status) {
															case 'Planning':
																$colorStatus = "#17a2b8";
																break;
															case 'Doing':
																$colorStatus = "#28a745";
																break;
															case 'Complete':
																$colorStatus = "#ffc107";
																break;
														}
													?>
													<div class="progress m-progress--sm" style="background-color: <?= $colorStatus ?>;">
														<div class="progress-bar bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="63"></div>
													</div>
												</div>
											</div>
											<div class="m-widget4__ext">
												<a href="todo.php?delete=<?= $todo->id ?>&date=<?= $todo->createDate ?>" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary">
													Delete
												</a>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end:: Widgets/User Progress -->
			</div>
		</div>

		<!-- Modal Add-->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<form method="POST" action="todo.php">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div style="display: none;">
							<input name="type" value="ADD">
							<input name="createDate" value="<?= $todoController->date ?>">
						</div>
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Task info</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group row">
								<label for="example-text-input" class="col-2 col-form-label">Task name</label>
								<div class="col-10">
									<input class="form-control" type="text" value="" id="example-text-input" name="taskName" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="example-date-input" class="col-2 col-form-label">Start</label>
								<div class="col-10">
									<input class="form-control" type="date" value="" id="example-date-input" name="startDate" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="example-date-input" class="col-2 col-form-label">End</label>
								<div class="col-10">
									<input class="form-control" type="date" value="" id="example-date-input" name="endDate" required>
								</div>
							</div>
							<fieldset class="form-group">
								<div class="row">
									<legend class="col-form-label col-sm-2 pt-0">Status</legend>
									<div class="col-sm-10">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="status" id="gridRadios1" value="Planning" checked>
											<label class="form-check-label" for="gridRadios1">
												Planning
											</label>
											<button type="button" class="btn btn-info btn-sm"></button>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="status" id="gridRadios2" value="Doing">
											<label class="form-check-label" for="gridRadios2">
												Doing
											</label>
											<button type="button" class="btn btn-success btn-sm"></button>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="status" id="gridRadios3" value="Complete">
											<label class="form-check-label" for="gridRadios3">
												Complete
											</label>
											<button type="button" class="btn btn-warning btn-sm"></button>
										</div>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<!-- Modal Edit-->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<form method="POST" action="todo.php">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div style="display: none;">
							<input name="type" value="EDIT">
							<input name="id" value="" id="id-edit">
							<input name="createDate" value="<?= $todoController->date ?>">
						</div>
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Task info</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group row">
								<label for="example-text-input" class="col-2 col-form-label">Task name</label>
								<div class="col-10">
									<input class="form-control" type="text" value="" id="task-name-edit" name="taskName">
								</div>
							</div>
							<div class="form-group row">
								<label for="example-date-input" class="col-2 col-form-label">Start</label>
								<div class="col-10">
									<input class="form-control" type="date" value="2011-08-19" id="start-date-edit" name="startDate">
								</div>
							</div>
							<div class="form-group row">
								<label for="example-date-input" class="col-2 col-form-label">End</label>
								<div class="col-10">
									<input class="form-control" type="date" value="2011-08-19" id="end-date-edit" name="endDate">
								</div>
							</div>
							<fieldset class="form-group">
								<div class="row">
									<legend class="col-form-label col-sm-2 pt-0">Status</legend>
									<div class="col-sm-10">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="status" id="status-planning-edit" value="Planning" checked>
											<label class="form-check-label" for="status-planning-edit">
												Planning
											</label>
											<button type="button" class="btn btn-info btn-sm"></button>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="status" id="status-doing-edit" value="Doing">
											<label class="form-check-label" for="status-doing-edit">
												Doing
											</label>
											<button type="button" class="btn btn-success btn-sm"></button>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="status" id="status-complete-edit" value="Complete">
											<label class="form-check-label" for="status-complete-edit">
												Complete
											</label>
											<button type="button" class="btn btn-warning btn-sm"></button>
										</div>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<script>
			$(".m-widget4__progress").click(function(){
				let id = $(this).attr("data-id");
				let todos = <?php echo json_encode($todos); ?>;
				let todoInfo = null;
				for (let [index, todo] of Object.entries(todos)) {
					for (let [key, value] of Object.entries(todo)) {
						if(todo['id'] == id){
							todoInfo = todo;
							break;
						}
					}
					if(todoInfo !== null){
						break;
					}
				}
				// Set value for fomr edit from todoInfo
				let type = "-edit";
				console.log(todoInfo);
				$('#id'+type).val(todoInfo['id']);
				$('#task-name'+type).val(todoInfo['taskName']);
				$('#start-date'+type).val(todoInfo['startDate']);
				$('#end-date'+type).val(todoInfo['endDate']);
				switch(todoInfo['status']) {
				  case "Planning":
				    $("#status-planning-edit").prop("checked", true);
				    break;
				  case "Doing":
				    $("#status-doing-edit").prop("checked", true);
				    break;
				  case "Complete":
				    $("#status-complete-edit").prop("checked", true);
				    break;
				}

				$('#editModal').modal('show');
			});
		</script>
	<?php }else{ ?>
		<div class="row">
			<div class="col-12 text-center">
				<h1>404 NOT FOUND</h1>
			</div>
		</div>
	<?php } ?>
</body>
</html>