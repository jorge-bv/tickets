<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function prepara_dropdown($data, $id='id', $nombre='nombre')
	{
		$result[0] = 'Seleccione';
		foreach ($data as $key => $value) 
		{
			$result[$value->$id] = $value->$nombre;
		}
		return $result; 
	}
    
	function traer_estados($estado_id)
	{
		switch ($estado_id) 
		{
			case 1:
				$estado = "Activo";
			break;
			case 0:
				$estado = '<h6><label class="label label-danger">Desactivado</label></h6>';
			break;
		}
		return $estado;
	}
	
	function traer_posicion($posicion)
	{
		switch ($posicion) 
		{
			case "L":
				$texto_posicion = "Izquierda";
			break;
			
			case "C":
				$texto_posicion = "Centrado";
			break;
			
			case "R":
				$texto_posicion = "Derecha";
			break;
		}
		return $texto_posicion;
	}
	
	function es_destacado($destacado)
	{
		switch ($destacado) 
		{
			case 1:
				$respuesta_destacado = '<h4><label class="label label-success"> Destacado</label></h4>';
			break;
			
			case 0:
				$respuesta_destacado = "No destacado";
			break;
			
			default:
				$respuesta_destacado = "No informado";
			break;
		}
		return $respuesta_destacado;
	}
	
	function formatear_numero($numero)
	{
		if(!empty($numero))
		{
			$pesos = '$ '.number_format($numero, 0, ',', '.');
		}
		else
		{
			$pesos = "No aplica";
		}
		return $pesos;
	}
	
	function formatear_porcentaje($numero)
	{
		
		if(!empty($numero))
		{
			if(!is_float($numero))
			{
				 
			}
			$porcentaje = str_replace('.', ',', $numero).' %'; 
		}
		else
		{
			$porcentaje = "No aplica";
		}
		return $porcentaje;
	}
	
	function crear_nombre_imagen($file_name)
	{
		$replace = array('.', ' ');
        $nombre_foto = str_replace($replace, '', microtime());
        $extension  = array_pop(explode('.', $file_name));
        $nombre_foto .=  '-gallery.'.$extension;
		return $nombre_foto;
	}
	
	function crear_carpeta($articulo_id, $prefix)
	{
		 $ruta_contenido = $_SERVER[DOCUMENT_ROOT].'/galeria/'.$prefix.$articulo_id.'/';
         mkdir($ruta_contenido,0755, TRUE);
		 return $ruta_contenido;
	}
	
	function calcular_descuento($precio, $porcentaje_descuento)
	{
		$descuento = ($precio * $porcentaje_descuento)/100;
		return '$'.number_format($precio-$descuento, 0, ',', '.');
	}
	
	function genera_password()
	{
		$psswd = substr(microtime(), 1, 12);
		return $psswd;
	}
	
	function redimensionar_img($filename)
	{
		//$filename= "ejemplo-de-imagen.jpg";
		list($w, $h, $type, $attr) = getimagesize($filename);
		$src_im = imagecreatefromjpeg($filename);
		
		$src_x = '0';   // comienza x
		$src_y = '0';   // comienza y
		$src_w = '100'; // ancho
		$src_h = '100'; // alto
		$dst_x = '0';   // termina x
		$dst_y = '0';   // termina y
		
		$dst_im = imagecreatetruecolor($src_w, $src_h);
		$white = imagecolorallocate($dst_im, 255, 255, 255);
		imagefill($dst_im, 0, 0, $white);
		
		imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
		
		header("Content-type: image/png");
		imagepng($dst_im);
		imagedestroy($dst_im);
	}
	
