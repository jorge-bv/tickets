<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function validar_cliente($remember_token='')
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('id');
        $CI->db->from('clientes');
		$CI->db->where('remember_token', ''.$remember_token.'');
		$CI->db->where('activo', TRUE);
        $query = $CI->db->get();
		$id = $query->row()->id;
		if(empty($id))
		{
			$CI->session->unset_userdata('token_cliente');	
			response.redirect("/");
		}
		else 
		{
			return $id;
		}
	}
	
	function validar_empresa($usuario_id)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('empresas_id');
        $CI->db->from('clientes');
		$CI->db->where('id', $usuario_id);
		$CI->db->where('activo', TRUE);
        $query = $CI->db->get();
		$empresas_id = $query->row()->empresas_id;
		return $empresas_id;
	}
	
	function validar_agente($remember_token='')
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('id');
        $CI->db->from('agentes');
		$CI->db->where('remember_token', ''.$remember_token.'');
		$CI->db->where('activo', TRUE);
        $query = $CI->db->get();
		$id = $query->row()->id;
		if(empty($id))
		{
			$CI->session->unset_userdata('token_agente');	
			response.redirect("/");
		}
		else 
		{
			return $id;
		}
	}
	
	function validar_admin($remember_token='')
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('id');
        $CI->db->from('backoffices');
		$CI->db->where('remember_token', ''.$remember_token.'');
		$CI->db->where('activo', TRUE);
        $query = $CI->db->get();
		$id = $query->row()->id;
		if(empty($id))
		{
			$CI->session->unset_userdata('token_admin');	
			response.redirect("login/admin");
		}
		else 
		{
			return $id;
		}
	}
	