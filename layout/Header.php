<header>
	<div class="text-right">
		<?php if (!empty($_SESSION['id_role']) && isset($_SESSION['id_role'])) {?>
		<a href="index.php?do=logout" class="btn btn-outline-secondary">Logout</a>
		<?php } ?>
	</div>
</header>