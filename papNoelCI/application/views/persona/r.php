<div class="container">

<h1>Lista de personas</h1>

<a href="<?=base_url()?>persona/c"><button>Nueva</button></a>
<a href="<?=base_url()?>"><button>Volver</button></a>
<table border="1">
	<tr>
		<th>Nombre</th>
		<th>Contraseña</th>
		<th>País nacimiento</th>
		<th>Acción</th>
	</tr>
	
	<?php foreach ($personas as $persona): ?>
		<tr>
		<td><?= $persona->nombre?></td>
		<td><?= $persona->pwd?></td>
		<td><?= $persona->nace!=null?$persona->nace->nombre:'--'?></td>
		<td>
			<form action="<?=base_url()?>persona/dPost" method="post">
				<input type="hidden" name="id" value="<?=$persona->id?>">
				<button onclick="submit()">
					<img src="<?=base_url()?>/assets/img/basura.png" height="20" width="20">
				</button>
			</form>
			<form action="<?=base_url()?>persona/u" method="get">
				<input type="hidden" name="id" value="<?=$persona->id?>">
				<button onclick="submit()">
					<img src="<?=base_url()?>/assets/img/lapiz.png" height="20" width="20">
				</button>
			</form>
		</td>

	</tr>
	<?php endforeach;?>
</table>

</div>

