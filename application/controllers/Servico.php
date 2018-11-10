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
    
    public function listar_clientes(){
        $this->load->model('Clientes_model');
        $data['clientes'] = $this->Clientes_model->get();
        $this->load->view('cliente/lista_clientes', $data);
    }

    public function cadastrar_cliente(){
        $data['message_error'] = '';
        $this->load->view('cliente/cadastro_cliente', $data);
    }

    public function cria_cliente(){
        $this->load->model('Clientes_model');

        $dados = array(
            "nome_cliente" => $this->input->post('nome'),
            "tel_cliente" => $this->input->post('tel')
        );

        if($this->Clientes_model->add('cliente', $dados)){
            $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
            Cliente cadastrado com sucesso no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $this->load->view('cliente/cadastro_cliente', $data);
        }
        else
        {
            $data['message_error'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Falha ao cadastrar Cliente no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $this->load->view('cliente/cadastro_cliente', $data);
        }

    }

    public function editar_cliente(){
        if(($this->uri->segment(3)) && is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
            $this->load->model('Clientes_model');
			$cliente = $this->Clientes_model->getCliente($id, true);
			if($cliente)
			{
				$dados['cliente'] = $cliente;
				$dados['message_error'] = '';
                $this->load->view('Cliente/cadastro_cliente', $dados);
			}
		}
    }

    public function excluir_cliente(){
        if(($this->uri->segment(3)) && is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
            $this->load->model('Clientes_model');
            $this->Clientes_model->excluir($id);
            redirect('Cliente/listar_clientes');
			
		}
    }

    public function atualizar_cliente(){
        $this->load->model('Clientes_model');

        $dados = array(
            "id_cliente" => $this->input->post('id'),
            "nome_cliente" => $this->input->post('nome'),
            "tel_cliente" => $this->input->post('tel')
        );

        $this->Clientes_model->update($dados);
        $data['message_fbdb'] = '<div class="alert alert-success alert-dismissible show" role="alert">
        Cliente atualizado com sucesso no BD!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';

        $this->load->view('Cliente/cadastro_cliente', $data);
    }
}
