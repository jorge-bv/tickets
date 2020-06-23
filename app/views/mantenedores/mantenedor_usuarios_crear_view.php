<!--mantenedor_usuarios_crear_view.php-->
<div class="contenido_view">		
	<?php if (!empty($mensaje_error)): ?>
		<div class="alert alert-error">
			<a data-dismiss="alert" class="close">×</a>
			<?php echo $mensaje_error; ?>
		</div>
	<?php endif ?>
	
			
	<?php echo form_open('', $form_open, $hidden) ?>
	<table border="0" class="table table-hover">
		
		<tbody>
		<tr>
			<td><b>Nombre<b /></td>
			<td><?php echo form_input($nombre) ?></td>
		</tr>
		
		<tr>
			<td><b>Correo<b /></td>
			<td><?php echo form_input($correo) ?></td>
		</tr>
		
		<tr>
			<td><b>Telefono<b /></td>
			<td><?php echo form_input($telefono) ?></td>
		</tr>
		
		<tr>
			<td><b>Rut<b /></td>
			<td><?php echo form_input($rut) ?></td>
		</tr>
                </tbody>
	</table>
	<?php echo form_button($button) ?> 
	<?php echo form_close() ?>

	<p></p>		
	<a href="<?php echo base_url()?>mantenedores/usuarios/listar">Volver <i class="icon-backward"></i></a>
</div>
