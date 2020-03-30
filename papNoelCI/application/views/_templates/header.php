<div class="container">
<?php if ($header['persona']!=null):?>
	Hola <?=$header['persona']->nombre?>
<?php else:?>
		  <a href="<?=base_url()?>hdu/anonymous/registrar">Registro</a> /
		  <a href="<?=base_url()?>hdu/anonymous/login">Login</a>
<?php endif;?>
</div>