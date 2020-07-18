<?php include_once('../created/header.php'); ?>
<?php include_once('../created/sidebar.php'); ?>
<?php include_once('../created/pageheader.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>


<?php 
$sql = "SELECT * FROM teacher_entry";
$result = $conn->query($sql);
?>

<style>
.modal-contentaddteacher {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeaddteacher{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeaddteacher:hover,
  .closeaddteacher:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-contenteditteacher {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeeditteacher{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeeditteacher:hover,
  .closeeditteacher:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>

<script>
  var valperformdelete;

  function refreshtable(){
    $.get("teachertable.php", function( data ) {
      $( "#ctable" ).html("");
      $( "#ctable" ).html(data);
    });
  }


  $(document).ready(function() {
       setInterval(function () {
          refreshtable();
      },5000);
  });

    function performcancel(){
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

    var modal = document.getElementById('addteachermodal');
    modal.style.display = "none";

    var modal = document.getElementById('editteachermodal');
    modal.style.display = "none";
  }

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

  function addnewteacher(){
    var modal = document.getElementById('addteachermodal');
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeaddteacher")[0];
    span.onclick = function() {
      modal.style.display = "none";
    }
    modal.style.display = "block";
  }

function performteacher_addnew(){
    var teacher_name = $("#teacher_name").val();
    var teacher_username = $("#teacher_username").val();
    var teacher_password = $("#teacher_password").val();

    if (teacher_name == ""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Teacher Name Cannot Be Empty!!!");
      error = "true";
    }else if(teacher_username==""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Username Cannot Be Empty!!!");
      error = "true";
    }else if(teacher_password==""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Password Cannot Be Empty!!!");
      error = "true";
    }else{
      error = "false";
      var fd = new FormData();
      fd.append('method',"teacher_addnew");
      fd.append('teacher_name',teacher_name);
      fd.append('teacher_username',teacher_username);
      fd.append('teacher_password',teacher_password);
      var files = $('#teacher_dp')[0].files[0];
      fd.append('dp',files);
      $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(data){
          $("#teacher_name").val("");
          $("#teacher_username").val("");
          $("#teacher_password").val("");
          $("#teacher_dp").val("");

          performcancel();
          addnewteacher();
          var modal = document.getElementById('addmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeadd")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          $("#addmodaltext").text("Record Added Successfully!!!");
        }
        ,
      }
            );
    }
  }

  function editme(cid){
    var teacherid = cid;
    if(teacherid!=""){
      var fd = new FormData();
      fd.append('method',"teacher_getdetails");
      fd.append('tcid',teacherid);
      $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(data){
          $("#editteacher_name").val("");
          $("#editteacher_id").val("");
          $("#editteacher_username").val("");
          $("#editteacher_password").val("");
          $("#editteacher_dp").val("");

          var editteacher_name = data.name;
          var editteacher_id = data.uid;
          var editteacher_username = data.username;
          var editteacher_password = data.password;
          var editteacher_dp = data.dp;

          $("#editteacher_name").val(editteacher_name);
          $("#editteacher_id").val(editteacher_id);
          $("#editteacher_username").val(editteacher_username);
          $("#editteacher_password").val(editteacher_password);

          if(editteacher_dp==""){
            $("#editteacher_image").attr("src","../images/profile.jpg");
          }else{
            $("#editteacher_image").attr("src","../../images/teacher/"+editteacher_dp+".jpg");
          }

          var modal = document.getElementById('editteachermodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeeditteacher")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
        }
        ,
      }
            );
    }
    else{

    }
  }

  function performteacher_update(){
    var editteacher_id = $("#editteacher_id").val();
    var editteacher_name = $("#editteacher_name").val();
    var editteacher_username = $("#editteacher_username").val();
    var editteacher_password = $("#editteacher_password").val();

    if (editteacher_name == ""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Teacher Name Cannot Be Empty!!!");
      error = "true";
    }else if(editteacher_username==""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Username Cannot Be Empty!!!");
      error = "true";
    }else if(editteacher_password==""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Password Cannot Be Empty!!!");
      error = "true";
    }else{
      error = "false";
      var fd = new FormData();
      fd.append('method',"teacher_update");
      fd.append('teacher_id',editteacher_id);
      fd.append('teacher_name',editteacher_name);
      fd.append('teacher_username',editteacher_username);
      fd.append('teacher_password',editteacher_password);
      var files = $('#editteacher_dp')[0].files[0];
      fd.append('dp',files);
      $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(data){
          performcancel();
          editme(editteacher_id);

          var modal = document.getElementById('addmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeadd")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          $("#addmodaltext").text("Record Updated Successfully!!!");
        }
        ,
      }
            );
    }
  }

  function deleteme(cid){
    valperformdelete = cid;
    // alert(cid);
    // Get the modal
    var modal = document.getElementById('deletemodal');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closedelete")[0];
      
      modal.style.display = "block";

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }

  function performdelete(){
    var modal = document.getElementById('deletemodal');
    modal.style.display = "none";
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {method: 'teacher_delete',tcid:valperformdelete},
      success: function(data) {
      var modal = document.getElementById('deletesuccessmodal');

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closedeletesuccess")[0];
        span.onclick = function() {
        modal.style.display = "none";
      }
        modal.style.display = "block";
        refreshtable();
      }
    });
  }
</script>

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Teacher Entry</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Teacher Entry
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
			          <h4 class="card-title">Teacher Entry
			          </h4>
			          <a class="heading-elements-toggle">
			            <i class="la la-ellipsis-v font-medium-3">
			            </i>
			          </a>
			          <div class="heading-elements">
			            <ul class="list-inline mb-0">
			              <li>
			                <a data-action="collapse">
			                  <i class="ft-minus">
			                  </i>
			                </a>
			              </li>
			              <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
			              <!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
			              <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
			            </ul>
			          </div>
			        </div>
			        <div class="card-content collapse show">
			          <div class="card-body">
			            <span class="card-text">Click the 
			              <code>Add Teacher
			              </code> button to Create a New Teacher.
			            </span>
			            <a class="btn btn-primary" onclick="addnewteacher();" style="color:white;float:right;">
			              <i class="ft-user-plus">
			              </i>&nbspAdd Teacher
			            </a>
			          </div>
			          <fieldset class="form-group">
			          </fieldset>
			        </div>
			      </div>

					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Teacher List</h4>
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
							<div class="table-responsive" id="ctable">
								<table class="table table-striped table-hover" id="example">
									<thead>
										<tr>
			                <th>Teacher ID
			                </th>
			                <th>Name
			                </th>
                      <th>Username
                      </th>
			                <th>Functions
			                </th>
				            </tr>
									</thead>
									<tbody>
										<?php 
											if ($result->num_rows > 0) {
											$srno ="0";
											while($row = $result->fetch_assoc()) {
											$srno = $srno + 1;
											$name = str_replace("_"," ",$row['name']);
											?>
											
											<tr>
												<td><?php echo $srno; ?></td>
												<td style='width:30%;'><?php echo $name; ?></td>
                        <td style='width:30%;'><?php echo $row['username']; ?></td>
												<td style='width:30%;'>
													<a class='btn btn-warning' style='color:white;' onclick='editme(<?php echo $row['uid']; ?>);'><i class="ft-edit-2"></i>&nbspEdit</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
													<a class='btn btn-danger' style='color:white;' onclick='deleteme(<?php echo $row['uid']; ?>);'><i class="ft-delete"></i>&nbspDelete</a></td>
											</tr>
											<?php
											}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Striped rows end -->
    </div>
<!-- The Edit Modal -->
<div id="addteachermodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentaddteacher">
    <span class="closeaddteacher">&times;
    </span>
    <p>Add New Teacher...
    </p>
    <hr>
    <div class="row">
      <div class="col-lg-10">
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
              <input type="text" id="teacher_name" class="form-control" placeholder="Enter Teacher Name...">
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
            <td>Username: 
            </td>
            <td>
              <input type="text" id="teacher_username" class="form-control" placeholder="Enter Username...">
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
              <input type="password" id="teacher_password" class="form-control" placeholder="Enter Password...">
            </td>
          </tr>
        </table>
      </div>
      <div class="col-lg-2">
        <img src="../images/profile.jpg" alt="Image Unavailable!!!" id="teacher_image" style="width:100%;height:15em;">
        <input type="file" class="form-control" id="teacher_dp">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performteacher_addnew();" class="btn btn-primary" style="color:white;">Submit
        </a>
      </div>
    </div>
  </div>
</div>

<div id="editteachermodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contenteditteacher">
    <span class="closeeditteacher">&times;
    </span>
    <p>Update Teacher Details...
    </p>
    <hr>
    <div class="row">
      <div class="col-lg-10">
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
              <input type="text" id="editteacher_name" class="form-control" placeholder="Enter Teacher Name...">
              <input type="hidden" id="editteacher_id" class="form-control">
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
            <td>Username: 
            </td>
            <td>
              <input type="text" id="editteacher_username" class="form-control" placeholder="Enter Username...">
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
              <input type="password" id="editteacher_password" class="form-control" placeholder="Enter Password...">
            </td>
          </tr>
        </table>
      </div>
      <div class="col-lg-2">
        <img src="../images/profile.jpg" alt="Image Unavailable!!!" id="editteacher_image" style="width:100%;height:15em;">
        <input type="file" class="form-control" id="editteacher_dp">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performteacher_update();" class="btn btn-primary" style="color:white;">Submit
        </a>
      </div>
    </div>
  </div>
</div>

<script>
	 function addnewclass(){
	    var classname = $("#classname").val();
	    var myuid = <?php echo $uid; ?>;

	    if (classname == ""){
			var modal = document.getElementById('blankmodal');

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("closeblank")[0];
		  	span.onclick = function() {
			  modal.style.display = "none";
			}

		  	modal.style.display = "block";
	    }else{
	    	$.ajax({
			  type: 'post',
			  url: 'ajax.php',
			  data: {method: 'addclass',classname:classname,uid:myuid},
			  success: function(data) {
				var modal = document.getElementById('addmodal');

				// Get the <span> element that closes the modal
				var span = document.getElementsByClassName("closeadd")[0];
			  	span.onclick = function() {
				  modal.style.display = "none";
				}
			  	modal.style.display = "block";

			  	$("#classname").val("");

			  	refreshtable();

			  }
			});
	    }
	  }
</script>

<?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>