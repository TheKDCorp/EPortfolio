<?php
if(isset($_COOKIE["admin_id"])) {
	header("Location: pages/index.php");
	exit();
} else {
}
?>

<?php 
include_once('includes/dbcon.php');

if((isset($_POST['username'])) && (isset($_POST['password'])) && (!empty($_POST['username'])) && (!empty($_POST['password']))){

	$username = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['username']))));
	$password = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['password']))));

	$sql = "select * from admin_members where username='$username' and password='$password' limit 1";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		$row=$result->fetch_assoc();
		setcookie("admin_id", $row['adminid'], time() + (86400),'/');

		header("Location: ./pages/index.php");	
	}else{
		header("Location: index.php");
			exit();
	}

}else{
		header("Location: index.php");
		exit();
}
 ?>
