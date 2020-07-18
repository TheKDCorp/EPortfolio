<?php include_once('../created/header.php'); ?>
<?php include_once('../created/sidebar.php'); ?>
<?php include_once('../created/pageheader.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>


<?php 
$uid = $_COOKIE['teacher_id'];
$sql = "SELECT * FROM teacher_entry where uid='$uid'";
$result = $conn->query($sql);
if($result->num_rows > 0){
	$row=$result->fetch_assoc();
}
?>

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Teacher Profile</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Teacher Details
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
			<!-- Striped rows start -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Update Profile</h4>
							<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
									<!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
									<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
									<!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
								</ul>
							</div>
						</div>
						<div class="card-content collapse show">
							<div class="card-body">
								<p class="card-text">Enter the <code>Details</code> and Click on <code>Submit</code> to Add it into the Database & Table.</p>
								<hr>
								<div class="row" id="profiledetails">
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
							    </div>
			                    <hr>
			                    <div style="text-align:right;">
			                    	<a class="btn btn-primary" onclick="updateprofile();" style="color:white;"><i class="ft-check"></i>&nbspSubmit</a>
			                    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Striped rows end -->
        </div>


<script>

	function refreshtable(){
		$.get("profilelist.php", function( data ) {
		  $( "#profiledetails" ).html("");
		  $( "#profiledetails" ).html(data);
		});
	}


	// $(document).ready(function() {
	//      setInterval(function () {
	//         refreshtable();
	//     },5000);
	// });

	 function updateprofile(){
	    var name = $("#profile_name").val();
	    var username = $("#profile_username").val();
	    var password = $("#profile_password").val();

	    if (username == "" || name==""){
	      var modal = document.getElementById('blankmodal');
	      // Get the <span> element that closes the modal
	      var span = document.getElementsByClassName("closeblank")[0];
	      span.onclick = function() {
	        modal.style.display = "none";
	      }
	      modal.style.display = "block";
	      $("#blankmodaltext").text("Name or Username Cannot Be Empty!!!");
	    }
	    else{
	      var fd = new FormData();
	      fd.append('method',"profile_update");
	      fd.append('profile_name',name);
	      fd.append('profile_username',username);
	      fd.append('profile_password',password);
	      var files = $('#profile_dp')[0].files[0];
	      fd.append('dp',files);
	      $.ajax({
	        url: 'ajax.php',
	        type: 'post',
	        data: fd,
	        contentType: false,
	        processData: false,
	        success: function(data){
	          var modal = document.getElementById('addmodal');
	          // Get the <span> element that closes the modal
	          var span = document.getElementsByClassName("closeadd")[0];
	          span.onclick = function() {
	            modal.style.display = "none";
	          }
	          modal.style.display = "block";
	          $("#addmodaltext").text("Record Updated Successfully!!!");
	          $("#profile_name").val("");
	          $("#profile_username").val("");
	          $("#profile_password").val("");
	          refreshtable();
	        }
	        ,
	      }
	            );
	    }

	  }
</script>

<?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>