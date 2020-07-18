<?php include_once('../includes/dbcon.php'); ?>

<?php 
$sql = "SELECT * FROM admin_members order by adminid limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0){
	$row=$result->fetch_assoc();
}

	?>
	<div class="col-lg-12">
	<div class="row">
	  <div class="col-lg-12">
	    <table style="width:100%;">

	      <tr>
	        <td>Username: 
	        </td>
	        <td>
	          <input type="text" id="profile_username" class="form-control" placeholder="Enter Your Username..." value="<?php echo $row['username']; ?>">
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
	        <td>Old Password: 
	        </td>
	        <td>
	          <input type="text" id="profile_oldpassword" class="form-control" placeholder="Enter Your Old Password...">
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
	        <td>New Password: 
	        </td>
	        <td>
	          <input type="password" id="profile_newpassword" class="form-control" placeholder="Enter New Password...">
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
	        <td>Confirm New Password: 
	        </td>
	        <td>
	          <input type="password" id="profile_confirmnewpassword" class="form-control" placeholder="Confirm New Password...">
	        </td>
	      </tr>
	    </table>
	  </div>
	</div>
	</div>
	<?php 

 ?>