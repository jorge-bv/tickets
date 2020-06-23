<!--mantenedor_empresas_editar_view.php-->
<div class="contenido_view">		
	<?php if (!empty($mensaje_error)): ?>
		<div class="alert alert-error">
			<a data-dismiss="alert" class="close">×</a>
			<?php echo $mensaje_error; ?>
		</div>
	<?php endif ?>
			
			
	<?php echo form_open_multipart('', $form_open, $hidden) ?>
	<table border="0" class="table table-hover">
		<tbody>
		<tr>
			<td><b>Nombre<b /></td>
			<td colspan="2"><?php echo form_input($nombre, $ficha->nombre) ?></td>
		</tr>
		
		<tr>
			<td><b>Rut<b /></td>
			<td colspan="2"><?php echo form_input($rut, $ficha->rut) ?></td>
		</tr>
		<tr>
			<td><b>Logo<b /></td>
			<td colspan="2"><input type="file" name="imagen" /></td>
		</tr>
		
		<tr>
			<td width="150px" rowspan="<?php echo count($productos)+1 ?>"><strong>Productos</strong></td>
		</tr>
		<?php foreach ($productos as $key => $value): ?>
			<tr>
				<td width="200px"><strong><?php echo $value->nombre ?></strong></td>
				<td><input class="check_producto" id="producto<?php echo $value->id ?>" type="checkbox" name="productos[]" value="<?php echo $value->id ?>" /></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo form_button($button) ?> 
	<?php echo form_close() ?>

	<p></p>		
	<a href="<?php echo base_url()?>mantenedores/empresas/listar">Listar Todos <i class="icon-list"></i></a>
</div>
<script>
	<?php foreach ($productos_empresa as $key => $value): ?>
		$('#producto<?php echo $value->productos_id ?>').prop('checked', true);
	<?php endforeach ?>
</script>