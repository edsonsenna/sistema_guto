<?php
class Clients_model extends CI_Model {

    
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
        $this->db->from('client');


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function get_client($id, $one=false){
        $this->db->from('client');
        $this->db->where('client_id', $id);


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function busca_nome($client_name, $one=false){
        $this->db->from('client');
        $this->db->like('client_name', $nome_cliente);

        $query = $this->db->get();
        $result = !$one ? $query->result() : $query->row();
        return $result;
    }

    function update($client)
    {
        $this->db->replace('client', $client);
    }

    function delete($id)
    {
        $this->db->delete('client', array('client_id' => $id));
    }




}