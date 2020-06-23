<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function enviar_correo($data_mail, $debug = FALSE)
	{
	    //$data_mail['para'] = '';
	    //$data_mail['remitente'] = "";
	    //$data_mail['usuario']   = "";
	    $CI =& get_instance();
	    $config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
	    $CI->load->library('email', $config);
		 
	    if(!empty($data_mail['attach']))
	    {
	    	$CI->email->clear(TRUE);
	        foreach ($data_mail['attach'] as $key => $value)
	        {
	            $CI->email->attach($value['path'], 'attachment', $value['file_name']);   
	        }
	    }
	    $CI->email->to($data_mail['para']); 
	    $CI->email->from($data_mail['remitente'], $data_mail['usuario']);
		if(!empty($data_mail['bcc_remitente']))
	    {
	    	$CI->email->bcc($data_mail['bcc_remitente']);
		}
	    $CI->email->subject($data_mail['asunto']);
	    $CI->email->message($data_mail['mensaje']);
	    
	    $CI->email->send();
	    if($debug)
		{
			echo $CI->email->print_debugger();
		}
	}
	
    function enviar_correo_sendgrid($data)
	{
	    //$data['para'] = '';
	    $data['remitente'] = "soporte@hitch.cl";
	    $data['usuario']   = "Soporte Hitch";
	    $CI =& get_instance();
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$CI->load->library('email', $config);
		
		$CI->email->initialize(array(
		  'protocol' => 'smtp',
//                    smtp.sendgrid.net
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_user' => 'soporte@hitch.cl',
		  'smtp_pass' => 'Ccom2k15@@',
		  'smtp_port' => '465',
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));
	    if(!empty($data['attach']))
	    {
	        foreach ($data['attach'] as $key => $value)
	        {
	            $CI->email->attach($value);   
	        }
	    }
	    $CI->email->to($data['para']); 
	    $CI->email->from($data['remitente'], $data['usuario']);
	   // $CI->email->bcc($data['remitente']);
	    $CI->email->subject($data['asunto']);
	    $CI->email->message($data['mensaje']);
	    
	    $CI->email->send();
	    //echo $CI->email->print_debugger(); 
	    //die();
	    
	}
