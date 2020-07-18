<?php include_once('../includes/dbcon.php'); ?>

<?php 
	$uid = $_COOKIE['teacher_id'];
	$sql = "SELECT * FROM teacher_entry where uid='$uid'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row=$result->fetch_assoc();
	}

	?>
	  <div class="col-lg-10">
	    <div class="row">
	      <div class="col-lg-12">
	        <table style="width:100%;">
	          <tr>
	            <th>
	            </th>
	            <th>
	            </th>
	          </tr>
	          <tr>
	            <td>Name: 
	            </td>
	            <td>
	              <input type="text" id="profile_name" class="form-control" placeholder="Enter Your Name..." value="<?php echo $row['name']; ?>">
	            </td>
	          </tr>
	          <tr>
	            <td>
	              <br>
	            </td>
	            <td>
	              <br>
	            </td>
	          </tr>
	          <tr>
	            <td>User Name: 
	            </td>
	            <td>
	              <input type="text" id="profile_username" class="form-control" placeholder="Enter User Name..." value="<?php echo $row['username']; ?>">
	            </td>
	          </tr>
	          <tr>
	            <td>
	              <br>
	            </td>
	            <td>
	              <br>
	            </td>
	          </tr>
	          <tr>
	            <td>Password: 
	            </td>
	            <td>
	              <input type="password" id="profile_password" class="form-control" placeholder="Enter Password Name..." value="<?php echo $row['password']; ?>">
	            </td>
	          </tr>
	        </table>
	      </div>
	    </div>
	  </div>
	  <div class="col-lg-2">
	  	<?php 
	  		if($row['dp']==""){
		        echo '<img src="../images/profile.jpg" alt="Image Unavailable!!!" id="profile_image" style="width:100%;height:15em;">';
	  		}else{
				echo '<img src="../images/teacher/'.$row['dp'].'.jpg" alt="Image Unavailable!!!" id="profile_image" style="width:100%;height:15em;">';
	  		}
	  	 ?>
	    <input type="file" class="form-control" id="profile_dp">
	  </div>
	<?php 

 ?>