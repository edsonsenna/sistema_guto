<?php
class Services_model extends CI_Model {

    
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
        $this->db->from('service');
        $this->db->join('service_type', 'service.service_type_id = service_type.service_type_id', 'right');
        
        


        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function get_serv_day($date, $one=false)
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->join('service_type', 'service.service_type_id = service_type.service_type_id', 'right');
        $this->db->join('client', 'service.client_id = client.client_id', 'right');
        $this->db->where('service_start_date >=', $date.' 00:00:00');
        $this->db->where('service_end_date <=', $date.' 23:59:59');



        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function get_service_type($id=-1, $one=false){
        $this->db->from('service_type');
        if($id!=-1){
            $this->db->where('service_type_id', $id);
        }
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

    function verify_serv($equipment_id, $start_date, $end_date, $first, $second='', $third='')
    {

        $sql = "SELECT * FROM service WHERE (LEFT(DAYNAME(service_start_date), 3) = \"".$first.
        "\" OR LEFT(DAYNAME(service_start_date), 3) = \"".$second.
        "\" OR LEFT(DAYNAME(service_start_date), 3) = \"".$third.
        "\") AND (equipment_id = ".$equipment_id.") AND (\"".$start_date->format('Y-m-d H:i').
        "\" BETWEEN service_start_date AND service_end_date OR \"".$end_date->format('Y-m-d H:i').
        "\" BETWEEN service_start_date AND service_end_date)"; 
        $query = $this->db->query($sql);

        $result =  $query->num_rows() != 0 ? false : true;

        return $result;

       
    }

    function update($equipamento)
    {
        $this->db->replace('equipamento', $equipamento);
    }

    function dar_presenca($id)
    {
       
        $this->db->set('status_presenc', 1);
        $this->db->where('servico.id_servico', $id);
        $this->db->update('servico');
        
        return true;
    }

    function excluir($id)
    {
        $this->db->delete('equipamento', array('id_equipamento' => $id));
    }




}