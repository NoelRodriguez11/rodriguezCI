<div class="container">
<?php if ($header['persona']!=null):?>
	Hola <?=$header['persona']->loginname?> /
	<a href="<?=base_url()?>anonymous/logout">Cerrar Sesión</a>
<?php else:?>
		  <a href="<?=base_url()?>anonymous/registrar">Registro</a> /
		  <a href="<?=base_url()?>anonymous/login">Login</a>
<?php endif;?>
</div>