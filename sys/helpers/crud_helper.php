<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Crud Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		mao
 * @link		none
 */

// ------------------------------------------------------------------------

/**
 * Despliegue de la Entidad
 *
 * Crea una tabla con todos los registros
 *
 * @access	public
 * @param	string	entidad 
 * @param	string	datos extras tipo class o id
 * @param	array	a key/value para los atributos de la tabla
 * @return	string 
 */
if ( ! function_exists('table_display'))
{
	function table_display($entidad= '', $extra='', $atributos= array())
	{
		$display = '';
		$select= '';
		$as='';
		if($entidad != '')
		{
			$CI =& get_instance();
			$CI->load->database('default');
			//$CI->load->helper('form_helper');
			if(count($atributos) > 0)
			{
				foreach ($atributos as $key => $value) 
				{
					if(is_numeric($key))
					{
						$as = '';
						$select .= "$value $as ,";
					}
					else 
					{
						$as = ' "'.$value.'"';
						$select .= "$key $as ,";
					}
					
				}
				
				$CI->db->select($select);
				$query = $CI->db->get($entidad);
				$result = $query->result_array();
				$cabeceras  = $query->list_fields($entidad);
			}
			else
			{
				$query = $CI->db->get($entidad);
				$result = $query->result_array();
				$cabeceras  = $CI->db->list_fields($entidad);
			}
			
			$display .= '<table '.$extra.'><thead>';
			foreach ($cabeceras as $key => $value) 
			{
				$display .= '<th>';
				$display .= ucwords(str_replace('_', ' ', $value));
				$display .= '</th>';
			}
			
			$display .= '</thead> <tbody>';
			foreach ($result as $key => $value) 
			{
				$display .= '<tr>';
				foreach ($value as  $data) 
				{
					$display .= '<td>'.str_replace('_', ' ', $data).'</td>';	
				}
				$display .= '</tr>';
			}
			$display .= '</tbody> </table>';
		}
		return $display;
	}
}
 
// ------------------------------------------------------------------------


/**
 * Despliegue de la Entidad
 *
 * Crea una tabla con todos los registros
 *
 * @access	public
 * @param	string	entidad 
 * @param	string	datos extras tipo class o id
 * @param	array	a key/value para los atributos de la tabla
 * @return	string 
 */

if ( ! function_exists('table_display_crud'))
{
	function table_display_crud($entidad= '', $extra='', $atributos= array())
	{
		$display = '';
		$select  = '';
		$as      = '';
		$primary = '';

		if($entidad != '')
		{
			$CI =& get_instance();
			$CI->load->database('default');
			////$CI->load->helper('form_helper');
			if($CI->db->table_exists($entidad))
			{
				$field_data = $CI->db->field_data($entidad);
				foreach ($field_data as $key => $value) 
				{
					if($value->primary_key)
					{
						$primary = $value->name;
					}
				}
				$CI->db->select($primary);
				$query = $CI->db->get($entidad);
				$list_id = $query->result();
				if(count($atributos) > 0)
				{
					foreach ($atributos as $key => $value) 
					{
						if(is_numeric($key))
						{
							$as = '';
							$select .= "$value $as ,";
						}
						else 
						{
							$as = ' "'.$value.'"';
							$select .= "$key $as ,";
						}
					}
		
					$CI->db->select($select);
					$query = $CI->db->get($entidad);
					$result = $query->result_array();
	
					$cabeceras  = $query->list_fields($entidad);
				}
				else
				{
					$query = $CI->db->get($entidad);
					$result = $query->result_array();
					$cabeceras  = $CI->db->list_fields($entidad);
				}
				
				$display .= '<table '.$extra.'><thead>';
				foreach ($cabeceras as $value) 
				{
					$display .= '<th>';
					$display .= ucwords(str_replace('_', ' ', $value));
					$display .= '</th>';
				}
				
				$display .= '</thead> <tbody>';
				foreach ($result as $key => $value) 
				{
					$display .= '<tr>';
					foreach ($value as $field => $data) 
					{
						$display .= '<td>'.str_replace('_', ' ', $data).'</td>';
						$id = $list_id[$key]->$primary;
					}
					$display .= '<td><div class="btn-group">
								  <button type="button" class="btn btn-default" onclick="accion(\'var_mas\', '.$id.')" id="var_mas">Ver Más</button>
								  <button type="button" class="btn btn-default" onclick="accion(\'editar\' , '.$id.')" id="editar">Editar</button>
								  <button type="button" class="btn btn-default" onclick="accion(\'borrar\' , '.$id.')" id="borrar">Borrar</button>
								</div><td>';
					$display .= '</tr>';
				}
				$display .= '</tbody></table>';
			}
			else 
			{
				$display = "La tabla <b>'$entidad'</b> no existe";
			}
		}
		return $display;
	}
}


// ------------------------------------------------------------------------
/**
 *   Edita los datos de la entidad en base a su PK
 *
 * @access	public
 * @param	string	entidad 
 * @param	string	datos extras tipo class o id
 * @param	array	a key/value para los atributos de la tabla
 * @param	boolean	despliegue de la PK 
 * @return	string 
 */

if ( ! function_exists('row_edit'))
{
	function row_edit($entidad='', $primary='', $extra='', $atributos=array(), $primary_display=FALSE)
	{
		$display = '';
		$select  = '';
		$primary_name ='';
		$cont=0;

		if($entidad != '')
		{
			$CI =& get_instance();
			$CI->load->database('default');
			$CI->load->helper('form_helper');
			if($CI->db->table_exists($entidad))
			{
				$field_data = $CI->db->field_data($entidad);
				foreach ($field_data as $key => $value) 
				{
					if($value->primary_key)
					{
						$primary_name = $value->name;
					}
				}
				if(count($atributos) > 0 && $atributos != '')
				{
					foreach ($atributos as $key => $value) 
					{
						foreach ($atributos as $key => $value) 
						{
							if(is_numeric($key))
							{
								$as = '';
								$select .= "$value ,";
								$cabeceras[] = $value;
							}
							else 
							{
								$as = ' "'.$value.'"';
								$select .= "$key $as ,";
								$cabeceras[] = $key;
							}
						}
					}
					$CI->db->select($primary_name.', '.$select);
					$CI->db->where($primary_name, $primary);
					$query = $CI->db->get($entidad);
					$result = $query->row_array();
					$display .= '<table '.$extra.'><tbody>';
					foreach ($result as $key => $value) 
					{
						++$cont;
						if($primary_name == $key)
						{
							$display .= '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
						}
						if($primary_name == $key && $primary_display)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
							$display .= '<td>'.$value.'</td>';	
							$display .= '</tr>';
						}
						elseif($primary_name != $key)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
							$display .= '<td><input type="text" name="'.$cabeceras[$cont-1].'" value="'.$value.'" /> </td>';	
							$display .= '</tr>';
						}
					}
				}
				else
				{
					$CI->db->where($primary_name, $primary);
					$query = $CI->db->get($entidad);
					$result = $query->row_array();
					$display .= '<table '.$extra.'><tbody>';
					foreach ($result as $key => $value) 
					{
						++$cont;
						if($primary_name == $key)
						{
							$display .= '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
						}
						if($primary_name == $key && $primary_display)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).'</td>';
							$display .= '<td>'.$value.'</td>';	
							$display .= '</tr>';
						}
						elseif($primary_name != $key)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
							$display .= '<td><input type="text" name="'.$key.'" value="'.$value.'" /></td>';	
							$display .= '</tr>';
						}
					}
				}
				$display .= '</tbody></table>';
			}
			else 
			{
				$display = 'La tabla <b> "'.$entidad.'"</b> no existe';
			}
		}
		return $display;
	}
}


// ------------------------------------------------------------------------
/**
 *   Ficha de un objeto de la entidad
 *
 * @access	public
 * @param	string	entidad 
 * @param	string	datos extras tipo class o id
 * @param	array	a key/value para los atributos de la tabla
 * @param	boolean	despliegue de la PK 
 * @return	string 
 */

if ( ! function_exists('row_display'))
{
	function row_display($entidad='', $primary='', $extra='', $atributos=array(), $primary_display=FALSE)
	{
		$display = '';
		$select  = '';
		$primary_name ='';
		$cont=0;

		if($entidad != '')
		{
			$CI =& get_instance();
			$CI->load->database('default');
			//$CI->load->helper('form_helper');
			if($CI->db->table_exists($entidad))
			{
				$field_data = $CI->db->field_data($entidad);
				foreach ($field_data as $key => $value) 
				{
					if($value->primary_key)
					{
						$primary_name = $value->name;
					}
				}
				
				if(count($atributos) > 0 && $atributos != '')
				{
					foreach ($atributos as $key => $value) 
					{
						if(is_numeric($key))
						{
							$as = '';
						}
						else 
						{
							$as = ' "'.$key.'"';
						}
						
						$select .= "$value $as ,";
						$cabeceras[] = $value;
					}
					$CI->db->select($select);
					$CI->db->where($primary_name, $primary);
					$query = $CI->db->get($entidad);
					$result = $query->row_array();
					
					$display .= '<table '.$extra.'><tbody>';
					foreach ($result as $key => $value) 
					{
						++$cont;
						if($primary_name == $key && $primary_display)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).'</td>';
							$display .= '<td>'.$value.'</td>';	
							$display .= '</tr>';
						}
						elseif($primary_name != $key)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
							$display .= '<td>'.$value.'</td>';	
							$display .= '</tr>';
						}
					}
				}
				else
				{
					$CI->db->where($primary_name, $primary);
					$query = $CI->db->get($entidad);
					$result = $query->row_array();
					$display .= '<table '.$extra.'><tbody>';
					foreach ($result as $key => $value) 
					{
						++$cont;
						if($primary_name == $key && $primary_display)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
							$display .= '<td>'.$value.'</td>';	
							$display .= '</tr>';
						}
						elseif($primary_name != $key)
						{
							$display .= '<tr>';
							$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
							$display .= '<td>'.$value.'</td>';	
							$display .= '</tr>';
						}
					}
				}
				$display .= '</tbody></table>';
			}
			else 
			{
				$display = 'La tabla <b> "'.$entidad.'"</b> no existe';
			}
		}
		return $display;
	}
}


// ------------------------------------------------------------------------
/**
 *   Ficha de una vista
 *
 * @access	public
 * @param	string	entidad
 * @param	array	a key/value para el where de la vista 
 * @param	string	datos extras tipo class o id
 * @param	array	a key/value para los atributos de la tabla
 * @param	boolean	despliegue de la PK 
 * @return	string 
 */

if ( ! function_exists('ficha_views'))
{
	function row_views($entidad='', $primarys=array(), $extra='', $atributos=array())
	{
		$display = '';
		$select  = '';
		$primary_name ='';
		$cont=0;

		if($entidad != '')
		{
			$CI =& get_instance();
			$CI->load->database('default');
			//$CI->load->helper('form_helper');
			if($CI->db->table_exists($entidad))
			{
				$field_data = $CI->db->field_data($entidad);
				foreach ($field_data as $key => $value) 
				{
					if($value->primary_key)
					{
						$primary_name = $value->name;
					}
				}
				
				if(count($atributos) > 0 && $atributos != '')
				{
					foreach ($atributos as $key => $value) 
					{
						if(is_numeric($key))
						{
							$as = '';
						}
						else 
						{
							$as = ' "'.$key.'"';
						}
						
						$select .= "$value $as ,";
						$cabeceras[] = $value;
					}
					$CI->db->select($select);
					foreach ($primarys as $key => $value) 
					{
						$CI->db->where($key, $value);
					}
					$query = $CI->db->get($entidad);
					$result = $query->row_array();
					
					$display .= '<table '.$extra.'><tbody>';
					foreach ($result as $key => $value) 
					{
						$display .= '<tr>';
						$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
						$display .= '<td>'.$value.'</td>';	
						$display .= '</tr>';
					}
				}
				else
				{
					foreach ($primarys as $key => $value) 
					{
						$CI->db->where($key, $value);
					}
					$query = $CI->db->get($entidad);
					$result = $query->row_array();
					
					$display .= '<table '.$extra.'><tbody>';
					foreach ($result as $key => $value) 
					{
						$display .= '<tr>';
						$display .= '<td>'.ucwords(str_replace('_', ' ', $key)).' </td>';
						$display .= '<td>'.$value.'</td>';	
						$display .= '</tr>';
					}
				}
				$display .= '</tbody></table>';
			}
			else 
			{
				$display = 'La tabla <b> "'.$entidad.'"</b> no existe';
			}
		}
		return $display;
	}
}


// ------------------------------------------------------------------------


/* End of file crud_helper.php */
/* Location: ./system/helpers/crud_helper.php */
