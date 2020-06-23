<hr />
<table class="table">
	<thead>
		<th colspan="2">Bitácora</th>
	</thead>
	<tr>
		<th>Descripción</th>
		<th>Fecha</th>
	</tr>
	<?php foreach ($bitacora as $key => $value): ?>
		<tr>
			<td><?php echo $value->descripcion ?></td>
			<td><?php echo ordenar_fechaHoraHumano($value->create) ?></td>
		</tr>
	<?php endforeach ?>
</table>