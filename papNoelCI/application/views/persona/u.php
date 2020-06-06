<div class="container">

<h1>Editar persona</h1>

<form action="<?=base_url()?>persona/uPost" method="post" enctype="multipart/form-data">

	<label for="loginname">Loginname</label>
	<input id="loginname" type="text" name="loginname" required="required" value="<?=$persona->loginname?>"/>
	<br/>
	
	<label for="nombre">Nombre</label>
	<input id="nombre" type="text" name="nombre" required="required" value="<?=$persona->nombre?>"/>
	<br/>
	
	<label for="altura">Altura (en cm)</label>
	<input id="altura" type="number" name="altura" required="required" min="0" max="400" value="<?=$persona->altura?>" />
	<br/>
	
	<label for="fnac">Fecha de Nacimiento</label>
	<input id="fnac" type="date" name="fnac" required="required" value="2000-02-29" value="<?=$persona->fnac?>"/>
	<br/>
	
	<label for="pais">Pais</label>
	
	<select id="pais" name="pais">
			<?php foreach ($paises as $pais):?>
    		<option value="<?=$pais->id?>" <?= $pais->id==$persona->nace_id ? 'selected="selected"' : ''?>><?=$pais->nombre?></option>
		<?php endforeach;?>
	</select>
	<br/>
	
	<input type="hidden" name="id" value="<?=$persona->id?>"/>
	<input type="submit" value="Modificar"/>
</form>
<a href="<?=base_url()?>"><button class="button">Volver</button></a>

</div>