<?php
require 'header.php';
require 'nav.php';
$count 				= 1; 
$username 			= $_SESSION['username'];
$user 				= "SELECT * FROM staff WHERE email = '$username'";
$user_result 		= mysqli_query($conf, $user);
if(mysqli_num_rows($user_result) > 0 ){
	while ($row 	= mysqli_fetch_assoc($user_result)) {
		$department = $row['department'];
	}
}
$sql 				= "SELECT * FROM student WHERE department = '$department'";
$result 			= mysqli_query($conf, $sql);
?>



<section role="main" class="content-body">
	<header class="page-header">
		<h2>Dashboard</h2>
	
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.html">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>
			</ol>
	
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

		<div class="row">
		<div class="col-md-12">
			<section class="panel">
			<header class="panel-heading">
				<button class="btn btn-primary modal-with-form" href="#modalForm" style="float: right;">Add Student</button>
				<h2 class="panel-title">Registered Student at the department</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="datatable-details">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Matric Number</th>
							<th>Full Name</th>
							<th>Department</th>
							<th>Faculty</th>
							<th>Status</th>
							<th>Registered By</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(mysqli_num_rows($result) > 0){
							while($rows 		= mysqli_fetch_assoc($result)){
								if($rows['status'] == 1){
									$button = '<span class="label label-warning">Not Completed</span>';
								}elseif($rows['status'] == 2){
									$button = '<span class="label label-success">Completed</span>';
								}
						?>
						<tr class="gradeX">
							<td><?php echo $count++; ?></td>
							<td><?php echo $rows['matric']; ?></td>
							<td><?php echo $rows['surname'].' '.$rows['othername']; ?></td>
							<td><?php echo $rows['department']; ?></td>
							<td><?php echo 'Engineering'; ?></td>
							<td><?php echo $button; ?></td>
							<td><?php echo $rows['department_officer']; ?></td>
						</tr>
					<?php }}?>
						
					</tbody>
				</table>
			</div>
		</section>
		</div>
	</div>
</section>
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title">Add a student</h2>
		</header>
		<div class="panel-body">
			<form class="form-horizontal" action="../process/index" method="POST">
				<input type="text" name="department_name" value="<?php echo $_SESSION['name']; ?>" hidden>
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Matric Number</label>
					<div class="col-sm-9">
						<input type="text" name="matric" class="form-control" placeholder="Type matric number ..." required/>
					</div>
				</div>
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Surname</label>
					<div class="col-sm-9">
						<input type="text" name="surname" class="form-control" placeholder="Type your surname..." required/>
					</div>
				</div>
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Other Name</label>
					<div class="col-sm-9">
						<input type="text" name="othername" class="form-control" placeholder="Type your other name..." required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Department</label>
					<div class="col-sm-9">
						<input type="text" name="department" value="<?php echo $department; ?>" readonly class="form-control">
						<!-- <select name="department" class="form-control input-lg mb-md">
							<option value="Computer Engineering">Computer Engineering</option>
							<option value="Mechanical Engineering">Mechanical Engineering</option>
							<option value="Mechatronics">Mechatronics</option>
						</select> -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Faculty</label>
					<div class="col-sm-9">
						<input type="text" name="faculty" readonly value="<?php echo 'Engineering'; ?>" class="form-control"> 
						<!-- <select name="faculty" class="form-control input-lg mb-md">
							<option value="1">Engineering</option>
						</select> -->
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<input type="submit" name="addStudent" class="btn btn-primary" value="submit">
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>


<?php
require 'footer.php';

?>