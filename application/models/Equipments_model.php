<?php
class Equipments_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
    }

    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }

    function get($one=false){
        $this->db->from('equipment');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function get_places($one=false){
        $this->db->from('place');
        $query = $this->db->get();
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function get_equipment($id, $one=false){
        $this->db->from('equipment');
        $this->db->where('equipment_id', $id);


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }



    function update($equipment)
    {
        $this->db->replace('equipment', $equipment);
    }

    function excluir($id)
    {
        $this->db->delete('equipment', array('equipment_id' => $id));
    }




}