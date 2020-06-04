<div class="container">

<h1>Nuevo país</h1>

<form action="<?=base_url()?>pais/cPost" method="post">
	<label for="idp">Nombre</label>
	<input id="idp" type="text" name="nombre"/>
	<input type="submit"/>
</form>
<a href="<?=base_url()?>pais/r"><button class="button">Volver</button></a>
 
 </div>