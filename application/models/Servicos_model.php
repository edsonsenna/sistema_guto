<?php
class Servicos_model extends CI_Model {

    
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
        $this->db->select('*');
        $this->db->from('servico');
        $this->db->join('tipo_servico', 'servico.tipo_servico = tipo_servico.id_tipo_servico', 'right');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function get_servico($one=false){
        $this->db->from('tipo_servico');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getEquipamento($id, $one=false){
        $this->db->from('equipamento');
        $this->db->where('id_equipamento', $id);


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function update($equipamento)
    {
        $this->db->replace('equipamento', $equipamento);
    }

    function excluir($id)
    {
        $this->db->delete('equipamento', array('id_equipamento' => $id));
    }




}