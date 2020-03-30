<div class="container">

<h1>Editar persona</h1>

<form action="<?=base_url()?>persona/uPost" method="post">
	<input type="hidden" name="id" value="<?=$persona->id?>"?>

	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre" value="<?= $persona->nombre?>"/>
	<br/>
	
	País nacimiento
	<select name="idPaisNace">
		<?php foreach ($paises as $pais):?>
		<option value="<?=$pais->id?>" <?= $pais->id==$persona->nace_id ? 'selected="selected"' : ''?>><?=$pais->nombre?></option>
		<?php endforeach;?>
	</select>

	<br/>
	País residencia
	<select name="idPaisReside">
		<?php foreach ($paises as $pais):?>
		<option value="<?=$pais->id?>" <?= $pais->id==$persona->reside_id ? 'selected="selected"' : ''?>><?=$pais->nombre?></option>
		<?php endforeach;?>
	</select>
	<br/>
	<input type="submit"/>
</form>

<a href="<?=base_url()?>"><button>Cancelar</button></a>

</div>