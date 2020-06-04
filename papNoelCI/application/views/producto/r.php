<div class="container">

	<h1>Lista de productos</h1>
	<a href="<?=base_url()?>producto/c"><button class="button">Nuevo</button></a>
	<a href="<?=base_url()?>"><button class="button">Volver</button></a>
	
	
	<table class="table">
		<tr>
			<th>Nombre</th>
			<th>Categoría</th>
			<th>Acciones</th>
		</tr>
		
			<?php foreach ($productos as $producto):?>
			<tr>
				<td><?=$producto->nombre?></td>
				<td><?=$producto->categoria->nombre?></td>
				<td>
        				<form action="<?=base_url()?>producto/dPost" method="post">
        					<input type="hidden" name="id" value="<?=$producto->id?>">
        					<button onclick="submit()">
        						<img src="<?=base_url()?>/assets/img/basura.png" height="20"
        							width="20">
        					</button>
        				</form>
  
        				<form action="<?=base_url()?>producto/u" method="get">
        					<input type="hidden" name="id" value="<?=$producto->id?>">
        					<button onclick="submit()">
        						<img src="<?=base_url()?>/assets/img/lapiz.png" height="20"
        							width="20">
        					</button>
        				</form>
				</td>
			</tr>
			<?php endforeach;?>
	</table>
</div>