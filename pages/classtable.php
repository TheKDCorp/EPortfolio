<?php include_once('../created/header.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>

<?php 
	$uid = $_COOKIE['teacher_id'];
	$sql = "SELECT * FROM class_entry where uid='$uid'";
	$result = $conn->query($sql);

	?>
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
	<?php 

 ?>