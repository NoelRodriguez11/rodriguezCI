<div class="container">

<h1>Listado de Personas</h1>

<a href="<?=base_url()?>"><button>Volver</button></a>
<table class="table table-striped table-hover ">
		<tr>
		<th>Foto</th>
		<th>Loginname</th>
		<th>Nombre</th>
		<th>País de nacimiento</th>
		<th>Fecha de nacimiento</th>
		<th>Altura</th>
		<th>Acción</th>
	</tr>

	
	<?php foreach ($personas as $persona): ?>
		<tr>
		<?php if ($persona -> loginname == "admin"):?>
			<td><img src="<?=base_url()?>/assets/img/vacio.png" height="80" width="80"></td>
		<td style="color:red;"><?= $persona->loginname?></td>
		<td style="color:red;">---</td>
		<td style="color:red;"><?= $persona->nace!=null?$persona->nace->nombre:'---'?></td>
		<td style="color:red;">---</td>
		<td style="color:red;">---</td>
		<td style="color:red;">---</td>
		
		<?php else:?>
		
		<?php if ($persona->ext_foto != null):?>
		<td><img src="<?=base_url()?>/assets/img/upload/persona-<?=$persona->id?>.<?=$persona->ext_foto?>" height="80" width="80"></td>
		<?php else:?>
		<td><img src="<?=base_url()?>/assets/img/vacio.png" height="80" width="80"></td>
		<?php endif;?>
		<td><?= $persona->loginname?></td>
		<td><?= $persona->nombre?></td>
		<td><?= $persona->nace!=null?$persona->nace->nombre:''?></td>
		<td><?= $persona->fnac?></td>
		<td><?= $persona->altura?></td>
		<td>
			<form action="<?=base_url()?>persona/dPost" method="post">
				<input type="hidden" name="id" value="<?=$persona->id?>">
				<button onclick="submit()">
					<img src="<?=base_url()?>/assets/img/basura.png" height="20"
						width="20"/>
				</button>
			</form>
			<form action="<?=base_url()?>persona/u" method="get">
				<input type="hidden" name="id" value="<?=$persona->id?>">
				<button onclick="submit()">
					<img src="<?=base_url()?>/assets/img/lapiz.png" height="20"
						width="20">
				</button>
			</form>
		</td>
		<?php endif;?>

	</tr>
	<?php endforeach;?>
</table>

</div>

