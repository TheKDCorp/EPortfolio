<?php include_once('../created/header.php'); ?>
<?php include_once('../created/sidebar.php'); ?>
<?php include_once('../created/pageheader.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>


<?php 
$sql = "SELECT * FROM admin_members order by adminid limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0){
	$row=$result->fetch_assoc();
}
?>

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Change Password</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Change Password
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
							<h4 class="card-title">Change Password</h4>
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
								<p class="card-text">Enter the <code>Fields Carefully</code> and Click on <code>Submit</code> to Update it into the Database & Table.</p>
								<hr>
								<div class="row" id="profiledetails">
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
							              </tr><tr>
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


  function performcancelok(){
    var modal = document.getElementById('deletemodal');
    modal.style.display = "none";

    var modal = document.getElementById('addmodal');
    modal.style.display = "none";

    var modal = document.getElementById('blankmodal');
    modal.style.display = "none";

    var modal = document.getElementById('deletesuccessmodal');
    modal.style.display = "none";

    var modal = document.getElementById('editmodal');
    modal.style.display = "none";

    var modal = document.getElementById('editsuccessmodal');
    modal.style.display = "none";
  }

	 function updateprofile(){
	    var username = $("#profile_username").val();
	    var oldpassword = $("#profile_oldpassword").val();
	    var newpassword = $("#profile_newpassword").val();
	    var confirmnewpassword = $("#profile_confirmnewpassword").val();

	    if(oldpassword == ""){
		  var modal = document.getElementById('blankmodal');
	      // Get the <span> element that closes the modal
	      var span = document.getElementsByClassName("closeblank")[0];
	      span.onclick = function() {
	        modal.style.display = "none";
	      }
	      modal.style.display = "block";
	      $("#blankmodaltext").text("New Password cannot be blank!!!");
	    }else if(newpassword == ""){
	    	var modal = document.getElementById('blankmodal');
	      // Get the <span> element that closes the modal
	      var span = document.getElementsByClassName("closeblank")[0];
	      span.onclick = function() {
	        modal.style.display = "none";
	      }
	      modal.style.display = "block";
	      $("#blankmodaltext").text("New Password cannot be blank!!!");
	    }else if(confirmnewpassword == ""){
	    	var modal = document.getElementById('blankmodal');
	      // Get the <span> element that closes the modal
	      var span = document.getElementsByClassName("closeblank")[0];
	      span.onclick = function() {
	        modal.style.display = "none";
	      }
	      modal.style.display = "block";
	      $("#blankmodaltext").text("Confirm New Password cannot be blank!!!");
	    }else if (newpassword != confirmnewpassword){
	      var modal = document.getElementById('blankmodal');
	      // Get the <span> element that closes the modal
	      var span = document.getElementsByClassName("closeblank")[0];
	      span.onclick = function() {
	        modal.style.display = "none";
	      }
	      modal.style.display = "block";
	      $("#blankmodaltext").text("New Password and Confirm Password does not match!!!");
	    }
	    else{
	      var fd = new FormData();
	      fd.append('method',"adminprofile_update");
	      fd.append('profile_username',username);
	      fd.append('profile_oldpassword',oldpassword);
	      fd.append('profile_newpassword',newpassword);
	      $.ajax({
	        url: 'ajax.php',
	        type: 'post',
	        data: fd,
	        contentType: false,
	        processData: false,
	        success: function(data){
	        	if(data=="no"){
			      var modal = document.getElementById('blankmodal');
			      // Get the <span> element that closes the modal
			      var span = document.getElementsByClassName("closeblank")[0];
			      span.onclick = function() {
			        modal.style.display = "none";
			      }
			      modal.style.display = "block";
			      $("#blankmodaltext").text("Please Enter Correct Old Password!!!");
	        	}else{
					var modal = document.getElementById('addmodal');
		          // Get the <span> element that closes the modal
		          var span = document.getElementsByClassName("closeadd")[0];
		          span.onclick = function() {
		            modal.style.display = "none";
		          }
		          modal.style.display = "block";
		          $("#addmodaltext").text("Record Updated Successfully!!!");
		          refreshtable();
	        	}
	        }
	        ,
	      }
	            );
	    }

	  }
</script>

<?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>