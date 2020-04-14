<div class="container">

<h1>Nueva persona</h1>

<form action="<?=base_url()?>persona/cPost" method="post">
	<label for="idp">Nombre de usuario</label>
	<input id="idp" type="text" name="loginname" required="required"/>
	<br/>
	
	<label for="id-pwd">Contraseña</label>
	<input id="id-pwd" type="password" required="required" name="pwd"/>
	<br/>
	<input type="submit"/>
</form>

</div>