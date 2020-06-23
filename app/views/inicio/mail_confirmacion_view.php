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
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css" />
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:900,700' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div style="text-align: center; margin: 0 auto; width: 550px; min-height: 300px; padding: 20px; padding-top: 255px; background-image: url('<?php echo base_url() ?>assets/image/gts_mailing.png')">
			<h2>Postulación Gana Tu Sitio</h2>
			Estimado <?php echo $postulante['nombre'] ?>, completa tu postulacion siguiendo el siguiente 
			<a href="<?php echo "http://".$_SERVER['SERVER_NAME'].'/confirmar/'.$random_hash.'/'.sha1('GTS-'.$postulante['rut']) ?>" ><strong>Enlace</strong></a>
			<h4>Recuerda compartir tu nuestra pagina en Facebook para que tu postulación esté completa.</h4> 
		</div>
	</body>
</html>