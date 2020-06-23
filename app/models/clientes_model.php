<?php
    class clientes_model extends CI_Model
    {   
		public function traer_comentarios($solicitud_id)
		{
		    $this->db->select('cli.nombre cliente, age.nombre agente, c.descripcion, c.create,c.img_1');
            $this->db->from('comentarios c');
		    $this->db->join('clientes cli', 'cli.id = c.clientes_id', LEFT);
			$this->db->join('agentes age', 'age.id = c.agentes_id', LEFT);
            $this->db->where('c.solicitudes_id', $solicitud_id);
			$this->db->order_by('c.id', 'desc');
			$query = $this->db->get();
            
    	    return $query->result();
		}

		  function get_all_usuarios()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('hd_clientes')->result_array();
    }
    
    function getid($param) {
        $this->db->select('id');
         $this->db->from('hd_clientes');
        $this->db->where('correo',$param);
         $query = $this->db->get();
    return $query->row();
                
        
    }
    function update($id, $nombre=  array())
{
    $this->db->where('id', $id);
    
    $this->db->update('hd_clientes',$nombre);
}

    }