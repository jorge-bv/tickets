<?php echo form_open('', $form_open, $hidden) ?>
<?php if (!empty($mensaje)): ?>
	<div class="alert alert-info alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <?php echo $mensaje ?>
	</div>
<?php endif ?>

<table class="table">
	<tr>
		<th width="200px">Password actual</th>
		<td><input type="password" name="actual" class="form-control" /></td>
	</tr>
	<tr>
		<th>Nueva password</th>
		<td><input type="password" name="nueva" class="form-control" /></td>
	</tr>
	<tr>
		<th>Repetir password</th>
		<td><input type="password" name="nueva2" class="form-control" /></td>
	</tr>	
	<tr>
		<td><button class="btn btn-primary">Guardar cambios</button></td>
		<td></td>
	</tr>
</table>
<?php echo form_close() ?>