<!--mantenedor_productos_ficha_view.php-->
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
			<td><?php echo $ficha->nombre ?></td>
		</tr>
		</table>
	<?php echo form_close() ?>

	<a href="<?php echo base_url()?>mantenedores/productos/listar">Listar Todos <i class="icon-list"></i></a>
</div>
