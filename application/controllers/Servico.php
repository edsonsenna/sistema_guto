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
    
    public function novo_servico()
    {
        $this->load->model('Servicos_model');
        
        $format = 'Y-m-d H:i';
        $string_date_start = $this->input->post('dia').' '.$this->input->post('inicio');
        $string_date_end = $this->input->post('dia').' '.$this->input->post('fim');
        $date_start = DateTime::createFromFormat($format, $string_date_start);
        $date_end = DateTime::createFromFormat($format, $string_date_end);

        $num_dias = $this->input->post('dias_semana');
        $seg = $this->input->post('dia_seg');
        $ter = $this->input->post('dia_ter');
        $qua = $this->input->post('dia_qua');
        $qui = $this->input->post('dia_qui');
        $sex = $this->input->post('dia_sex');
        $sab = $this->input->post('dia_sab');
        $dom = $this->input->post('dia_dom');

        $data_inicio = $date_start;

        //var_dump($date_start);

        $data_base = new DateTime($data_inicio->format('Y').'-'.$data_inicio->format('m').'-01');
        $hora_base_inicio = $this->input->post('inicio');
        $hora_base_fim = $this->input->post('fim');
        
        $data_ger = get_object_vars($date_start)['date'];
        /*
        var_dump($ter);
        var_dump($qua);
        var_dump($data_base->format('D'));
        $data_base->modify('+1 day');
        var_dump($data_base);
        while(intval(substr($data_ger,5, 6)) == $data_base->format('m')){
            var_dump($data_base);
            if(strcmp($ter, $data_base->format('D') == 0)) { echo 'Terça';}
            if(strcmp($qui, $data_base->format('D') == 0)) { echo 'Quinta';}
            $data_base->modify('+1 day');
        }
        */

        $mes = intval(substr($data_ger,5, 6));
        /*
        var_dump($mes);
        var_dump($mes == $data_base->format('m'));
        $data_base->modify('+1 month');
        var_dump($mes == $data_base->format('m'));
        var_dump($seg);
        var_dump($data_base->format('D'));
        var_dump(strcmp($seg, 'Mon'));
        */
        while($mes == $data_base->format('m')){
            if(strcmp($seg, $data_base->format('D')) == 0 ){
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

                $this->Servicos_model->add('servico', $dados);

                $data_base->modify('+1 day');
            }
            else if(strcmp($ter, $data_base->format('D')) == 0 ){
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

                $this->Servicos_model->add('servico', $dados);

                $data_base->modify('+1 day');
            }
            else if(strcmp($qua, $data_base->format('D')) == 0  ){
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

                $this->Servicos_model->add('servico', $dados);

                $data_base->modify('+1 day');
            }
            else if(strcmp($qui, $data_base->format('D')) == 0 ){
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

                $this->Servicos_model->add('servico', $dados);

                $data_base->modify('+1 day');
            }
            else if(strcmp($sex, $data_base->format('D')) == 0 ){
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

                $this->Servicos_model->add('servico', $dados);

                $data_base->modify('+1 day');
            }
            else if(strcmp($sab, $data_base->format('D')) == 0 ){
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

                $this->Servicos_model->add('servico', $dados);

                $data_base->modify('+1 day');
            }
            else if(strcmp($dom, $data_base->format('D')) == 0 ){
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

                $this->Servicos_model->add('servico', $dados);

                $data_base->modify('+1 day');
            }else
            {
                $data_base->modify('+1 day');
            }


        }

        $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
        Serviço cadastrado com sucesso no BD!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        $this->load->view('calendar', $data);
        
         //////////////////////////////////////
        /*
        $dados = array(
            "id_cliente" => intval($this->input->post('cliente')),
            "tipo_servico" => intval($this->input->post('tipo_servico')),
            "id_usuario" => 1,
            "pago_servico" => 1,
            "id_equipamento" => intval($this->input->post('equip')),
            "desconto_servico" => doubleval($this->input->post('desconto')), 
            "data_inicio_servico" => get_object_vars($date_start)['date'],
            "data_vencimento_servico" => get_object_vars($date_end)['date'],
            "nome_servico" => $this->input->post('desc'),
            "desc_servico" => $this->input->post('desc')

        );

  
        

        if ($this->Servicos_model->add('servico', $dados)) {
            $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
            Serviço cadastrado com sucesso no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $this->load->view('calendar', $data);
        } else {
            $data['message_error'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Falha ao cadastrar Serviço no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $this->load->view('calendar', $data);
        }
        */

       
    }

    public function get_json()
    {
        $this->load->model('Servicos_model');
        $servicos = $this->Servicos_model->get();

        echo json_encode($servicos);

    }
}
