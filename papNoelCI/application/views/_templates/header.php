<div class="container">
<?php if ($header['persona']!=null):?>
	Hola <?=$header['persona']->nombre?>
<?php else:?>
	Debes hacer login para entrar
<?php endif;?>
</div>