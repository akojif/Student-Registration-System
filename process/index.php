<?php
require 'dbconnect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// error_reporting(E_ERROR | E_WARNING | E_PARSE);


if(isset($_POST['login'])){
	$username 	= mysqli_escape_string($conf, $_POST['username']);
	$password 	= mysqli_escape_string($conf, $_POST['password']);

	$sql 		= "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
	$result		= mysqli_query($conf, $sql);

	if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			# code...
			session_start();
			$_SESSION['userid'] 		= $row['userid'];
			$_SESSION['username']		= $row['username'];
			$_SESSION['password']		= $row['password'];
			$_SESSION['role']			= $row['role'];
			$_SESSION['name']			= $row['name'];
			$role						= $row['role'];

			if($role == 1){
			  # code...
			  header('location:../admin/index');
			}elseif ($role == 2) {
			  # code...
			  header('location:../faculty/index');
			}elseif ($role == 3) {
			  # code...
			  header('location:../department/index');
			}
		}
	}else{
		echo 'error';
		echo "<script type=\"text/javascript\">
	            alert(\"User not found!.\");
	            window.location = \"../admin/staff\"
	          </script>";
	}
}


if(isset($_POST['addStaff'])){
	$surname 			= mysqli_escape_string($conf, $_POST['surname']);
	$othername 			= mysqli_escape_string($conf, $_POST['othername']);
	$email				= mysqli_escape_string($conf, $_POST['email']);
	$phone				= mysqli_escape_string($conf, $_POST['phone']);
	$level				= mysqli_escape_string($conf, $_POST['level']);
	$faculty			= mysqli_escape_string($conf, $_POST['faculty']);
	$department			= mysqli_escape_string($conf, $_POST['department']);

	$name 				= $surname.' '.$othername;

	$check 				= "SELECT * FROM staff WHERE email = '$email' AND phone = '$phone'";
	$check_result 		= mysqli_query($conf, $check);

	if(mysqli_num_rows($check_result) == 0){
		$sql 			= "INSERT INTO staff(surname, othername, phone, email, level, faculty, department) VALUES ('$surname','$othername','$phone','$email','$level', '$faculty', '$department')";
		$results 		= mysqli_query($conf, $sql);

		if($results){
			$user 		= "INSERT INTO user(name, username, password, role) 
							VALUES ('$name','$email','$phone','$level')";
			$result 	= mysqli_query($conf, $user);
		}
		echo "<script type=\"text/javascript\">
	            alert(\"Added Successfully!.\");
	            window.location = \"../admin/staff\"
	          </script>"; 
	}else{
		echo "<script type=\"text/javascript\">
	            alert(\"User exist!.\");  
	            window.location = \"../admin/staff\"
	          </script>"; 
	}

}




if(isset($_POST['addStudent'])){
	$matric 				= mysqli_escape_string($conf, $_POST['matric']);
	$surname				= mysqli_escape_string($conf, $_POST['surname']);
	$othername				= mysqli_escape_string($conf, $_POST['othername']);
	$faculty				= mysqli_escape_string($conf, $_POST['faculty']);
	$department				= mysqli_escape_string($conf, $_POST['department']);
	$department_officer		= mysqli_escape_string($conf, $_POST['department_name']);


	$check 					= "SELECT * FROM student WHERE matric = '$matric'";
	$check_result 			= mysqli_query($conf, $check);

	if(mysqli_num_rows($check_result) == 0){
		$sql 				= "INSERT INTO student(matric, surname, othername, faculty, department, status, department_officer, faculty_officer) 
								VALUES ('$matric', '$surname', '$othername', '$faculty', '$department', '1', '$department_officer', '')";
		$result 			= mysqli_query($conf, $sql);
		if($result){
			echo "<script type=\"text/javascript\">
	            alert(\"Added Successfully!.\");
	            window.location = \"../department/index\"
	          </script>"; 
	      }else{
	      	echo "<script type=\"text/javascript\">
	            alert(\"Error while adding!.\");
	            window.location = \"../department/index\"
	          </script>"; 
	    }
	}else{
		echo "<script type=\"text/javascript\">alert(\"Student data exist!.\");window.location = \"../admin/staff\"</script>";
	}
}

if(isset($_POST['facultyApproval'])){
	$matric 				= mysqli_escape_string($conf, $_POST['matric']);
	$surname				= mysqli_escape_string($conf, $_POST['surname']);
	$othername				= mysqli_escape_string($conf, $_POST['othername']);
	$faculty				= mysqli_escape_string($conf, $_POST['faculty']);
	$department				= mysqli_escape_string($conf, $_POST['department']);
	$faculty_officer		= mysqli_escape_string($conf, $_POST['faculty_officer']);

	$sql 					= "UPDATE student SET status ='2' WHERE matric = '$matric'";
	$result 				= mysqli_query($conf, $sql);
	if($result){
		echo "<script type=\"text/javascript\">
	            alert(\"Student Successfully Updated!.\");
	            window.location = \"../faculty/index\"
	          </script>"; 
	}else{
		echo "<script type=\"text/javascript\">
			            alert(\"Student Not Updated!.\");
			            window.location = \"../faculty/index\"
			          </script>";
	}

}

?>