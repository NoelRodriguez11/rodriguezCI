<div class="container">
	<h1>Aplicación P.A.P.+</h1>
	
	<?php if($rol == 'auth'):?>
	
	<a href="<?=base_url()?>/persona/r"><button>Ficha Personal</button></a>
	<br><br>
	<a href="<?=base_url()?>/carro/add"><button>Carrito de la Compra</button></a>
	
	<?php elseif ($rol == 'admin'): ?>
	
		<h2>Vista de administrador</h2>
		
		<a href="<?=base_url()?>/pais/r"><button>País</button></a>
		<a href="<?=base_url()?>/persona/r"><button>Persona</button></a>
		<a href="<?=base_url()?>/categoria/r"><button>Categoría</button></a>
		<a href="<?=base_url()?>/producto/r"><button>Producto</button></a>
	
	<?php else:?>
	
		<h3>Debes hacer login o registrarte para poder empezar a operar</h3>
		
	<?php endif;?>
</div>
