<div class="container">
	<h1>Nueva categoría</h1>

	<form action="<?=base_url()?>categoria/cPost" method="post">
		Nombre
		<input type="text" name="nombre" autofocus="autofocus"/>
		<br/>
		<input type="submit"/>	
	</form>
	<a href="<?=base_url()?>"><button class="button">Volver</button></a>	
</div>