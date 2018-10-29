<?php
class Clientes_model extends CI_Model {

    
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
        $this->db->from('cliente');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getCliente($id, $one=false){
        $this->db->from('cliente');
        $this->db->where('id_cliente', $id);


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function update($cliente)
    {
        $this->db->replace('cliente', $cliente);
    }

    function excluir($id)
    {
        $this->db->delete('cliente', array('id_cliente' => $id));
    }




}