<?php
    class inicio_model extends CI_Model
    {
    	function __construct()
        {
            parent::__construct();
        }
        
		protected function _get_table_field($table, $alias)
		{
			$fields='';
			if($table!='')
			{
				$CI =& get_instance();
				$field_data = $CI->db->field_data($table);
				foreach ($field_data as $key => $value) 
				{
					if (empty($alias)) {
						$fields .= $value->name.', ';
					} else {
						$fields .= $alias.'.'.$value->name.', ';
					}
				}
			}
			$fields = trim($fields, ',');
			return $fields;
		}
    }