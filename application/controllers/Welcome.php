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
		$this->load->model('Equipments_model');
		$this->load->model('Clients_model');
		$this->load->model('Services_model');
		$data['equipments'] = $this->Equipments_model->get();
		$data['places'] = $this->Equipments_model->get_places();
		$data['clients'] = $this->Clients_model->get();
		$data['service_type'] = $this->Services_model->get_service_type();
		$data['services'] = $this->Services_model->get();
		$this->load->view('calendar', $data);
	}
}
