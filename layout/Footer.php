    <footer class="text-muted">
      <div class="container">
    	<p>
    		<?php 
    		if (isset($_SESSION['id_role'])) {
    			
    			echo $_SESSION['id_role'] == 1? 'ROLE_CLIENT' : 'ROLE_EMPLOYEE';
    		}
    		?>
    		</p>
         &copy; RealStateBussiness
      </div>
    </footer>