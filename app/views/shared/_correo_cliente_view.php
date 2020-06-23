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
        <div style="width: 100%; background-color: #ffffff">
            <div class="" id="contendor_ppal" style="width: 580px; padding-bottom: 20px; border-radius: 5px; overflow: hidden; margin: 0 auto">
                <table style="background-color: #ffffff;" border="0" cellspacing="0">
                    <tr style="background-color: #266cdf">
                        <td >&nbsp;</td>
                    </tr>
                    <!-- Cabecera mail-->
                    <tr>

                        <td style="">


                            <img alt="header" class="img-responsive" src="<?php echo base_url() . 'assets/images/header_correo.jpg' ?>" />
                            <div style="border-bottom: solid 1px #CCCCCC; "></div>
                        </td>
                    </tr>
                    <!-- Contenido mail-->
                    <tr>
                        <td id="cont_principal" style="padding: 20px 35px 20px 35px">
                            <h2 style="width: 100%; color: #266cdf; text-align: center"><?php echo $titulo ?></h2>
                            <p style="width: 100%;text-align: center; font-size: 13px"><?php echo $contenido ?></p>
                            <br />
                            <table style="width: 100%" border="0" cellspacing="0">
                                <tr><td colspan="2"><h3>Detalle Solicitud</h3></td></tr>
                                <tr>
                                    <th width="32%" style="padding: 2px 10px; border:  solid 1px #A1A1A1;">ID</th>
                                    <td style="padding: 2px 10px; border:  solid 1px #A1A1A1;"><?php echo $solicitud_id ?></td>
                                </tr>
                                <tr>
                                    <th style="padding: 2px 10px; border:  solid 1px #A1A1A1;">Corr. empresa</th>
                                    <td style="padding: 2px 10px; border:  solid 1px #A1A1A1;"><?php echo $solicitud->correlativo ?></td>
                                </tr>
                                 <?php if ($empresa->nombre != ''): ?>
                                <tr>
                                    <th style="padding: 2px 10px; border:  solid 1px #A1A1A1;">Empresa</th>
                                   
                                        <td style="padding: 2px 10px; border:  solid 1px #A1A1A1;"><?php echo $empresa->nombre ?></td>
                              
                                </tr>
                                      <?php endif ?>
                                  <?php if ($solicitud->titulo != ''): ?>
                                <tr>
                                    <th style="padding: 2px 10px; border:  solid 1px #A1A1A1;">Asunto solicitud</th>
                                  
                                        <td style="padding: 2px 10px; border:  solid 1px #A1A1A1;"><?php echo $solicitud->titulo ?></td>
                                
                                </tr>
                                    <?php endif ?>
                                  <?php if ($solicitud->descripcion != ''): ?>
                                <tr>
                                    <th style="padding: 2px 10px; border:  solid 1px #A1A1A1;">Descripción</th>
                                  
                                    <td style="padding: 2px 10px; border:  solid 1px #A1A1A1;"><?php echo $solicitud->descripcion ?></td>
                                         
                                </tr>
                                 <?php endif ?>
                                <tr>
                                    <th style="padding: 2px 10px; border:  solid 1px #A1A1A1;">Fechas creacion</th>
                                    <td style="padding: 2px 10px; border:  solid 1px #A1A1A1;"><?php echo $solicitud->create ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <h3 style="text-align: center;"><?php echo $h3 ?></h3>
                            <a href="http://hisokahitch.ddns.net:8888//gestion-ticket/" class="btn" target="_blank" 
                               style="padding: 6px 20px; background-color: #2196F3; color: #fff; display: inline-block; 
                               margin: 5px auto; text-decoration: none; text-transform: uppercase; font-size:14px; 
                               border-radius: 3px;">Ir a la Solicitud</a>
                            <div class="bajada" style="font-style: italic; font-size: .9em; padding-top: 10px; margin-top: 10px; color: #266cdf; text-align: center; border-top: 1px solid #ccc;">Este mensaje se ha generado automaticamente, favor no responder.</div>
                        </td>
                    </tr>
                    <!-- Footer mail-->
                    <tr style="">
                        <td style="padding: 15px; text-align: center;">
                            <img src="<?php echo base_url() . '/assets/images/logo_hitch_HD.png' ?>" alt="logo_hitch_HD" width="150" style="margin:10px auto; display:block;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>