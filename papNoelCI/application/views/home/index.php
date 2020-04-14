<div class="container">
	<h1>Aplicación P.A.P.+</h1>
	
	<?php if($rol == 'auth'):?>
	
	<a href="<?=base_url()?>/persona/r"><button>Persona</button></a>
	<a href="home/LogOut.php"><button>Log Out</button></a>
	
	<?php elseif ($rol == 'admin'): ?>
	
		<h1>Vista de administrador</h1>
	
	<?php else:?>
	
		<h3>Debes hacer login o registrarte para poder empezar a operar</h3>
		
	<?php endif;?>
</div>
