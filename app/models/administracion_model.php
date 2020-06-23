<?php
    class administracion_model extends CI_Model
    {   
        
         function getid($param) {
        $this->db->select('id');
         $this->db->from('hd_backoffices');
        $this->db->where('correo',$param);
         $query = $this->db->get();
    return $query->row();
                
        
    }
    }