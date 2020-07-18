<?php include_once('../created/header.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>

<?php
$sql = "SELECT * FROM teacher_entry";
$result = $conn->query($sql);
?>

<table class="table table-striped table-hover" id="example">
	<thead>
		<tr>
		    <th>Teacher ID</th>
		    <th>Name</th>
			<th>Username</th>
		    <th>Functions</th>
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