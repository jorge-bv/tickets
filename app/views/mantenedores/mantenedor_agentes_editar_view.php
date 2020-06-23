<!--mantenedor_agentes_editar_view.php-->
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
			<td><?php echo form_input($nombre, $ficha->nombre) ?></td>
		</tr>

		<tr>
			<td><b>Rut<b /></td>
			<td><?php echo form_input($rut, $ficha->rut) ?></td>
		</tr>
		
		<tr>
			<td><b>Correo<b /></td>
			<td><?php echo form_input($correo, $ficha->correo) ?></td>
		</tr>
		
		<tr>
			<td><b>Telefono<b /></td>
			<td><?php echo form_input($telefono, $ficha->telefono) ?></td>
		</tr>
		<tr>
			<td><b>Estado</b></td>
			<td>
				<?php echo form_dropdown('data[activo]', array('1'=>'Activo', '0'=>'Desactivado'), $ficha->activo) ?>
			</td>
		</tr>
		</tbody>
	</table>
	<?php echo form_button($button) ?> 
	<?php echo form_close() ?>

	<p></p>		
	<a href="<?php echo base_url()?>mantenedores/agentes/listar">Listar Todos <i class="icon-list"></i></a>
</div>
