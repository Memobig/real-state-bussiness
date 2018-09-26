<?php
if (isset($_SESSION['id_role']) && !empty($_SESSION['id_role'])) {
	redirect("index.php?do=available");
}
?>
<div class="row centered-form center-block">
	<div class="container col-md-5 col-md-offset-1">
		<div class="card border-primary text-center" style="">
			<div class="card-header">Sign In</div>
			<div class="card-body">

				<form action="auth.php" method="post">
					<div class="form-group col-sm">
						<input type="text" name="username" id="username"
							class="form-control" placeholder="Username" autofocus required />
					</div>

					<div class="form-group col-sm">
						<input type="password" name="password" id="password"
							class="form-control" placeholder="Password" required />
					</div>

					<div class="form-group col-sm">
						<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign In"/>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>