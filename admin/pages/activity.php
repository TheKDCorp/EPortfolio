<?php include_once('../created/header.php'); ?>
<?php include_once('../created/sidebar.php'); ?>
<?php include_once('../created/pageheader.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>


<?php 
$uid = $_COOKIE['teacher_id'];
$sql = "SELECT * FROM activity";
$result = $conn->query($sql);
?>

<style>
.modal-contentaddactivity {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeaddactivity{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeaddactivity:hover,
  .closeaddactivity:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-contenteditactivity {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeeditactivity{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeeditactivity:hover,
  .closeeditactivity:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>

<script>
  var valperformdelete;
  function addnewactivity(){
    var modal = document.getElementById('addactivitymodal');
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeaddactivity")[0];
    span.onclick = function() {
      modal.style.display = "none";
    }
    modal.style.display = "block";
  }

function performactivity_addnew(){
    var activity_name = $("#activity_name").val();
    var activity_quality1 = $("#activity_quality1").val();
    var activity_quality2 = $("#activity_quality2").val();
    var activity_quality3 = $("#activity_quality3").val();
    var activity_quality4 = $("#activity_quality4").val();
    var activity_quality5 = $("#activity_quality5").val();
    var activity_quality6 = $("#activity_quality6").val();
    var activity_quality7 = $("#activity_quality7").val();
    var activity_quality8 = $("#activity_quality8").val();
    var activity_quality9 = $("#activity_quality9").val();
    var activity_quality10 = $("#activity_quality10").val();
    if (activity_name == ""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Activity Name Cannot Be Empty!!!");
      error = "true";
    }else if (activity_quality1 == "" && activity_quality2 == ""&& activity_quality3 == ""&& activity_quality4 == ""&& activity_quality5 == ""&& activity_quality6 == ""&& activity_quality7 == ""&& activity_quality8 == ""&& activity_quality9 == ""&& activity_quality10 == ""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Quality Can't be Empty!!!");
      error = "true";
    }
    else{
      error = "false";
      if(error=="false"){
          $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {
            method: 'activity_addnew',ac_name:activity_name,ac_quality1: activity_quality1,ac_quality2: activity_quality2,ac_quality3: activity_quality3,ac_quality4: activity_quality4,ac_quality5: activity_quality5,ac_quality6: activity_quality6,ac_quality7: activity_quality7,ac_quality8: activity_quality8,ac_quality9: activity_quality9,ac_quality10: activity_quality10,}
          ,
          success: function(data) {
            var modal = document.getElementById('addmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeadd")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#activity_name").val("");
            $("#activity_quality1").val("");
            $("#activity_quality2").val("");
            $("#activity_quality3").val("");
            $("#activity_quality4").val("");
            $("#activity_quality5").val("");
            $("#activity_quality6").val("");
            $("#activity_quality7").val("");
            $("#activity_quality8").val("");
            $("#activity_quality9").val("");
            $("#activity_quality10").val("");
            refreshtable();
          }
        }
              );
      }
    }
  }

  function editme(cid){
    var activityid = cid;
    if(activityid!=""){
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          method: 'activity_getdetails',acid:activityid}
        ,
        success: function(data) {
          $("#editactivity_name").val("");
          $("#editactivity_id").val("");
          $("#editactivity_quality1").val("");
          $("#editactivity_quality2").val("");
          $("#editactivity_quality3").val("");
          $("#editactivity_quality4").val("");
          $("#editactivity_quality5").val("");
          $("#editactivity_quality6").val("");
          $("#editactivity_quality7").val("");
          $("#editactivity_quality8").val("");
          $("#editactivity_quality9").val("");
          $("#editactivity_quality10").val("");


          var editactivity_name = data.name;
          var editactivity_id = activityid;
          var editactivity_quality1 = data.quality1;
          var editactivity_quality2 = data.quality2;
          var editactivity_quality3 = data.quality3;
          var editactivity_quality4 = data.quality4;
          var editactivity_quality5 = data.quality5;
          var editactivity_quality6 = data.quality6;
          var editactivity_quality7 = data.quality7;
          var editactivity_quality8 = data.quality8;
          var editactivity_quality9 = data.quality9;
          var editactivity_quality10 = data.quality10;

          $("#editactivity_name").val(editactivity_name);
          $("#editactivity_id").val(editactivity_id);
          $("#editactivity_quality1").val(editactivity_quality1);
          $("#editactivity_quality2").val(editactivity_quality2);
          $("#editactivity_quality3").val(editactivity_quality3);
          $("#editactivity_quality4").val(editactivity_quality4);
          $("#editactivity_quality5").val(editactivity_quality5);
          $("#editactivity_quality6").val(editactivity_quality6);
          $("#editactivity_quality7").val(editactivity_quality7);
          $("#editactivity_quality8").val(editactivity_quality8);
          $("#editactivity_quality9").val(editactivity_quality9);
          $("#editactivity_quality10").val(editactivity_quality10);

          var modal = document.getElementById('editactivitymodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeeditactivity")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
        }
      }
            );
    }
    else{

    }
  }

  function performactivity_update(){
    var editactivityid = $("#editactivity_id").val();
    var editactivityname = $("#editactivity_name").val();
    var editactivity_quality1 = $("#editactivity_quality1").val();
    var editactivity_quality2 = $("#editactivity_quality2").val();
    var editactivity_quality3 = $("#editactivity_quality3").val();
    var editactivity_quality4 = $("#editactivity_quality4").val();
    var editactivity_quality5 = $("#editactivity_quality5").val();
    var editactivity_quality6 = $("#editactivity_quality6").val();
    var editactivity_quality7 = $("#editactivity_quality7").val();
    var editactivity_quality8 = $("#editactivity_quality8").val();
    var editactivity_quality9 = $("#editactivity_quality9").val();
    var editactivity_quality10 = $("#editactivity_quality10").val();

    if(editactivityid!=""){
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          method: 'activity_update',acid:editactivityid,name:editactivityname,quality1:editactivity_quality1,quality2:editactivity_quality2,quality3:editactivity_quality3,quality4:editactivity_quality4,quality5:editactivity_quality5,quality6:editactivity_quality6,quality7:editactivity_quality7,quality8:editactivity_quality8,quality9:editactivity_quality9,quality10:editactivity_quality10}
        ,
        success: function(data) {
          var modal = document.getElementById('addmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeadd")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          $("#addmodaltext").text("Record Updated Successfully!!!");
        }
      }
            );
    }
    else{

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
      data: {method: 'activity_delete',acid:valperformdelete},
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
            <h3 class="content-header-title">Activity Details</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Activity Details
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
			          <h4 class="card-title">Activity Entry
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
			              <code>Add Activity
			              </code> button to Create a New Activity.
			            </span>
			            <a class="btn btn-primary" onclick="addnewactivity();" style="color:white;float:right;">
			              <i class="ft-user-plus">
			              </i>&nbspAdd Activity
			            </a>
			          </div>
			          <fieldset class="form-group">
			          </fieldset>
			        </div>
			      </div>

					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Activity List</h4>
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
							                <th>Activity ID
							                </th>
							                <th>Activity Name
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
											$name = str_replace("_"," ",$row['activityname']);
											?>
											
											<tr>
												<td><?php echo $srno; ?></td>
												<td style='width:62%;'><?php echo $name; ?></td>
												<td style='width:30%;'>
													<a class='btn btn-warning' style='color:white;' onclick='editme(<?php echo $row['activityid']; ?>);'><i class="ft-edit-2"></i>&nbspEdit</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
													<a class='btn btn-danger' style='color:white;' onclick='deleteme(<?php echo $row['activityid']; ?>);'><i class="ft-delete"></i>&nbspDelete</a></td>
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
<div id="addactivitymodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentaddactivity">
    <span class="closeaddactivity">&times;
    </span>
    <p>Add New Activity...
    </p>
    <hr>
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
              <input type="text" id="activity_name" class="form-control" placeholder="Enter Activity Name...">
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
            <td>Quality 1: 
            </td>
            <td>
              <input type="text" id="activity_quality1" class="form-control" placeholder="Enter Quality 1 Name...">
            </td>
          </tr>
                    <tr>
            <td>Quality 2: 
            </td>
            <td>
              <input type="text" id="activity_quality2" class="form-control" placeholder="Enter Quality 2 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 3: 
            </td>
            <td>
              <input type="text" id="activity_quality3" class="form-control" placeholder="Enter Quality 3 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 4: 
            </td>
            <td>
              <input type="text" id="activity_quality4" class="form-control" placeholder="Enter Quality 4 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 5: 
            </td>
            <td>
              <input type="text" id="activity_quality5" class="form-control" placeholder="Enter Quality 5 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 6: 
            </td>
            <td>
              <input type="text" id="activity_quality6" class="form-control" placeholder="Enter Quality 6 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 7: 
            </td>
            <td>
              <input type="text" id="activity_quality7" class="form-control" placeholder="Enter Quality 7 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 8: 
            </td>
            <td>
              <input type="text" id="activity_quality8" class="form-control" placeholder="Enter Quality 8 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 9: 
            </td>
            <td>
              <input type="text" id="activity_quality9" class="form-control" placeholder="Enter Quality 9 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 10: 
            </td>
            <td>
              <input type="text" id="activity_quality10" class="form-control" placeholder="Enter Quality 10 Title...">
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performactivity_addnew();" class="btn btn-primary" style="color:white;">Submit
        </a>
      </div>
    </div>
  </div>
</div>

<div id="editactivitymodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contenteditactivity">
    <span class="closeeditactivity">&times;
    </span>
    <p>Update Activity...
    </p>
    <hr>
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
              <input type="text" id="editactivity_name" class="form-control" placeholder="Enter Activity Name...">
              <input type="hidden" id="editactivity_id" class="form-control">
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
            <td>Quality 1: 
            </td>
            <td>
              <input type="text" id="editactivity_quality1" class="form-control" placeholder="Enter Quality 1 Name...">
            </td>
          </tr>
                    <tr>
            <td>Quality 2: 
            </td>
            <td>
              <input type="text" id="editactivity_quality2" class="form-control" placeholder="Enter Quality 2 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 3: 
            </td>
            <td>
              <input type="text" id="editactivity_quality3" class="form-control" placeholder="Enter Quality 3 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 4: 
            </td>
            <td>
              <input type="text" id="editactivity_quality4" class="form-control" placeholder="Enter Quality 4 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 5: 
            </td>
            <td>
              <input type="text" id="editactivity_quality5" class="form-control" placeholder="Enter Quality 5 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 6: 
            </td>
            <td>
              <input type="text" id="editactivity_quality6" class="form-control" placeholder="Enter Quality 6 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 7: 
            </td>
            <td>
              <input type="text" id="editactivity_quality7" class="form-control" placeholder="Enter Quality 7 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 8: 
            </td>
            <td>
              <input type="text" id="editactivity_quality8" class="form-control" placeholder="Enter Quality 8 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 9: 
            </td>
            <td>
              <input type="text" id="editactivity_quality9" class="form-control" placeholder="Enter Quality 9 Title...">
            </td>
          </tr>
                    <tr>
            <td>Quality 10: 
            </td>
            <td>
              <input type="text" id="editactivity_quality10" class="form-control" placeholder="Enter Quality 10 Title...">
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performactivity_update();" class="btn btn-primary" style="color:white;">Submit
        </a>
      </div>
    </div>
  </div>
</div>

<script>

  function refreshtable(){
    $.get("activitytable.php", function( data ) {
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

    var modal = document.getElementById('editactivitymodal');
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