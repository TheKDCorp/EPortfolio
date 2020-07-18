<?php include_once('../created/header.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>

<?php 
$uid = $_COOKIE['teacher_id'];
$sql = "SELECT * FROM activity";
$result = $conn->query($sql);
?>

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
					<td onclick="gotosection(<?php echo $row['activityid']; ?>);"><?php echo $srno; ?></td>
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
	<?php 

 ?>