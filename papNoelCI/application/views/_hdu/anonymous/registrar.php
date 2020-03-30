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
	
	<label for="id-alt">Altura</label>
	<input id="id-alt" type="number" name="altura" required="required"/>
	<br/>
	
	<label for="id-fnac">Fecha de Nacimiento</label>
	<input id="id-fnac" type="date" name="fnac" required="required"/>
	<br/>
	
	<label for="id-pais">País nacimiento</label>
	<select id="id-pais">
	<option>----</option>
	</select>
	<br/><br/>

	<input type="submit"/>
</form>

</div>