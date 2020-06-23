<!--mantenedor_empresas_listar_view.php-->
<div class="contenido_view">		
	<p></p>
	<a class="btn btn-small btn-primary" href="<?php echo base_url()?>mantenedores/empresas/nuevo">Crear Empresas <i class="icon-plus"></i></a>
	<p></p>
	<?php if (!empty($mensaje_error)): ?>
        <b><div style="color: #000"  class="alert alert-error">
                    <a data-dismiss="alert" class="close">×</a>
			<?php echo $mensaje_error; ?>
		</div></b>
	<?php endif ?>
			
	<?php echo form_open('', $form_open, $hidden) ?>
	<table border="0" class="table table-hover">
		<thead>	
			<tr>
			<th>Nombre</th>
		
			<th>Rut</th>
		
				<th>&nbsp;</th>
				
				<th>&nbsp;</th>
				
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach($ficha as $key => $value): ?>
			<tr>
			<td><?php echo $value->nombre ?></td>
		
			<td><?php echo $value->rut ?></td>
		
			<td width="20px">
				<a href="#" title="Ver Ficha" ><i class="glyphicon glyphicon-zoom-in" onclick="accion(<?php echo $value->id?>, 'ficha')" > </i></a>
			</td>
			<td width="20px">
				<a href="#" title="Editar" ><i class="glyphicon glyphicon-pencil" onclick="accion(<?php echo $value->id?>, 'editar')" > </i></a>
			</td>
			<td width="20px">
				<a href="#" title="Eliminar" ><i class="glyphicon glyphicon-remove" onclick="accion(<?php echo $value->id?>, 'eliminar')" > </i></a>
			</td>
			</tr>
		<?php endforeach ?>
		</tbody>
		</table>
	<?php echo form_close() ?>

</div>
<script type="text/javascript">
	function accion(id, accion)
	{
		document.location = '<?php echo base_url()?>mantenedores/empresas/'+id+'/'+accion;	
	}
</script>