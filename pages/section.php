<?php include_once('../created/header.php'); ?>
<?php include_once('../created/sidebar.php'); ?>
<?php include_once('../created/pageheader.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>


<?php 
if (isset($_SERVER['HTTP_REFERER'])) {
	  $page = basename($_SERVER['HTTP_REFERER']);
	  $page = substr($page, 0, 9);
	  if ($page == "class.php") {
	  } else {
          ?>
          <script>
          	window.location.href = "./class.php";
          </script>
          <?php
                  header('Location: ./class.php');
          exit();
	  }
  } else {
	    ?>
          <script>
          	window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
      exit();
  }

if(!isset($_GET['class'])){
?>
          <script>
          	window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
}else{
}

if(empty($_GET['class'])){
?>
          <script>
          	window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
}else{
}

$uid = $_COOKIE['teacher_id'];
$classid = $_GET['class'];

$sql = "SELECT * FROM class_entry where cid='$classid'";
$result = $conn->query($sql);
if($result->num_rows > 0){
	$row = $result->fetch_assoc();
	$classname = $row['classname'];
}else{
	$classname="";
}

$sql = "SELECT * FROM section_entry where uid='$uid' and cid='$classid'";
$result = $conn->query($sql);
?>

        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Section Details</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Section Details
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
							<h4 class="card-title">Section Entry</h4>
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
								<p class="card-text">Enter the <code>Name</code> of the Section to be Added in the <code>Choosen Class</code> Database & Table.</p>
							</div>
							<fieldset class="form-group">
	                          <input type="text" class="form-control" id="sectionname" placeholder="Enter Section Name..." style="display:inline;width:90%;margin-left:1em;">
	                          <a class="btn btn-primary" onclick="addnewsection();" style="color:white;"><i class="ft-check"></i>&nbspSubmit</a>
	                      </fieldset>
						</div>
					</div>

					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Section Selection</h4>
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
								<p class="card-text">Select the <code>Section Name</code> To Go To Next Step.</p>
							</div>
							<div class="table-responsive" id="stable">
								<table class="table table-striped table-hover" id="example">
									<thead>
										<tr>
							                <th>Section ID
							                </th>
							                <th>Section Name
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
											$name = str_replace("_"," ",$row['sectionname']);
											?>
											
											<tr>
												<td onclick="gotostudents(<?php echo $row['sid']; ?>,<?php echo $classid; ?>);"><?php echo $srno; ?></td>
												<td style='width:62%;' onclick="gotostudents(<?php echo $row['sid']; ?>,<?php echo $classid; ?>);"><?php echo $name; ?></td>
												<td style='width:30%;'>
													<a class='btn btn-info' style='color:white;' onclick='gotostudents(<?php echo $row['sid']; ?>,<?php echo $classid; ?>);'><i class="ft-check"></i>&nbspSelect</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
													<a class='btn btn-warning' style='color:white;' onclick='editme(<?php echo $row['sid']; ?>,"<?php echo $name; ?>");'><i class="ft-edit-2"></i>&nbspEdit</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
													<a class='btn btn-danger' style='color:white;' onclick='deleteme(<?php echo $row['sid']; ?>);'><i class="ft-delete"></i>&nbspDelete</a></td>
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
		$.get("sectiontable.php?cid=<?php echo $classid; ?>", function( data ) {
		  $( "#stable" ).html("");
		  $( "#stable" ).html(data);
		});
	}


	$(document).ready(function() {
	     setInterval(function () {
	        refreshtable();
	    },5000);
	});

	var valperformdelete = "";
	var valperformupdate = "";
	var valperformupdateid = "";
	function gotostudents(sid,classid){
		window.location.href="./portfolio.php?class=" + classid + "&section="+sid;
	}
	function editme(sid,sname){
		valperformupdate = sid;
		// alert(cid);
		// Get the modal
		var modal = document.getElementById('editmodal');

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("closeedit")[0];
	  	
	  	modal.style.display = "block";
	  	var sectionvalue = $("#sectionname").val();
	  	$("#updateclassbox").val(sname);

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
		var slname = $("#updateclassbox").val();
		var modal = document.getElementById('editmodal');
		modal.style.display = "none";
		$.ajax({
		  type: 'post',
		  url: 'ajax.php',
		  data: {method: 'updatesection',sectionid:valperformupdate,uid:myuid,sectionname:slname},
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

	function deleteme(sid){
		valperformdelete = sid;
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
		  data: {method: 'deletesection',sectionid:valperformdelete,uid:myuid},
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


	 function addnewsection(){
	    var mysectionname = $("#sectionname").val();
	    var myclassid = "<?php echo $classid; ?>";
	    var myuid = "<?php echo $uid; ?>";
	    var myclassname = "<?php echo $classname; ?>";

	    if (mysectionname == ""){
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
			  data: {method: 'addsection',sectionname:mysectionname,uid:myuid,classid:myclassid,classname:myclassname},
			  success: function(data) {
				var modal = document.getElementById('addmodal');

				// Get the <span> element that closes the modal
				var span = document.getElementsByClassName("closeadd")[0];
			  	span.onclick = function() {
				  modal.style.display = "none";
				}
			  	modal.style.display = "block";

			  	$("#sectionname").val("");

			  	refreshtable();

			  }
			});
	    }
	  }
</script>

<?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>