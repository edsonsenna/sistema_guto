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

    function get_serv_day($date, $one=false)
    {
        $this->db->select('*');
        $this->db->from('servico');
        $this->db->join('tipo_servico', 'servico.tipo_servico = tipo_servico.id_tipo_servico', 'right');
        $this->db->join('cliente', 'servico.id_cliente = cliente.id_cliente', 'right');
        $this->db->where('data_inicio_servico >=', $date.' 00:00:00');
        $this->db->where('data_inicio_servico <=', $date.' 23:59:59');



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

    function verifica_serv($id_equipamento, $data_inicio, $data_fim, $first, $second='', $third='')
    {

        $sql = "SELECT * FROM servico WHERE (LEFT(DAYNAME(data_inicio_servico), 3) = \"".$first.
        "\" OR LEFT(DAYNAME(data_inicio_servico), 3) = \"".$second.
        "\" OR LEFT(DAYNAME(data_inicio_servico), 3) = \"".$third.
        "\") AND (id_equipamento = ".$id_equipamento.") AND (\"".$data_inicio->format('Y-m-d H:i').
        "\" BETWEEN data_inicio_servico AND data_vencimento_servico OR \"".$data_fim->format('Y-m-d H:i').
        "\" BETWEEN data_inicio_servico AND data_vencimento_servico)"; 
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