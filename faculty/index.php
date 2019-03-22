<?php
require 'header.php';
require 'nav.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$count 			= 1;
$sql 			= "SELECT * FROM  student";
$result  		= mysqli_query($conf, $sql);
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
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
					<a href="#" class="fa fa-times"></a>
				</div>
		
				<h2 class="panel-title">Rows with Details</h2>
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
							<th>Action</th>													
						</tr>
					</thead>
					<tbody>
						<?php
						if(mysqli_num_rows($result) > 0){
							while($rows 		= mysqli_fetch_assoc($result)){
								if($rows['status'] == 1){
									$button 	= '<span class="label label-warning">Not Completed</span>';
								}elseif($rows['status'] == 2){
									$button 	= '<span class="label label-success">Completed</span>';
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
							<td><a class="modal-with-form" href="#modalForm-<?php echo $rows['matric']; ?>" style="float: right;">Edit</a></td>
						</tr>
						<?php }} ?>
				
					</tbody>
				</table>
			</div>
		</section>
		</div>
	</div>
</section>

<?php
$sql 			= "SELECT * FROM student";
$result  		= mysqli_query($conf, $sql);
if(mysqli_num_rows($result) > 0){
	while($rows 		= mysqli_fetch_assoc($result)){
?>

<div id="modalForm-<?php echo $rows['matric']; ?>" class="modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title">Add a student</h2>
		</header>
		<div class="panel-body">
			<form class="form-horizontal" action="../process/index" method="POST">
				<input type="text" name="faculty_officer" value="<?php echo $_SESSION['name']; ?>" hidden>
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Matric Number</label>
					<div class="col-sm-9">
						<input type="text" name="matric" class="form-control" readonly value="<?php echo $rows['matric']; ?>" placeholder="Type matric number ..." required/>
					</div>
				</div>
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Surname</label>
					<div class="col-sm-9">
						<input type="text" name="surname" class="form-control" readonly value="<?php echo $rows['surname']; ?>" placeholder="Type your surname..." required/>
					</div>
				</div>
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Other Name</label>
					<div class="col-sm-9">
						<input type="text" name="othername" class="form-control" value="<?php echo $rows['othername']; ?>" placeholder="Type your other name..." readonly required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Department</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="department" value="<?php echo $rows['department']; ?>" readonly required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Faculty</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="faculty" value="Engineering" required readonly>
						
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<input type="submit" name="facultyApproval" class="btn btn-primary" value="submit">
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>
<?php }} ?>


<?php
require 'footer.php';

?>