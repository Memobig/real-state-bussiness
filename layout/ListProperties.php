<?php 

if (empty($_SESSION['id_role']) && !isset($_SESSION['id_role'])) {
	redirect("index.php");
}

?>
<?php if ($_SESSION['id_role'] == 2) {?>
<a href="index.php?do=addProperty" class="btn btn-success my-2">New Property</a>
<?php } ?>
<form action="">
	<select name="filterOption" onchange="filterList(this.value);">
		<option value="">Select a filter</option>
		<option value="sale">Sale</option>
		<option value="rent">Rent</option>
		<option value="price">Low Price</option>
		<option value="all">All</option>
	</select>
</form>
<div id="filteredList">
	<table class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Location</th>
				<th scope="col">Description</th>
				<th scope="col">Price</th>
				<th scope="col">Status</th>
				<th scope="col">Type</th>
				<?php if ($_SESSION['id_role'] == 2) {?>
				<th scope="col">Modify</th>
				<th scope="col">Delete</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
	<?php 
	foreach ($properties as $property) {
	?>
			<tr>
				<td><?=$property->id?></td>
				<td><?=$property->location?></td>
				<td><?=$property->description?></td>
				<td><?=$property->price?></td>
				<td><?=$property->status==1?"available":"not available" ?></td>
				<td><?=$property->type==0?"sale":"rent" ?></td>
				<?php if ($_SESSION['id_role'] == 2) {?>
				<td><a href="index.php?do=modify&id=<?=$property->id?>" class="btn btn-primary">modify</a></td>
				<td><a href="delete.php?id=<?=$property->id?>" class="btn btn-danger">delete</a></td>
				<?php } ?>
			</tr>
	<?php 
	}
	?>
		</tbody>
	</table>
</div>