<?php
require 'header.php';
require 'nav.php';

$sql 		= "SELECT * FROM staff";
$result 	= mysqli_query($conf, $sql);
$count 		= 1;

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
			<button class="btn btn-primary modal-with-form" href="#modalForm" style="float: right;">Add Staff</button>
				<h2 class="panel-title">Staff LIst</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="datatable-details">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Department</th>
							<th>Faculty</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(mysqli_num_rows($result) > 0){
							while($rows 		= mysqli_fetch_assoc($result)){
								$department 	= $rows['department'];
								// $sqls 			= "SELECT * FROM department WHERE id = '$department'";
								// $results		= mysqli_query($conf, $sqls);
								// if(mysqli_num_rows($results) > 0){
								// 	while ($row = mysqli_fetch_assoc($results)) {
								// 		$depart = $row['name'];
								// 	}
						?>
						<tr class="gradeX">
							<td><?php echo $count++; ?></td>
							<td><?php echo $rows['surname'].' '.$rows['othername']; ?></td>
							<td><?php echo $rows['email']; ?></td>
							<td><?php echo $rows['phone']; ?></td>
							<td class="center"> <?php echo $department; ?></td>
							<td class="center">	<?php echo 'Engineering' ?></td>
						</tr>
					<?php }}//} ?>						
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
			<h2 class="panel-title">Add a staff</h2>
		</header>
		<div class="panel-body">
			<form class="form-horizontal" action="../process/index" method="POST">
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
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						<input type="email" name="email" class="form-control" placeholder="Type your email..." required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Phone Number</label>
					<div class="col-sm-9">
						<input type="text" name="phone" class="form-control" placeholder="Type your phone..." required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Department</label>
					<div class="col-sm-9">
						<select name="department" class="form-control input-lg mb-md">
							<option value="Computer Engineering">Computer Engineering</option>
							<option value="Mechanical Engineering">Mechanical Engineering</option>
							<option value="Mechatronics">Mechatronics</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Faculty</label>
					<div class="col-sm-9">
						<select name="faculty" class="form-control input-lg mb-md">
							<option value="Engineering">Engineering</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Level</label>
					<div class="col-sm-9">
						<select name="level" class="form-control input-lg mb-md">
							<option value="3">Department</option>
							<option value="2">Faculty</option>
							<option value="1">Admin</option>
						</select>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<input type="submit" name="addStaff" class="btn btn-primary" value="submit">
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