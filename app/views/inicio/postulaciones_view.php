<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Gana Tu Sitio</title>
		<meta name="description" content="">
		<meta name="author" content="Hitch Integradores">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta property="og:title" 
			content="Gana un sitio web sin costo participando en ganatusitio.cl" />
		<meta property="og:site_name" 
			content="GanaTuSitio"/>
		<meta property="og:description" 
			content="Esta es una iniciativa que beneficiará a las pymes y emprendimientos de Chile a las que les permitirá, en etapas tempranas, disponer de un sitio web sin costo"/>
		<meta property="og:image" 
			content="http://ganatusitio.cl/assets/image/GTS_compartir.png" />
   		 <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/favicon2.png"/>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome/css/font-awesome.min.css" />
	</head>
	<body>
		
		<table class="table table-striped">
		  <thead>
			  <th>ID</th>
			  <th>Nombre</th>
			  <th>RUT</th>
			  <th>Correo</th>
			  <th>Telefono</th>
			  <th>Como se entero</th>
			  <th>Por que ganar</th>
			  <th>Antiguedad</th>
			  <th>Creacion</th>
			  <th>Validado</th>
		  </thead>
		  <?php foreach ($postulaciones as $key => $value): ?>
			  <tr>
				  <td><?php echo $value->id ?></td>
				  <td><?php echo $value->nombre ?></td>
				  <td><?php echo $value->rut ?></td>
				  <td><?php echo $value->correo ?></td>
				  <td><?php echo $value->telefono ?></td>
				  <td><?php echo $value->como_se_entero ?></td>
				  <td><?php echo $value->por_que_ganar ?></td>
				  <td><?php echo $value->antiguedad_meses	 ?></td>
				  <td><?php echo $value->create_time ?></td>
				  <td><?php echo $value->validacion_correcta ?></td>
			  </tr>
		  <?php endforeach ?>
		</table>
	</body>
</html>