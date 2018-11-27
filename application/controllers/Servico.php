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
        
        $format = 'Y-d-m H:i';
        $string_date_start = $this->input->post('dia').' '.$this->input->post('inicio');
        $string_date_end = $this->input->post('dia').' '.$this->input->post('fim');
        $date_start = DateTime::createFromFormat($format, $string_date_start);
        $date_end = DateTime::createFromFormat($format, $string_date_end);


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

        var_dump($dados);
        

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

       
    }
}
