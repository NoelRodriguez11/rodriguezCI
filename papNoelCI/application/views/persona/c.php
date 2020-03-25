<div class="container">

<h1>Nueva persona</h1>

<form action="<?=base_url()?>persona/cPost" method="post">
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre"/>
	<br/>
	
	<label for="id-pwd">Contraseña</label>
	<input id="id-pwd" type="password" name="pwd"/>
	<br/>

	País nacimiento
	<select name="idPaisNace">
		<?php foreach ($paises as $pais):?>
		<option value="<?=$pais->id?>"><?=$pais->nombre?></option>
		<?php endforeach;?>
	</select>

	<br/>
	País residencia
	<select name="idPaisReside">
		<?php foreach ($paises as $pais):?>
		<option value="<?=$pais->id?>"><?=$pais->nombre?></option>
		<?php endforeach;?>
	</select>

	<br/>
	Aficiones que le gustan
	<select name="idsAficionGusta[]" multiple="multiple">
		<?php foreach ($aficiones as $aficion):?>
		<option value="<?=$aficion->id?>"><?=$aficion->nombre?></option>
		<?php endforeach;?>
	</select>
	
	<br/>
	Aficiones que odia
	<?php foreach ($aficiones as $aficion):?>
		<input id="id-af-<?=$aficion->id?>" type="checkbox" name="idsAficionOdia[]" value="<?=$aficion->id?>"/>
		<label for="id-af-<?=$aficion->id?>"><?=$aficion->nombre?></label>
	<?php endforeach;?>	


	<br/>
	<input type="submit"/>
</form>

</div>