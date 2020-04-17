<div class="container">

<h1>Registro de nuevo usuario</h1>

<form action="<?=base_url()?>hdu/anonymous/registrarPost" method="post">

	<label for="id-login">Loginname</label>
	<input id="id-login" type="text" name="loginname" required="required"/>
	<br/>
	
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre" required="required"/>
	<br/>
	
	<label for="id-pwd">Contraseña</label>
	<input id="id-pwd" type="password" name="pwd" required="required"/>
	<br/>
	
	<label for="id-foto">Foto</label>
	<input id="id-foto" type="file" name="foto" required="required"/>
	<br/><br/>
	
	<label for="id-alt">Altura (cm)</label>
	<input id="id-alt" type="number" name="altura" value=175 min=0 max=400 required="required"/>
	<br/>
	
	<label for="id-fnac">Fecha de Nacimiento</label>
	<input id="id-fnac" type="date" name="fnac" value="2000-02-29" required="required"/>
	<br/>
	
	<label for="id-pais">País de nacimiento</label>
	<select id="id-pais" name="pais">
	<option>----</option>
	<?php foreach ($paises as $pais):?>
	<option value="<?=$pais->id?>"><?=$pais->nombre?></option>
	<?php endforeach;?>
	</select>
	<br/><br/>

	<input type="submit"/>
</form>

</div>