<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model('Servicos_model');
        $data['equipamentos'] = $this->Equipamentos_model->get();
		$data['clientes'] = $this->Clientes_model->get();
		$data['tipo_servico'] = $this->Servicos_model->get_servico();
		$data['servicos'] = $this->Servicos_model->get();
		$this->load->view('calendar', $data);
	}
}
