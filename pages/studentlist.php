<?php include_once('../created/header.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>

<?php 
	$uid = $_COOKIE['teacher_id'];
	$cid = $_GET['cid'];
	$sid = $_GET['sid'];
	$sql = "SELECT * FROM student_csdetails where uid='$uid' and classid='$cid' and sectionid='$sid'";
	$result = $conn->query($sql);

	?>
	<table class="table table-striped table-hover" id="example">
		<thead>
			<tr>
                <th>Student Name
                </th>
                <th>Functions
                </th>
            </tr>
		</thead>
		<tbody>
			<?php 
				if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				$studentiddummy = $row['studentid'];
				$sql1 = "SELECT * FROM student_biodata where studentid = '$studentiddummy'";
				$result1 = $conn->query($sql1);
				if($result1->num_rows > 0){
					$row1 = $result1->fetch_assoc();
					$stname = $row1['studentname'];
				}else{
					$stname = "";
				}
				?>
				
				<tr>
					<td style='min-width:50em;' onclick='studentname("<?php echo $stname; ?>","<?php echo $row['studentid']; ?>","<?php echo $row['classid']; ?>","<?php echo $row['sectionid']; ?>","<?php echo $row['studentcsid']; ?>");'><?php echo $stname; ?></td>
					<td style="min-width:30em;">
						<a class='btn btn-info btn-sm' style='color:white;' onclick='studentname("<?php echo $stname; ?>","<?php echo $row['studentid']; ?>","<?php echo $row['classid']; ?>","<?php echo $row['sectionid']; ?>","<?php echo $row['studentcsid']; ?>");'><i class="ft-check"></i>&nbspSelect</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<a class='btn btn-warning btn-sm' style='color:white;'onclick='studentname("<?php echo $stname; ?>","<?php echo $row['studentid']; ?>","<?php echo $row['classid']; ?>","<?php echo $row['sectionid']; ?>","<?php echo $row['studentcsid']; ?>"),addbiodatadetails();'><i class="ft-edit-2"></i>&nbspEdit</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<a class='btn btn-danger btn-sm' style='color:white;' onclick='deleteme(<?php echo $row['biodataid']; ?>);'><i class="ft-delete"></i>&nbspDelete</a></td>
				</tr>

				<?php
				}
				}
			?>
		</tbody>
	</table>
	<?php 

 ?>