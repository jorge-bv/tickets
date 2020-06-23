	<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>Tickets Hitch</title>
	    <style>#cont_principal img{width: 100%;}</style>
	</head>
	<body>
		<div style="width: 100%; background-color: #E7E7E7">
			<div class="" id="contendor_ppal" style="width: 580px; padding-bottom: 20px; border-radius: 5px; overflow: hidden; margin: 0 auto">
				<table style="background-color: #FFFFFF;" border="0" cellspacing="0">
					  <tr style="background-color: #266cdf">
						  <td >&nbsp;</td>
					  </tr>
					  <!-- Cabecera mail-->
					  <tr>
					  	<td style="">
			
					  		<div style="border-bottom: solid 1px #CCCCCC; "></div>
					  	</td>
					  </tr>
					  <!-- Contenido mail-->
					  <tr>
					  	<td id="cont_principal" style="padding: 20px 35px 20px 35px">
					  		<h2 style="width: 100%; color: #266cdf; text-align: center"><?php echo $titulo ?></h2>	
					  		<?php echo $contenido ?>
					  		<h3 style="text-align: center;"><?php echo $h3 ?></h3>
					  			
					  			<a href="http://hisokahitch.ddns.net:8888//gestion-ticket/" class="btn" target="_blank" 
								style="padding: 6px 20px; background-color: #2196F3; color: #fff; display: inline-block;
								margin-left:38%; text-decoration: none; text-transform: uppercase; font-size:14px; 
								border-radius: 3px; ">Ir al Sitio.</a>
						</td>		
					  </tr>
					  <tr>
					  	<td style="text-align: center">
					  		<?php if (!empty($link)): ?>
								  
							  
							  		<a href="http://hisokahitch.ddns.net:8888//gestion-ticket/" class="btn" target="_blank" 
										style="padding: 6px 20px; background-color: #2196F3; color: #fff; display: inline-block; 
										margin: 5px auto; text-decoration: none; text-transform: uppercase; font-size:14px; 
										border-radius: 3px;">Ver solicutud</a>
							<?php endif ?>
							<div class="bajada" style="font-style: italic; font-size: .9em; padding-top: 10px; margin-top: 10px; color: #266cdf; text-align: center; border-top: 1px solid #ccc;">Este mensaje se ha generado automaticamente, favor no responder.</div>
					  	</td>
					  </tr>
					  <!-- Footer mail-->
					  <tr style="">
					  	<td style="padding: 15px; text-align: center;">
					  		<img src="<?php echo base_url().'assets/images/logo_hitch_HD.png'?>" alt="logo_hitch_HD" width="150" style="margin:10px auto; display:block;">
					  	</td>
					  </tr>
				  </table>
			</div>
		</div>
	</body>
</html>