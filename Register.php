<?php  
	date_default_timezone_set("Asia/Calcutta");

    include 'includes/dbcon.php';

$output = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if($_POST['method']=="entrystaffdetails"){
	    $name= $_POST["name"];
	    $passcode= $_POST["passcode"];
	    $type= $_POST["type"];
	    $date = date('Y-m-d');
	    $time = date("g:i A");

	    $sql = "select * from staffatt order by imgid desc limit 1";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$imgid = $row['imgid'];

			if($imgid == ""){
				$imgid = "1";
			}else{
				$newimgid = $imgid + 1;
			}
		}else{
			$newimgid="1";
		}

		$image = md5($newimgid).".jpg";

    	$sql = "INSERT INTO staffatt(attid,passcode,type,time,image,imgid,name,date,shows)VALUES(DEFAULT,'$passcode','$type','$time','$image','$newimgid','$name','$date','true')";
		$conn->query($sql);
		$output['sql'] = $sql;
		$target_dir = "./image";
		if(!file_exists($target_dir))
		{
		mkdir($target_dir, 0777, true);
		}

		$target_dir = $target_dir . "/" . md5($newimgid).".jpg";

		$output['targetdir'] = $target_dir;
		$output['tempn'] = $_FILES["file"]["tmp_name"];

		move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir);


		echo json_encode($output);
	}
}else{
	if($_GET['method']=="checkpasscode"){
	    $passcode= $_GET["passcode"]; 
    	$sql = "select * from staffdetails where passcode='$passcode'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$output['response'] = "true";
			$output['staffname'] = $row['name'];
		}else{
			$output['response'] = "false";
			$output['staffname'] = "no_record_found";
		}
	echo json_encode($output);
	}
}

?>



