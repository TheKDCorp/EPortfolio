<?php 
include_once('../includes/dbcon.php');

date_default_timezone_set("Asia/Calcutta");

if(!empty($_POST['method'])){
	if($_POST['method']=="addclass"){
	    $uid = $_POST['uid'];
	    $classname = $_POST['classname'];
	    $sql = "INSERT INTO class_entry(cid,classname,uid)VALUES(DEFAULT,'$classname','$uid')";
	    $conn->query($sql);   
	}

	if($_POST['method']=="deleteclass"){
	    $uid = $_POST['uid'];
	    $classid = $_POST['classid'];

	    $sql = "DELETE FROM class_entry WHERE cid='$classid' AND uid='$uid'";
	    $conn->query($sql);  
	}

	if($_POST['method']=="updateclass"){
	    $uid = $_POST['uid'];
	    $classid = $_POST['classid'];
	    $classname = $_POST['classname'];

	    $sql = "UPDATE class_entry SET classname='$classname' WHERE cid='$classid' AND uid='$uid'";
	    $conn->query($sql);  
	}

	if($_POST['method']=="addsection"){
	    $uid = $_POST['uid'];
	    $classid = $_POST['classid'];
	    $classname = $_POST['classname'];
	    $sectionname = $_POST['sectionname'];

	    $sql = "INSERT INTO section_entry(sid,sectionname,uid,cid,classname)VALUES(DEFAULT,'$sectionname','$uid','$classid','$classname')";
	    $conn->query($sql);        
	}

	if($_POST['method']=="deletesection"){
	    $uid = $_POST['uid'];
	    $sectionid = $_POST['sectionid'];

	    $sql = "DELETE FROM section_entry WHERE sid='$sectionid' AND uid='$uid'";
	    $conn->query($sql);  
	}

	if($_POST['method']=="updatesection"){
	    $uid = $_POST['uid'];
	    $sectionid = $_POST['sectionid'];
	    $sectionname = $_POST['sectionname'];

	    $sql = "UPDATE section_entry SET sectionname='$sectionname' WHERE sid='$sectionid' AND uid='$uid'";
	    $conn->query($sql);  
	}

	if($_POST['method']=="stentry_addnew"){
	    $uid = $_POST['uid'];
	    $cid = $_POST['classid'];
	    $sid = $_POST['sectionid'];
	    $studentname = $_POST['st_name'];
	    $dateofadmission = $_POST['st_dateofadmission'];
	    $sql = "INSERT INTO student_admission(studentid,classid,dateofadmission,uid)VALUES(DEFAULT,'$cid','$dateofadmission','$uid')";
	    $conn->query($sql);
	    $sql = "select * from student_admission order by studentid desc limit 1";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	$stid = $row['studentid'];
		    $sql = "INSERT INTO student_biodata(biodataid,studentid,studentname)VALUES(DEFAULT,'$stid','$studentname')";
		    $conn->query($sql);

		    $sql = "INSERT INTO student_contact(contactid,studentid,mobileno1,mobileno2,emailid,address,hometown)VALUES(DEFAULT,'$stid','','','','','')";
		    $conn->query($sql);

    		$sql = "INSERT INTO student_csdetails(studentcsid,studentid,classid,sectionid,uid,dateofadmission)VALUES(DEFAULT,'$stid','$cid','$sid','$uid','$dateofadmission')";
	    	$conn->query($sql);  
	    }
	}

	if($_POST['method']=="biodata_update"){
	    $studentid = $_POST['stid'];

	    $biodata_name = $_POST['bio_name'];
	    $biodata_fathersname = $_POST['bio_fathersname'];
	    $biodata_mothersname = $_POST['bio_mothersname'];
	    $biodata_dob = $_POST['bio_dob'];
	    $biodata_gender = $_POST['bio_gender'];
	    $biodata_abouthim = $_POST['bio_abouthim'];


		$target_file = "../images/profile/".md5($studentid).".jpg";
		if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		    $dp = md5($studentid);
		} else {
		    $dp = "";
		}
		
		if($dp==""){
			$sql = "UPDATE student_biodata SET studentname='$biodata_name',fathersname='$biodata_fathersname',mothersname='$biodata_mothersname',gender='$biodata_gender',dob='$biodata_dob',abouthim='$biodata_abouthim' where studentid='$studentid'";
		}else{
			$sql = "UPDATE student_biodata SET studentname='$biodata_name',fathersname='$biodata_fathersname',mothersname='$biodata_mothersname',gender='$biodata_gender',dob='$biodata_dob',dp='$dp',abouthim='$biodata_abouthim' where studentid='$studentid'";
		}
    	$conn->query($sql);  

	}
	
	if($_POST['method']=="biodata_getdetails"){
		$output = array();

	    $studentid = $_POST['stid'];

	    $sql = "SELECT * FROM student_biodata where studentid='$studentid'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	$output['name'] = $row['studentname'];
	    	$output['fathersname'] = $row['fathersname'];
	    	$output['mothersname'] = $row['mothersname'];
	    	$output['gender'] = $row['gender'];
	    	$output['dob'] = $row['dob'];
	    	$output['abouthim'] = $row['abouthim'];
	    	if($row['dp']==""){
		    	$output['dp'] = "";
	    	}else{
		    	$output['dp'] = $row['dp'];
	    	}
	    }
	    header('Content-Type: application/json');
	    echo json_encode($output);
	}	

	if($_POST['method']=="activity_get"){
		$output = array();
		$input = array();
		$response = array();
		$nooffields = 0;
	    $activityid = $_POST['activityid'];

	    $sql = "SELECT * FROM activity where activityid='$activityid'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	if($row['field1name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field1name'];
	    		$output['fieldtype'] = $row['field1type'];
	    		$output['fieldtext'] = $row['field1text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field2name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field2name'];
	    		$output['fieldtype'] = $row['field2type'];
	    		$output['fieldtext'] = $row['field2text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field3name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field3name'];
	    		$output['fieldtype'] = $row['field3type'];
	    		$output['fieldtext'] = $row['field3text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field4name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field4name'];
	    		$output['fieldtype'] = $row['field4type'];
	    		$output['fieldtext'] = $row['field4text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field5name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field5name'];
	    		$output['fieldtype'] = $row['field5type'];
	    		$output['fieldtext'] = $row['field5text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field6name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field6name'];
	    		$output['fieldtype'] = $row['field6type'];
	    		$output['fieldtext'] = $row['field6text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field7name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field7name'];
	    		$output['fieldtype'] = $row['field7type'];
	    		$output['fieldtext'] = $row['field7text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field8name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field8name'];
	    		$output['fieldtype'] = $row['field8type'];
	    		$output['fieldtext'] = $row['field8text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field9name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field9name'];
	    		$output['fieldtype'] = $row['field9type'];
	    		$output['fieldtext'] = $row['field9text'];
	    		array_push($input,$output);	
	    	}
	    	if($row['field10name']!=""){
	    		$nooffields = $nooffields + 1;
	    		$output['fieldname'] = $row['field10name'];
	    		$output['fieldtype'] = $row['field10type'];
	    		$output['fieldtext'] = $row['field10text'];
	    		array_push($input,$output);	
	    	}
	    	$response['nooffields']=$nooffields;
	    	$response['activityname']=$row['activityname'];
	    	$response['activityid']=$row['activityid'];

	    }
	    $response['response'] = $input;
	    header('Content-Type: application/json');
	    echo json_encode($response);
	}	

	if($_POST['method']=="monthfeedback_save"){
	    $activityid = $_POST['activityid'];
	    $studentcsid = $_POST['studentcsid'];
	    $month = $_POST['month'];

	    $field1answer = "";
	    $field2answer = "";
	    $field3answer = "";
	    $field4answer = "";
	    $field5answer = "";
	    $field6answer = "";
	    $field7answer = "";
	    $field8answer = "";
	    $field9answer = "";
	    $field10answer = "";

	    if(!empty($_POST['field1answer'])){
		    $field1answer = $_POST['field1answer'];
	    }
	    if(!empty($_POST['field2answer'])){
		    $field2answer = $_POST['field2answer'];
	    }
	    if(!empty($_POST['field3answer'])){
		    $field3answer = $_POST['field3answer'];
	    }
	    if(!empty($_POST['field4answer'])){
		    $field4answer = $_POST['field4answer'];
	    }
	    if(!empty($_POST['field5answer'])){
		    $field5answer = $_POST['field5answer'];
	    }
	    if(!empty($_POST['field6answer'])){
		    $field6answer = $_POST['field6answer'];
	    }
	    if(!empty($_POST['field7answer'])){
		    $field7answer = $_POST['field7answer'];
	    }
	    if(!empty($_POST['field8answer'])){
		    $field8answer = $_POST['field8answer'];
	    }
	    if(!empty($_POST['field9answer'])){
		    $field9answer = $_POST['field9answer'];
	    }
	    if(!empty($_POST['field10answer'])){
		    $field10answer = $_POST['field10answer'];
	    }

	    if($field1answer=="" || $field1answer=="undefined"){
  			$field1answer = "";
  		}
  		if($field2answer=="" || $field2answer=="undefined"){
  			$field2answer = "";
  		}
  		if($field3answer=="" || $field3answer=="undefined"){
  			$field3answer = "";
  		}
  		if($field4answer=="" || $field4answer=="undefined"){
  			$field4answer = "";
  		}
  		if($field5answer=="" || $field5answer=="undefined"){
  			$field5answer = "";
  		}
  		if($field6answer=="" || $field6answer=="undefined"){
  			$field6answer = "";
  		}
  		if($field7answer=="" || $field7answer=="undefined"){
  			$field7answer = "";
  		}
  		if($field8answer=="" || $field8answer=="undefined"){
  			$field8answer = "";
  		}
  		if($field9answer=="" || $field9answer=="undefined"){
  			$field9answer = "";
  		}
  		if($field10answer=="" || $field10answer=="undefined"){
  			$field10answer = "";
  		}


	    $target_file = "../images/monthfeedback/".md5($studentcsid.$activityid.$month).".jpg";
		if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		    $dp = md5($studentcsid.$activityid.$month);
		} else {
		    $dp = "";
		}

	    $sql = "SELECT * FROM student_monthfeedback WHERE studentcsid='$studentcsid' AND activityid='$activityid' AND month='$month'";
	    $result=$conn->query($sql);
	    if($result->num_rows > 0){
	    	if($dp==""){
	    		$sql = "UPDATE student_monthfeedback SET field1answer='$field1answer',field2answer='$field2answer',field3answer='$field3answer',field4answer='$field4answer',field5answer='$field5answer',field6answer='$field6answer',field7answer='$field7answer',field8answer='$field8answer',field9answer='$field9answer',field10answer='$field10answer' WHERE studentcsid='$studentcsid' AND activityid='$activityid' AND month='$month'";
	    	}else{
	    		$sql = "UPDATE student_monthfeedback SET field1answer='$field1answer',field2answer='$field2answer',field3answer='$field3answer',field4answer='$field4answer',field5answer='$field5answer',field6answer='$field6answer',field7answer='$field7answer',field8answer='$field8answer',field9answer='$field9answer',field10answer='$field10answer',dp='$dp' WHERE studentcsid='$studentcsid' AND activityid='$activityid' AND month='$month'";
	    	}
	    	
	    	$conn->query($sql);
	    }else{
	    	if($studentcsid=="" || $activityid=="" || $month==""){

	    	}else{
		    	$sql = "INSERT INTO student_monthfeedback(mfid,studentcsid,activityid,month,field1answer,field2answer,field3answer,field4answer,field5answer,field6answer,field7answer,field8answer,field9answer,field10answer,dp)VALUES(DEFAULT,'$studentcsid','$activityid','$month','$field1answer','$field2answer','$field3answer','$field4answer','$field5answer','$field6answer','$field7answer','$field8answer','$field9answer','$field10answer','$dp')";
			    $conn->query($sql);
	    	}
	    }
	}

	if($_POST['method']=="monthfeedback_getdata"){
		$output = array();
		$input = array();
		$response = array();
		$nooffields = 0;
		$noofactivity = 0;
	    $studentcsid = $_POST['studentcsid'];

	    $sql = "SELECT * FROM student_monthfeedback where studentcsid='$studentcsid'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	while($row = $result->fetch_assoc()){
	    		$output['activityid'] = $row['activityid'];
	    		$output['mfid'] = $row['mfid'];
	    		$activityid = $row['activityid'];

	    		$sql1 = "select * from activity where activityid='$activityid'";
	    		$result1= $conn->query($sql1);
	    		if($result1->num_rows > 0){
	    			$row1 = $result1->fetch_assoc();
	    			$output['activityname']=$row1['activityname'];
	    		}else{
	    			$output['activityname']="";
	    		}

	    		$output['month'] = $row['month'];
	    		
	    		if($row['dp']==""){
			    	$output['dp'] = "";
		    	}else{
			    	$output['dp'] = $row['dp'];
		    	}

		    	
		    	if($row['field1answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field1answer'] = $row['field1answer'];
		    		$output['field1type'] = $row1['field1type'];
		    		$output['field1name'] = $row1['field1name'];
		    		$output['field1text'] = $row1['field1text'];
		    	}else{
		    		$output['field1answer']="";
		    		$output['field1type'] = "";
		    		$output['field1name'] = "";
		    		$output['field1text'] = "";

		    	}

		    	if($row['field2answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field2answer'] = $row['field2answer'];
		    		$output['field2type'] = $row1['field2type'];
		    		$output['field2name'] = $row1['field2name'];
		    		$output['field2text'] = $row1['field2text'];
		    	}else{
		    		$output['field2answer']="";
		    		$output['field2type'] = "";
		    		$output['field2name'] = "";
		    		$output['field2text'] = "";
		    	}

		    	if($row['field3answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field3answer'] = $row['field3answer'];
		    		$output['field3type'] = $row1['field3type'];
		    		$output['field3name'] = $row1['field3name'];
		    		$output['field3text'] = $row1['field3text'];
		    	}else{
		    		$output['field3answer']="";
		    		$output['field3type'] = "";
		    		$output['field3name'] = "";
		    		$output['field3text'] = "";
		    	}

		    	if($row['field4answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field4answer'] = $row['field4answer'];
		    		$output['field4type'] = $row1['field4type'];
		    		$output['field4name'] = $row1['field4name'];
		    		$output['field4text'] = $row1['field4text'];
		    	}else{
		    		$output['field4answer']="";
		    		$output['field4type'] = "";
		    		$output['field4name'] = "";
		    		$output['field4text'] = "";
		    	}

		    	if($row['field5answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field5answer'] = $row['field5answer'];
		    		$output['field5type'] = $row1['field5type'];
		    		$output['field5name'] = $row1['field5name'];
		    		$output['field5text'] = $row1['field5text'];
		    	}else{
		    		$output['field5answer']="";
		    		$output['field5type'] = "";
		    		$output['field5name'] = "";
		    		$output['field5text'] = "";
		    	}

		    	if($row['field6answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field6answer'] = $row['field6answer'];
		    		$output['field6type'] = $row1['field6type'];
		    		$output['field6name'] = $row1['field6name'];
		    		$output['field6text'] = $row1['field6text'];
		    	}else{
		    		$output['field6answer']="";
		    		$output['field6type'] = "";
		    		$output['field6name'] = "";
		    		$output['field6text'] = "";
		    	}

		    	if($row['field7answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field7answer'] = $row['field7answer'];
		    		$output['field7type'] = $row1['field7type'];
		    		$output['field7name'] = $row1['field7name'];
		    		$output['field7text'] = $row1['field7text'];
		    	}else{
		    		$output['field7answer']="";
		    		$output['field7type'] = "";
		    		$output['field7name'] = "";
		    		$output['field7text'] = "";
		    	}

		    	if($row['field8answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field8answer'] = $row['field8answer'];
		    		$output['field8type'] = $row1['field8type'];
		    		$output['field8name'] = $row1['field8name'];
		    		$output['field8text'] = $row1['field8text'];
		    	}else{
		    		$output['field8answer']="";
		    		$output['field8type'] = "";
		    		$output['field8name'] = "";
		    		$output['field8text'] = "";
		    	}

		    	if($row['field9answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field9answer'] = $row['field9answer'];
		    		$output['field9type'] = $row1['field9type'];
		    		$output['field9name'] = $row1['field9name'];
		    		$output['field9text'] = $row1['field9text'];
		    	}else{
		    		$output['field9answer']="";
		    		$output['field9type'] = "";
		    		$output['field9name'] = "";
		    		$output['field9text'] = "";
		    	}

		    	if($row['field10answer']!=""){
		    		$nooffields = $nooffields + 1;
		    		$output['field10answer'] = $row['field10answer'];
		    		$output['field10type'] = $row1['field10type'];
		    		$output['field10name'] = $row1['field10name'];
		    		$output['field10text'] = $row1['field10text'];
		    	}else{
		    		$output['field10answer']="";
		    		$output['field10type'] = "";
		    		$output['field10name'] = "";
		    		$output['field10text'] = "";
		    	}

		    	$output['nooffields']=$nooffields;
		    	array_push($input,$output);	
		    	$nooffields = 0;
				$noofactivity = $noofactivity + 1;
	    	}
	    	$response['noofactivity']=$noofactivity;
	    }
	    $response['activity'] = $input;
	    header('Content-Type: application/json');
	    echo json_encode($response);
	}	

	if($_POST['method']=="monthfeedback_delete"){
	    $monthfeedback_id = $_POST['monthfeedback_id'];

	    $sql = "DELETE FROM student_monthfeedback WHERE mfid='$monthfeedback_id'";
	    $conn->query($sql);
	}

	if($_POST['method']=="contact_getdetails"){
		$output = array();

	    $studentid = $_POST['stid'];

	    $sql = "SELECT * FROM student_contact where studentid='$studentid'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	$output['mobileno1'] = $row['mobileno1'];
	    	$output['mobileno2'] = $row['mobileno2'];
	    	$output['emailid'] = $row['emailid'];
	    	$output['address'] = $row['address'];
	    	$output['hometown'] = $row['hometown'];
	    }
	    header('Content-Type: application/json');
	    echo json_encode($output);
	}	

	if($_POST['method']=="contact_update"){
	    $studentid = $_POST['stid'];

	    $contact_mobileno1 = $_POST['contact_mobileno1'];
	    $contact_mobileno2 = $_POST['contact_mobileno2'];
	    $contact_emailid = $_POST['contact_emailid'];
	    $contact_address = $_POST['contact_address'];
	    $contact_hometown = $_POST['contact_hometown'];

		$sql = "UPDATE student_contact SET mobileno1='$contact_mobileno1',mobileno2='$contact_mobileno2',emailid='$contact_emailid',address='$contact_address',hometown='$contact_hometown' where studentid='$studentid'";
    	$conn->query($sql);  

	}

	if($_POST['method']=="skills_getdetails"){
		$output = array();
		$input = array();
		$response = array();
	    $studentid = $_POST['studentid'];

	    $sql = "SELECT * FROM student_skills where studentid='$studentid'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	while($row = $result->fetch_assoc()){
	    		$output['skillsname'] = $row['skillsname'];
	    		$output['skillsdescription'] = $row['skillsdescription'];
	    		$output['skillsid'] = $row['skillsid'];
	    		
	    		if($row['dp']==""){
			    	$output['skillsdp'] = "";
		    	}else{
			    	$output['skillsdp'] = $row['dp'];
		    	}
	    		
		    	array_push($input,$output);	
	    	}
	    }
	    $response['noofskills']=$result->num_rows;
	    $response['skills'] = $input;
	    header('Content-Type: application/json');
	    echo json_encode($response);
	}

	if($_POST['method']=="skills_save"){
	    $studentid = $_POST['studentid'];
	    $skills_name = $_POST['skills_name'];
	    $skills_description = $_POST['skills_description'];
	    $skills_id = $_POST['skills_id'];
	    $dp = $_FILES['dp'];
	    
	    if($skills_id==""){
		    $sql = "SELECT * FROM student_skills WHERE studentid='$studentid'";
		    $result = $conn->query($sql);
		    if($result->num_rows > 0){
		    	$noofrecords = $result->num_rows;
		    }else{
		    	$noofrecords = 0;
		    }
		    $noofrecords = $noofrecords + 1;
		    $name = md5($studentid).$noofrecords;
		}else{
			if($dp==""){
			}else{
			    if($name==""){
			    	$sql = "Select * from student_skills where studentid='$studentid'";
			    	$result=$conn->query($sql);
			    	if($result->num_rows > 0){
			    		$no = 1;
			    		$finalno = 0;
				    	while($rowdummy = $result->fetch_assoc()){
				    		if($rowdummy['skillsid']==$skills_id){
					    		$name = md5($studentid).$no;
				    		}else{
					    		$no = $no + 1;
				    		}
				    	}
			    	}
			    }
			}
		}
	    $target_file = "../images/skills/".$name.".jpg";
		if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		    $dp = $name;
		} else {
		    $dp = "";
		}

		if(($skills_id)==""){
		    $sql = "INSERT INTO student_skills(skillsid,studentid,skillsname,skillsdescription,dp)VALUES(DEFAULT,'$studentid','$skills_name','$skills_description','$dp')";
		}else{
			if($dp==""){
			    $sql = "UPDATE student_skills SET skillsname='$skills_name',skillsdescription='$skills_description' where skillsid='$skills_id'";
			}else{
			    $sql = "UPDATE student_skills SET skillsname='$skills_name',skillsdescription='$skills_description',dp='$dp' where skillsid='$skills_id'";
			}
		}
	    $conn->query($sql);
	}

	if($_POST['method']=="skills_delete"){
	    $skills_id = $_POST['skills_id'];

	    $sql = "DELETE FROM student_skills WHERE skillsid='$skills_id'";
	    $conn->query($sql);
	}

	if($_POST['method']=="classabout_getdetails"){
		$output = array();

	    $classid = $_POST['classid'];
	    $sectionid = $_POST['sectionid'];
	    $uid = $_POST['uid'];

	    $sql = "SELECT * FROM student_csdetails where classid='$classid' and sectionid='$sectionid' and uid='$uid' limit 1";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	$output['classname'] = $row['classname'];
	    	$output['sectionname'] = $row['sectionname'];
	    	$output['session'] = $row['session'];
	    	$output['classteacher'] = $row['classteacher'];
	    	$output['academiccoordinator'] = $row['academiccoordinator'];
	    	$output['principal'] = $row['principal'];
	    	if($row['dp']==""){
		    	$output['dp'] = "";
	    	}else{
		    	$output['dp'] = $row['dp'];
	    	}
	    }
	    header('Content-Type: application/json');
	    echo json_encode($output);
	}	

	if($_POST['method']=="classabout_update"){
	    $classid = $_POST['classid'];
	    $sectionid = $_POST['sectionid'];
	    $uid = $_POST['uid'];

	    $classabout_classname = $_POST['classabout_classname'];
	    $classabout_sectionname = $_POST['classabout_sectionname'];
	    $classabout_session = $_POST['classabout_session'];
	    $classabout_classteacher = $_POST['classabout_classteacher'];
	    $classabout_academiccoordinator = $_POST['classabout_academiccoordinator'];
	    $classabout_principal = $_POST['classabout_principal'];


		$target_file = "../images/classdp/".md5($classid.$sectionid.$uid).".jpg";
		if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		    $dp = md5($classid.$sectionid.$uid);
		} else {
		    $dp = "";
		}
		
		if($dp==""){
			$sql = "UPDATE student_csdetails SET classname='$classabout_classname',sectionname='$classabout_sectionname',session='$classabout_session',classteacher='$classabout_classteacher',academiccoordinator='$classabout_academiccoordinator',principal='$classabout_principal' where classid='$classid' and sectionid='$sectionid' and uid='$uid'";
		}else{
			$sql = "UPDATE student_csdetails SET classname='$classabout_classname',sectionname='$classabout_sectionname',session='$classabout_session',classteacher='$classabout_classteacher',academiccoordinator='$classabout_academiccoordinator',principal='$classabout_principal',dp='$dp' where classid='$classid' and sectionid='$sectionid' and uid='$uid'";
		}
    	$conn->query($sql);  

	}

	if($_POST['method']=="images_getdetails"){
		$output = array();
		$input = array();
		$response = array();
	    $studentid = $_POST['studentid'];

	    $sql = "SELECT * FROM student_gallery where studentid='$studentid'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	while($row = $result->fetch_assoc()){
	    		$output['imagesname'] = $row['imagesname'];
	    		$output['imagesdescription'] = $row['imagesdescription'];
	    		$output['imagesdate'] = $row['date'];
	    		$output['imagesid'] = $row['imagesid'];

		    	if($row['dp']==""){
			    	$output['imagesdp'] = "";
		    	}else{
		    		$output['imagesdp'] = $row['dp'];
		    	}
	    		
		    	array_push($input,$output);	
	    	}
	    }
	    $response['noofimages']=$result->num_rows;
	    $response['images'] = $input;
	    header('Content-Type: application/json');
	    echo json_encode($response);
	}

	if($_POST['method']=="images_delete"){
	    $images_id = $_POST['images_id'];

	    $sql = "DELETE FROM student_gallery WHERE imagesid='$images_id'";
	    $conn->query($sql);
	}

	if($_POST['method']=="images_save"){
	    $studentid = $_POST['studentid'];
	    $images_name = $_POST['images_name'];
	    $images_description = $_POST['images_description'];
	    $images_date = $_POST['images_date'];
	    $noofrecords = 0;

	    $sql = "SELECT * FROM student_gallery WHERE studentid='$studentid'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	$noofrecords = $result->num_rows;
	    }else{
	    	$noofrecords = 0;
	    }
	    $noofrecords = $noofrecords + 1;

	    $target_file = "../images/gallery/".md5($studentid).$noofrecords.".jpg";
		if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		    $dp = md5($studentid).$noofrecords;
		} else {
		    $dp = "";
		}

	    $sql = "INSERT INTO student_gallery(imagesid,studentid,imagesname,imagesdescription,date,dp)VALUES(DEFAULT,'$studentid','$images_name','$images_description','$images_date','$dp')";
	    $conn->query($sql);
	}

	if($_POST['method']=="images_update"){
	    $studentid = $_POST['studentid'];
	    $images_name = $_POST['images_name'];
	    $images_description = $_POST['images_description'];
	    $images_date = $_POST['images_date'];
	    $images_id = $_POST['images_id'];

	    $sql = "SELECT * FROM student_gallery WHERE imagesid='$images_id'";
	    $result = $conn->query($sql);
	    if($result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	$name = $row['dp'];
	    }else{
	    }
	    if($name==""){
	    	$sql = "Select * from student_gallery where studentid='$studentid'";
	    	$result=$conn->query($sql);
	    	if($result->num_rows > 0){
	    		$no = 1;
	    		$finalno = 0;
		    	while($rowdummy = $result->fetch_assoc()){
		    		if($rowdummy['imagesid']==$images_id){
			    		$name = md5($studentid).$no;
		    		}else{
			    		$no = $no + 1;
		    		}
		    	}
	    	}
	    }

	    $target_file = "../images/gallery/".$name.".jpg";
		if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		    $dp = $name;
		} else {
		    $dp = "";
		}
		if($dp==""){
			$sql = "UPDATE student_gallery SET imagesname='$images_name', imagesdescription='$images_description', date='$images_date' where imagesid='$images_id'";
		}else{
			$sql = "UPDATE student_gallery SET imagesname='$images_name', imagesdescription='$images_description', date='$images_date', dp='$dp' where imagesid='$images_id'";
		}
	    $conn->query($sql);
	}


	if($_POST['method']=="profile_update"){
		$uid = $_COOKIE['teacher_id'];
	    $profile_name = $_POST['profile_name'];
	    $profile_username = $_POST['profile_username'];
	    $profile_password = $_POST['profile_password'];

		$target_file = "../images/teacher/".md5($uid).".jpg";
		if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		    $dp = md5($uid);
		} else {
		    $dp = "";
		}
		
		if($dp==""){
			$sql = "UPDATE teacher_entry SET name='$profile_name',username='$profile_username',password='$profile_password' where uid='$uid'";
		}else{
			$sql = "UPDATE teacher_entry SET name='$profile_name',username='$profile_username',password='$profile_password',dp='$dp' where uid='$uid'";
		}
    	$conn->query($sql);  

	}

}
 ?>
