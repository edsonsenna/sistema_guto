<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('calendar');
    }

    public function list_clients()
    {
        $this->load->model('Clients_model');
        $data['clients'] = $this->Clients_model->get();
        $this->load->view('client/list_clients', $data);
    }

    public function new_payment()
    {
        $this->load->model('Clients_model');
        $data['clients'] = $this->Clients_model->get();
        $this->load->view('client/payment', $data);
    }

    public function throw_payment()
    {
        $this->load->model('Clients_model');
        $payment = array(
            "client_id" => $this->input->post('cliente'),
            "payment_value" => $this->input->post('valor'),
            "payment_date" => $this->input->post('data').' '.$this->input->post('hora') 
         );
        if($this->Clients_model->add('payment', $payment))
        {
            redirect('Client/list_clients');
        }
            redirect('Client/new_payment');
    }

    public function busca_cliente()
    {
        $nome_cliente = $this->input->post('nome');
        $this->load->model('Clientes_model');
        $clientes = $this->Clientes_model->busca_nome($nome_cliente);
        $retorno = array();
        foreach($clientes as $c){
            array_push($retorno, $c);
        }
        echo json_encode($retorno);
    }

    public function new_client()
    {
        $data['message_error'] = '';
        $this->load->view('client/new_client', $data);
    }

    public function create_client()
    {
        $this->load->model('Clients_model');

        $dados = array(
            "client_name" => $this->input->post('nome'),
            "client_telephone" => $this->input->post('tel'),
            "client_email" => $this->input->post('email'),
            "client_birthday" => $this->input->post('birthday').' 00:00:00'
        );

        if ($this->Clients_model->add('client', $dados)) {
            $data['message_error'] = '<div class="alert alert-success alert-dismissible show" role="alert">
            Cliente cadastrado com sucesso no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $this->load->view('client/new_client', $data);
        } else {
            $data['message_error'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Falha ao cadastrar Cliente no BD!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $this->load->view('client/new_client', $data);
        }

    }

    public function edit_client()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Clients_model');
            $client = $this->Clients_model->get_client($id, true);
            if ($client) {
                $dados['client'] = $client;
                $dados['message_error'] = '';
                $this->load->view('Client/new_client', $dados);
            }
        }
    }

    public function delete_client()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Clients_model');
            $this->Clients_model->delete($id);
            redirect('Client/list_clients');

        }
    }

    public function update_client()
    {
        $this->load->model('Clients_model');

        $dados = array(
            "client_id" => $this->input->post('id'),
            "client_name" => $this->input->post('nome'),
            "client_telephone" => $this->input->post('tel'),
            "client_email" => $this->input->post('email'),
            "client_birthday" => $this->input->post('birthday').' 00:00:00',
            "client_balance" => $this->input->post('balance')
        );

        $this->Clients_model->update($dados);
        $data['message_fbdb'] = '<div class="alert alert-success alert-dismissible show" role="alert">
        Cliente atualizado com sucesso no BD!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';

        $this->load->view('Client/new_client', $data);
    }
}
