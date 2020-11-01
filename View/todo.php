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
</head>
<body>
	<?php
		require_once("../Controller/TodoController.php");
		$todoController = new Controller\TodoController();
		$todos = $todoController->index();
	?>
	<div class="container">
		<div class="col-md-12 text-center">
			<?php 
				$date = "";
				if (!empty($todos)) {
					$date = $todos[0]->createDate;
				} 
			?>
			<h6><?= $date ?></h6>
		</div>
		<div class="col-md-12">
			<!--begin:: Widgets/User Progress -->
			<div class="m-portlet m-portlet--full-height ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Task list
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
										<div class="m-widget4__progress">
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
											<a href="./view/todo.php?date=" class="m-btn m-btn--hover-brand m-btn--pill btn btn-sm btn-secondary">
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
		<div class="modal-dialog" role="document">
			<div class="modal-content">
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
							<input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-date-input" class="col-2 col-form-label">Start</label>
						<div class="col-10">
							<input class="form-control" type="date" value="2011-08-19" id="example-date-input">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-date-input" class="col-2 col-form-label">End</label>
						<div class="col-10">
							<input class="form-control" type="date" value="2011-08-19" id="example-date-input">
						</div>
					</div>
					<fieldset class="form-group">
						<div class="row">
							<legend class="col-form-label col-sm-2 pt-0">Status</legend>
							<div class="col-sm-10">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
									<label class="form-check-label" for="gridRadios1">
										Planning
									</label>
									<button type="button" class="btn btn-info btn-sm"></button>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
									<label class="form-check-label" for="gridRadios2">
										Doing
									</label>
									<button type="button" class="btn btn-success btn-sm"></button>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option2">
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
					<button type="button" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Edit-->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
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
							<input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-date-input" class="col-2 col-form-label">Start</label>
						<div class="col-10">
							<input class="form-control" type="date" value="2011-08-19" id="example-date-input">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-date-input" class="col-2 col-form-label">End</label>
						<div class="col-10">
							<input class="form-control" type="date" value="2011-08-19" id="example-date-input">
						</div>
					</div>
					<fieldset class="form-group">
						<div class="row">
							<legend class="col-form-label col-sm-2 pt-0">Status</legend>
							<div class="col-sm-10">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
									<label class="form-check-label" for="gridRadios1">
										Planning
									</label>
									<button type="button" class="btn btn-info btn-sm"></button>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
									<label class="form-check-label" for="gridRadios2">
										Doing
									</label>
									<button type="button" class="btn btn-success btn-sm"></button>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option2">
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
					<button type="button" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>