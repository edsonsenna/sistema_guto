<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->model('Equipamentos_model');
        $this->load->model('Clientes_model');
        $data['equipamentos'] = $this->Equipamentos_model->get();
        $data['clientes'] = $this->Clientes_model->get();
		$this->load->view('servico/cadastro_servico', $data);
    }

    public function presenca()
    {
        $today = date("Y-m-d");
        //'2019-02-05';
       
        $this->load->model('Servicos_model');
        $data['servicos'] = $this->Servicos_model->get_serv_day($today);
        $this->load->view('servico/presenca', $data);
    }

    public function dar_presenca()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Servicos_model');

            $servico = array(
                "id_servico" => $id,
                "valor_presenca" => 1
            );
            $criar_presenca = $this->Servicos_model->add('presenca',$servico);
            if($criar_presenca){
                $update_servico = $this->Servicos_model->dar_presenca($id);
                if ($update_servico) {
                    echo 'Sucesso!';
                }
            }
            else{
                echo 'Fail!';
            }
        }
    }
    
    public function novo_servico()
    {
        $this->load->model('Servicos_model');
        
        $format = 'Y-m-d H:i';
        $string_date_start = $this->input->post('dia').' '.$this->input->post('inicio');
        $string_date_end = $this->input->post('dia').' '.$this->input->post('fim');
        $date_start = DateTime::createFromFormat($format, $string_date_start);
        $date_end = DateTime::createFromFormat($format, $string_date_end);

        $num_dias = $this->input->post('dias_semana');
        $array_dias = [];
        if($this->input->post('dia_seg') != null) { array_push($array_dias, 'Mon');}
        if($this->input->post('dia_ter') != null) { array_push($array_dias, 'Tue');}
        if($this->input->post('dia_qua') != null) { array_push($array_dias, 'Wed');}
        if($this->input->post('dia_qui') != null) { array_push($array_dias, 'Thu');}
        if($this->input->post('dia_sex') != null) { array_push($array_dias, 'Fri');}
        if($this->input->post('dia_sab') != null) { array_push($array_dias, 'Sat');}
        if($this->input->post('dia_dom') != null) { array_push($array_dias, 'Sun');}
      
        $data_inicio = $date_start;


        $data_base = new DateTime($data_inicio->format('Y').'-'.$data_inicio->format('m').'-01');
        $hora_base_inicio = $this->input->post('inicio');
        $hora_base_fim = $this->input->post('fim');
        
        $data_ger = get_object_vars($date_start)['date'];
        $mes = intval(substr($data_ger,5, 6));
        
        $first = '';
        $second = '';
        $third = '';

        $id_equipamento = intval($this->input->post('equip'));
        if($array_dias[0] != null){  $first =  $array_dias[0]; }
        if(count($array_dias) >= 2 && $array_dias[1] != null){  $second = $array_dias[1]; }
        if(count($array_dias) >= 3){ if($array_dias[2] != null){ $third =  $array_dias[2]; }}
        $data_inicio = $data_base->format('Y-m-d').' '.$hora_base_inicio;

        $verif_serv = $this->Servicos_model->verifica_serv($id_equipamento, $date_start, $date_end, $first, $second, $third);

        if($num_dias == 1) {
            if($verif_serv) {
                $dados = array(
                    "id_cliente" => intval($this->input->post('cliente')),
                    "tipo_servico" => intval($this->input->post('tipo_servico')),
                    "id_usuario" => 1,
                    "pago_servico" => 1,
                    "id_equipamento" => intval($this->input->post('equip')),
                    "desconto_servico" => doubleval($this->input->post('desconto')), 
                    "data_inicio_servico" => $date_start->format('Y-m-d H:i'),
                    "data_vencimento_servico" =>  $date_end->format('Y-m-d H:i'),
                    "nome_servico" => $this->input->post('desc'),
                    "desc_servico" => $this->input->post('desc')
        
                );

                $this->Servicos_model->add('servico', $dados);
            }
        }else{
            while($mes == $data_base->format('m')){
                if($verif_serv){
                    $dados = array(
                        "id_cliente" => intval($this->input->post('cliente')),
                        "tipo_servico" => intval($this->input->post('tipo_servico')),
                        "id_usuario" => 1,
                        "pago_servico" => 1,
                        "id_equipamento" => intval($this->input->post('equip')),
                        "desconto_servico" => doubleval($this->input->post('desconto')), 
                        "data_inicio_servico" => $data_base->format('Y-m-d').' '.$hora_base_inicio,
                        "data_vencimento_servico" =>  $data_base->format('Y-m-d').' '.$hora_base_fim,
                        "nome_servico" => $this->input->post('desc'),
                        "desc_servico" => $this->input->post('desc')
            
                    );
        
                    if(in_array($data_base->format('D'), $array_dias)){
                        $this->Servicos_model->add('servico', $dados);
                        $data_base->modify('+1 day');
                    }else{
                        $data_base->modify('+1 day');
                    }
                }else{
                    break;
                }
                
            }

        }

        

        /*
        $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
        Serviço cadastrado com sucesso no BD!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        $this->load->view('calendar', $data);*/

        redirect('Welcome');
        


       
    }

    public function get_json()
    {
        $this->load->model('Servicos_model');
        $servicos = $this->Servicos_model->get();

        echo json_encode($servicos);

    }
}
