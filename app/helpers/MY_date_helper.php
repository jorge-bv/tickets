<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function ordenar_fechaHoraServidor($date)
    {
    	$date = new DateTime($date);
		$fechaFormat = $date->format('Y-m-d H:i:s');
        return $fechaFormat;
    }
	
	function ordenar_fechaServidor($date)
    {
    	$date = new DateTime($date);
		$fechaFormat = $date->format('Y-m-d');
        return $fechaFormat;
    }
    
    function ordenar_fechaHumano($date)
    {
        $explode = explode(" ", $date);
        $fecha = implode('-', array_reverse(explode('-', $explode[0])));
        return $fecha;
    }
    
    function ordenarFechaHumanoSlash($date)
    {
        $explode = explode(" ", $date);
        $fecha = implode('/', array_reverse(explode('-', $explode[0])));
        return $fecha;
    }
    
    function ordenar_fechaHoraHumano($date)
    {
        $explode = explode(" ", $date);
        $fecha[] = implode('-', array_reverse(explode('-', $explode[0])));
        $fecha[] = $explode[1];
        return implode(' ', $fecha);
    }
    
    function ahoraServidor()
    {
        return date('Y-m-d H:i:s');
    }
    
    function ahoraHumano()
    {
        return date('d-m-Y H:i:s');
    }
    
    function obtenerRut($data)
    {
        return substr((array_pop(explode('(', $data))),0, -1);
    }
    
    function ahoraHumanoMesAno()
    {
        $mes   = date('n');
        $meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'); 
        return $meses[$mes].' de '.date('Y');
    }
    
    function agregar_diasFecha($fecha,$dias, $separador = '/')
    {
        $explode = explode(" ", $fecha);
        $fecha = implode('-', array_reverse(explode('-', $explode[0])));
        $fecha = str_replace('-', '/', $fecha);
        
        list($day,$mon,$year) = explode('/',$fecha);
        return date('d'.$separador.'m'.$separador.'Y',mktime(0,0,0,$mon,$day+$dias,$year));
    }
    
    function agregar_diasFechaServidor($fecha,$dias, $separador = '/')
    {
        $explode = explode(" ", $fecha);
        $fecha = implode('-', array_reverse(explode('-', $explode[0])));
        $fecha = str_replace('-', '/', $fecha);
        
        list($day,$mon,$year) = explode('/',$fecha);
        return date('Y'.$separador.'m'.$separador.'d',mktime(0,0,0,$mon,$day+$dias,$year));
    }
    
    function diaSemana ($dia, $mes, $ano)
    {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
    } 
    
    function traerNumeroDia($dia)
    {
        $return = '';
        $dias = array(1 =>'Lunes', 2 => 'Martes', 3 =>'Miércoles', 4 =>'Jueves', 5 =>'Viernes', 6 =>'Sábado', 7 =>'Domingo');
        foreach ($dias as $key => $value)
        {
            if($value == $dia)
            {
                $return = $key;
            }
        }
        return $return;
    }
    
     function traerTextoDia($dia)
    {
        $return = '';
        $dias = array(1 =>'Lunes', 2 => 'Martes', 3 =>'Miércoles', 4 =>'Jueves', 5 =>'Viernes', 6 =>'Sábado', 7 =>'Domingo');
        foreach ($dias as $key => $value)
        {
            if($key == $dia)
            {
                $return = $value;
            }
        }
        return $return;
    }
    
    
    function traerNumeroMes($mes)
    {
        $return = '';
        $meses = array(1 =>"Enero", 2 => "Febrero",3 =>"Marzo", 4 => "Abril", 5 => "Mayo", 6 =>"Junio",
                       7 =>"Julio", 8 => "Agosto", 9 => "Septiembre",10 => "Octubre",11 => "Noviembre", 12 => "Diciembre");
        foreach ($meses as $key => $value)
        {
            if($value == $mes)
            {
                $return = $key;
            }
        }
        return $return;
    }
    
    function traerTextoMes($mes)
    {
        $return = '';
        $meses = array(1 =>"Enero", 2 => "Febrero",3 =>"Marzo", 4 => "Abril", 5 => "Mayo", 6 =>"Junio",
                       7 =>"Julio", 8 => "Agosto", 9 => "Septiembre",10 => "Octubre",11 => "Noviembre", 12 => "Diciembre");
        foreach ($meses as $key => $value)
        {
            if($key == $mes)
            {
                $return = $value;
            }
        }
        return $return;
    }
    
    function rangoFechas($fecha_inicio, $fecha_termino, $dia, $mes)
    {
        list($ano_inicio, $mes_inicio, $dia_inicio)       = explode('-', $fecha_inicio);
        list($ano_termino, $mes_termino, $dia_termino)    = explode('-', $fecha_termino);
        
        $dias_inicio  = cal_days_in_month(CAL_GREGORIAN, $mes_inicio, $ano_inicio);
        $dias_termino = cal_days_in_month(CAL_GREGORIAN, $mes_termino, $ano_termino);
        if($mes_inicio == $mes_termino)
        {
            $dia;
        }
        else
        {
            
        }
        
        
    }
    
    function traerMeses()
    {
        $return = '';
        return array(0 => 'Seleccione',1 =>"Enero", 2 => "Febrero",3 =>"Marzo", 4 => "Abril", 5 => "Mayo", 6 =>"Junio",
                     7 =>"Julio", 8 => "Agosto", 9 => "Septiembre",10 => "Octubre",11 => "Noviembre", 12 => "Diciembre");
        
    }
