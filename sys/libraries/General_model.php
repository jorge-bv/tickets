<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		Mao_m 
 * @copyright	Copyright (c) 2014 
 * @since		Version 1.2
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter General Model Class
 *
 * Clase tipo model para las funciones mas comunes de acceso a la BD
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Mao
 * @link		
 */

class CI_General_model{

	public function __construct($config = array())
	{
		$conect_name ='';
		if (count($config) > 0)
		{
			$conect_name = $config['conect_name'];
		}
		else
		{
			$conect_name = 'default';
		}
		define('DATABASE_CONECT', $conect_name);
		log_message('debug', "General Model Class Initialized");
	}

	// --------------------------------------------------------------------

	
	/**
	 * INSERT a la Base de datos
	 *
	 * @access	public
	 * @param	
	 * @param	
	 * @return	Object
	 */
	function insert($table='', $data=array())
	{
		$last_insert_id =0;
		if($table != '')
		{
			if(count($data) > 0)
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$CI->db->insert($table, $data);
			    $last_insert_id = $CI->db->insert_id();
			}
			else 
			{
				log_message('debug', "No hay variables para insertar");
			}
		}
		return $last_insert_id;
	}
	// --------------------------------------------------------------------
	
	
	
	/**
	 * SELECT : get_row_by_pk trae una fila en base a la PK entregada
	 *
	 * @access	public
	 * @param	
	 * @param	
	 * @return	Object
	 */
	function get_row_by_pk($table='', $primary='', $select='')
	{
		$return = FALSE;
		if($table != '')
		{
			if($primary != '')
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$primary_name =$this->_get_pk($table);
				if($select == '')
				{
					$select = $this->_get_table_field($table);
				}
				$CI->db->select($select);
				$CI->db->where($primary_name, $primary);
			    $query = $CI->db->get($table);
	    		$return = $query->row();
			}
			else 
			{
				log_message('debug', "No hay variables de select");
			}
		}
		return $return;
	}
	// --------------------------------------------------------------------
	
	
	
	/**
     * SELECT : get_row_by_join trae una fila 
     *
     * @access  public
     * @param   
     * @param   
     * @return  Object
     */
    function get_row_by_join($table='', $join_table='', $join_keys=array(), $where=array())
    {
    	if(strlen($table) > 0 && strlen($join_table) > 0 && !empty($join_keys))
		{
	    	$CI =& get_instance();
	        $CI->load->database(DATABASE_CONECT);
			
	        $primary_table = $this->_get_pk($table);
	        $select_primary_table = $this->_get_tables_field_alias($table);
	        $select_join_table = $this->_get_tables_field_alias($join_table);
	        $select = $select_primary_table.$select_join_table;
			$CI->db->select($select);
			$CI->db->from($table);
			$CI->db->join($join_table, $table.'.'.key($join_keys).'='.$join_table.'.'.current($join_keys));
			foreach ($where as $key => $value) 
	        {
	            $CI->db->where($key, $value);
	        }
	        $query = $CI->db->get();
	        $return = $query->row();
		}
		else{
			log_message('debug','Faltan datos para el metodo "get_row_by_join"');
		}
		return $return;
    }
     
    
	/**
	 * SELECT : get_value_by_pk trae un valor especifico en base a la PK entregada
	 *
	 * @return	Object
	 */
	
	function get_value_by_pk($table='', $primary='', $value='')
	{
		$return= FALSE;
		if($table != '')
		{
			if($value != '' && $primary !='')
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$primary_name =$this->_get_pk($table);
				
				$CI->db->select($value);
				$CI->db->where($primary_name, $primary);
			    $query = $CI->db->get($table);
	    		$return = $query->row()->$value;
			}
			else 
			{
				log_message('debug', "No hay variables de select");
			}
		}
		return $return;
	}
	// --------------------------------------------------------------------
	
	
	/**
	 * SELECT : get_row_by_where trae una fila  en base los atributos dados (where de sql)
	 *
	 * @return	Object
	 */
	function get_row_by_where($table='', $where=array(), $select='')
	{
		$return = FALSE;
		if($table != '')
		{
			if(count($where) > 0)
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				if($select == '')
				{
					$select = $this->_get_table_field($table);
				}
				$CI->db->select($select);
				foreach ($where as $key => $value) 
				{
					$CI->db->where($key, $value);
				}

			    $query = $CI->db->get($table);
	    		$return = $query->row();
			}
			else 
			{
				log_message('debug', "Faltan datos");
			}
		}
		return $return;
	}
	 
	function get_result_by_where($table='', $where=array(), $select='', $order=array())
	{
		$return = FALSE;
		if($table != '')
		{
			if(count($where) > 0)
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				if($select == '')
				{
					$select = $this->_get_table_field($table);
				}
			
				$CI->db->select($select);
				foreach ($where as $key => $value) 
				{
					$CI->db->where($key, $value);
				}
				foreach ($order as $key => $value) 
				{
					$CI->db->order_by($key, $value);
				}
			    $query = $CI->db->get($table);
		    	$return = $query->result();
			}
			else 
			{
				log_message('debug', "Faltan datos");
			}
		}
		return $return;
	}
    
    /**
     * SELECT : get_row_by_pk trae una fila en base a la PK entregada
     *
     * @access  public
     * @param   
     * @param   
     * @return  Object
     */
        
    function get_result_by_join($table='', $join_table='', $join_keys=array(), $where=array(), $order=Array())
    {
    	$return = FALSE;
    	if(strlen($table) > 0 && strlen($join_table) > 0 && !empty($join_keys))
		{
	        $CI =& get_instance();
	        $CI->load->database(DATABASE_CONECT);
			
	        $primary_table = $this->_get_pk($table);
	        $select_primary_table = $this->_get_tables_field_alias($table);
	        $select_join_table = $this->_get_tables_field_alias($join_table);
	        $select = $select_primary_table.$select_join_table;
			$CI->db->select($select);
			$CI->db->from($table);
			$CI->db->join($join_table, $table.'.'.key($join_keys).'='.$join_table.'.'.current($join_keys));
			foreach ($where as $key => $value) 
	        {
	            $CI->db->where($key, $value);
	        }
			foreach ($order as $key => $value) 
			{
				$CI->db->order_by($key, $value);
			}
	        $query = $CI->db->get();
	        $return = $query->result();
		}
		return $return;
    }
    // --------------------------------------------------------------------
    
	
	function get_value_by_where($table, $where=array(), $get_value='')
	{
		$return = FALSE;
		if($table != '')
		{
			if($get_value != '' && count($where) > 0)
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$CI->db->select($get_value);
				foreach ($where as $key => $value) 
				{
					$CI->db->where($key, $value);
				}
				$query = $CI->db->get($table);
	    		$return = $query->row()->$get_value;
			}
			else 
			{
				log_message('debug', "Faltan datos");
			}
		}
		return $return;
	}
	
	function get_table($table='', $select='', $order=array())
	{		
		$return = FALSE;
		if($table != '')
		{
			
			$CI =& get_instance();
			$CI->load->database(DATABASE_CONECT);
			
			if($select == '')
			{
				$select = $this->_get_table_field($table);
			}
			$CI->db->select($select);
			foreach ($order as $key => $value) 
			{
				$CI->db->order_by($key, $value);
			}
			
		    $query = $CI->db->get($table);
    		$return = $query->result();
			
		}
		return $return;	
	}

	// --------------------------------------------------------------------
	/**
	 * UPDATE a la Base de datos
	 *
	 * @access	public
	 * @param	
	 * @param	
	 * @return	Boolean
	 */
			
	function update_row($table='', $set=array(), $primary='')
	{		
		$return  = FALSE;
		$primary_name='';
		if($table != '')
		{
			if(count($set) > 0 && $primary != '')
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$primary_name =$this->_get_pk($table);
				
				$CI->db->where($primary_name , $primary); 
				$CI->db->update($table, $set);
				$return = $CI->db->affected_rows();
			}
			else 
			{
				log_message('debug', "No hay variables de select");
			}
		}
		return $return;	
	}
	
	function update_row_by_where($table='', $set=array(), $where=array())
	{		
		$return  = FALSE;
		$numeric = FALSE;
		if($table != '')
		{
			if(count($set) > 0 && count($where) > 0)
			{
				
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				foreach ($where as $key => $value) 
				{
					$CI->db->where($key, $value);
				}
				$CI->db->update($table, $set);
				$return = $CI->db->affected_rows();
			}
			else 
			{
				log_message('debug', "No hay variables de select");
			}
		}
		return $return;	
	}
	
	function update_table($table='', $set=array())
	{		
		$return = FALSE;
		if($table != '')
		{
			if(count($set) > 0 )
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$CI->db->update($table, $set);
				$return = $CI->db->affected_rows();
			}
			else 
			{
				log_message('debug', "No hay variables de select");
			}
		}
		return $return;	
	}

	// --------------------------------------------------------------------
	/**
	 * DELETE a la Base de datos
	 *
	 * @access	public
	 * @param	
	 * @param	
	 * @return	Boolean
	 */
	
	function delete_row($table='', $primary='')
	{		
		$return = FALSE;
		$primary_name='';
		if($table != '')
		{
			if($primary != '')
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$primary_name =$this->_get_pk($table);
				
				$CI->db->where($primary_name , $primary); 
				$CI->db->delete($table);
				$return = $CI->db->affected_rows();
			}
			else 
			{
				log_message('debug', "No hay variables de select");
			}
		}
		return $return;	
	}
	
	function delete_row_by_where($table='', $where=array())
	{		
		$return = FALSE;
		if($table != '')
		{
			if(count($where) > 0)
			{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				foreach ($where as $key => $value) 
				{
					$CI->db->where($key, $value);
				}
				$CI->db->delete($table);
				$return = $CI->db->affected_rows();
			}
			else 
			{
				log_message('debug', "No hay variables de where");
			}
		}
		return $return;	
	}
	
	function clean_table($table='')
	{		
		$return = FALSE;
		if($table != '')
		{
				$CI =& get_instance();
				$CI->load->database(DATABASE_CONECT);
				
				$primary_name =$this->_get_pk($table);
				
				$CI->db->where($primary_name.' !=' , 0);
				$CI->db->delete($table);
				$return = $CI->db->affected_rows();
		}
		return $return;	
	}

	// --------------------------------------------------------------------
	/**
	 * Busca la PK de la entidad seleccionada
	 *
	 * @access	protected
	 * @param	
	 * @param	
	 * @return	String
	 */

	protected function _get_pk($table)
	{
		$primary_name='';
		if($table!='')
		{
			$CI =& get_instance();
			$field_data = $CI->db->field_data($table);
			foreach ($field_data as $key => $value) 
			{
				if($value->primary_key)
				{
					$primary_name = $value->name;
				}
			}
		}
		return $primary_name;
	}
	// --------------------------------------------------------------------
	
	
	/**
	 * Busca los nombres de los campos de la entidad seleccionada
	 *
	 * @access	protected
	 * @param	
	 * @param	
	 * @return	String
	 */	
	protected function _get_table_field($table)
	{
		$fields='';
		if($table!='')
		{
			$CI =& get_instance();
			$field_data = $CI->db->field_data($table);
			foreach ($field_data as $key => $value) 
			{
				$fields .= $value->name.', ';
			}
		}
		$fields = trim($fields, ',');
		return $fields;
	}
    // --------------------------------------------------------------------
    
    
    /**
     * Busca los nombres de los campos de la entidad seleccionada añadiendo un alias
     *
     * @access  protected
     * @param   
     * @param   
     * @return  String
     */ 
    protected function _get_tables_field_alias($table)
    {
        $fields='';
        if(strlen($table) > 0)
        {
            $CI =& get_instance();
           
            $field_data = $CI->db->field_data($table);
            foreach ($field_data as $key => $value) 
            {
            	$fields .= $table.'.'.$value->name.' AS '.$table.'_'.$value->name.' , ';
            }
        }
        $fields = trim($fields, ',');
        return $fields;
    }
	
    protected function _get_pk_table($tables= array())
    {
        $fields='';
        if(count($tables) > 0)
        {
            $CI =& get_instance();
            foreach ($tables as $alias => $table_name) 
            {
                $field_data = $CI->db->field_data($table_name);
                foreach ($field_data as $key => $value) 
                {
                    if($value->primary_key)
                    {
                        $primary_name = $alias.'.'.$value->name;
                    }
                }
            }
        }
        return $primary_name;
    }
	
}