<?php include_once('../created/header.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>

<?php 
	$uid = $_COOKIE['teacher_id'];
	$classid = $_GET['cid'];
	$sql = "SELECT * FROM section_entry where uid='$uid' and cid='$classid'";
	$result = $conn->query($sql);

	?>
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
						<a class='btn btn-warning' style='color:white;' onclick='editme(<?php echo $row['sid']; ?>,"<?php echo $name; ?>",<?php echo $classid; ?>);'><i class="ft-edit-2"></i>&nbspEdit</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<a class='btn btn-danger' style='color:white;' onclick='deleteme(<?php echo $row['sid']; ?>);'><i class="ft-delete"></i>&nbspDelete</a></td>
				</tr>

				<?php
				}
				}
			?>
		</tbody>
	</table>
	<?php 

 ?>