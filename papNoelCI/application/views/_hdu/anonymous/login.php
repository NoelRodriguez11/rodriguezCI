<div class="container">
	<form class="form" action="<?=base_url().'hdu/anonymous/loginPost'?>" method="post">
	
	<label for="idnombre">Nombre de usuario</label>
	<input class="form-control" id="idnombre" type="text" name="nombre"/>
	<br/>
	
	<label for="idpwd">Contraseña</label>
	<input class="form-control" id="idpwd" type="password" name="pwd"/>
	<br/>
	
	<input type="submit" />
	</form>
</div>