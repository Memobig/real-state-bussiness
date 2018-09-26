<?php include 'config/Config.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/Head.php'; ?>
</head>
<body>
	<?php include 'layout/Header.php'; ?>
	<div class="container">
		<?php include ($pageContainer); ?>
	</div>
	<footer>
		<?php include 'layout/Footer.php'; ?>
	</footer>
</body>
</html>