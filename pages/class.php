<?php include_once('../created/header.php'); ?>
<?php include_once('../created/sidebar.php'); ?>
<?php include_once('../created/pageheader.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>


<?php 
$uid = $_COOKIE['teacher_id'];
$sql = "SELECT * FROM class_entry where uid='$uid'";
$result = $conn->query($sql);
?>

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Class Details</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Class Details
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
							<h4 class="card-title">Class Entry</h4>
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
								<p class="card-text">Enter the <code>Name</code> of the Class to Add it into the Database & Table.</p>
							</div>
							<fieldset class="form-group">
	                          <input type="text" class="form-control" id="classname" placeholder="Enter Class Name..." style="display:inline;width:90%;margin-left:1em;">
	                          <a class="btn btn-primary" onclick="addnewclass();" style="color:white;"><i class="ft-check"></i>&nbspSubmit</a>
	                      </fieldset>
						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Class Selection</h4>
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
								<p class="card-text">Select the <code>Class Name</code> To Go To Next Step.</p>
							</div>
							<div class="table-responsive" id="ctable">
								<table class="table table-striped table-hover" id="example">
									<thead>
										<tr>
							                <th>Class ID
							                </th>
							                <th>Class Name
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
											$name = str_replace("_"," ",$row['classname']);
											?>
											
											<tr>
												<td onclick="gotosection(<?php echo $row['cid']; ?>);"><?php echo $srno; ?></td>
												<td style='width:62%;' onclick="gotosection(<?php echo $row['cid']; ?>);"><?php echo $name; ?></td>
												<td style='width:30%;'>
													<a class='btn btn-info' style='color:white;' onclick='gotosection(<?php echo $row['cid']; ?>);'><i class="ft-check"></i>&nbspSelect</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
													<a class='btn btn-warning' style='color:white;' onclick='editme(<?php echo $row['cid']; ?>,"<?php echo $name; ?>");'><i class="ft-edit-2"></i>&nbspEdit</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
													<a class='btn btn-danger' style='color:white;' onclick='deleteme(<?php echo $row['cid']; ?>);'><i class="ft-delete"></i>&nbspDelete</a></td>
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


<script>

	function refreshtable(){
		$.get("classtable.php", function( data ) {
		  $( "#ctable" ).html("");
		  $( "#ctable" ).html(data);
		});
	}


	// $(document).ready(function() {
	//      setInterval(function () {
	//         refreshtable();
	//     },5000);
	// });

	var valperformdelete = "";
	var valperformupdate = "";
	function gotosection(cid){
		window.location.href="./section.php?class=" + cid;
	}
	function editme(cid,cname){
		valperformupdate = cid;
		// alert(cid);
		// Get the modal
		var modal = document.getElementById('editmodal');

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("closeedit")[0];
	  	
	  	modal.style.display = "block";
	  	var classvalue = $("#classname").val();
	  	$("#updateclassbox").val(cname);

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

	function performupdate(){
		var myuid = <?php echo $uid; ?>;
		var clname = $("#updateclassbox").val();
		var modal = document.getElementById('editmodal');
		modal.style.display = "none";
		$.ajax({
		  type: 'post',
		  url: 'ajax.php',
		  data: {method: 'updateclass',classid:valperformupdate,uid:myuid,classname:clname},
		  success: function(data) {
			var modal = document.getElementById('editsuccessmodal');

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("closeeditsuccess")[0];
		  	span.onclick = function() {
			  modal.style.display = "none";
			}
		  	modal.style.display = "block";
		  	refreshtable();
		  }
		});
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
		var myuid = <?php echo $uid; ?>;

		var modal = document.getElementById('deletemodal');
		modal.style.display = "none";
		$.ajax({
		  type: 'post',
		  url: 'ajax.php',
		  data: {method: 'deleteclass',classid:valperformdelete,uid:myuid},
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