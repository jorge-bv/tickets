<!--mantenedor_clientes_ficha_view.php-->
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
			<td><b>Empresa<b /></td>
			<td><?php echo $ficha->hd_empresas_nombre ?></td>
		</tr>
		
		<tr>
			<td><b>Nombre<b /></td>
			<td><?php echo $ficha->nombre ?></td>
		</tr>
		
		<tr>
			<td><b>Rut<b /></td>
			<td><?php echo $ficha->rut ?></td>
		</tr>
		
		<tr>
			<td><b>Correo<b /></td>
			<td><?php echo $ficha->correo ?></td>
		</tr>
		
		<tr>
			<td><b>Telefono<b /></td>
			<td><?php echo $ficha->telefono ?></td>
		</tr>
		
		</table>
	<?php echo form_close() ?>

	<a href="<?php echo base_url()?>mantenedores/clientes/listar">Listar Todos <i class="icon-list"></i></a>
</div>
