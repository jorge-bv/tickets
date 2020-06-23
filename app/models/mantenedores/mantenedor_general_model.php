<?php 
				 //Modelo
    class mantenedor_general_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }
		
		function crear($data, $tabla)
		{		
			$this->db->insert($tabla, $data);
		    $id = $this->db->insert_id();
			return $id;
		}
		
		function traer_tabla($tabla, $primary)
		{		
			$this->db->select($primary.', nombre');
			$query = $this->db->get($tabla);
		    return $query->result();
		}
		
		function traer_tabla_por_id($tabla, $id, $primary)
		{		
			$this->db->where($primary , $id); 
			$query = $this->db->get($tabla);
		    return $query->result();
		}
		
		function traer_todo($tabla)
		{		
			$query = $this->db->get($tabla);
		    return $query->result();
		}
		
		function actualizar($id, $data, $tabla, $primary)
		{
			$this->db->where($primary , $id); 
			$this->db->update($tabla, $data); 
			return 1;	
		}
		
		function traer_ficha($id, $tabla, $primary)
		{
			$this->db->where($primary , $id); 
			$query = $this->db->get($tabla);
		    return $query->row();	
		}
		
		function traer_nombre($id, $tabla, $primary)
		{
			$this->db->select('nombre'); 
			$this->db->where($primary , $id); 
			$query = $this->db->get($tabla);
		    return $query->row()->nombre;	
		}
		
		function eliminar($id, $tabla, $primary)
		{
			$this->db->where($primary , $id); 
			$this->db->delete($tabla); 
			return 1;	
		}
}
