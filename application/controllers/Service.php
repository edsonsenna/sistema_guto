<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

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
        $data['equipments'] = $this->Equipments_model->get();
        $data['clients'] = $this->Clients_model->get();
		$this->load->view('service/new_service', $data);
    }

    public function new_presence()
    {
        $today = date("Y-m-d");
        //'2019-02-05';
       
        $this->load->model('Services_model');
        $data['services'] = $this->Services_model->get_serv_day($today);
        $this->load->view('service/presence', $data);
    }

    public function create_presence()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Services_model');

            $presence = array(
                "service_id" => $id,
                "presence_bool" => '1'
            );
            $success_presence = $this->Services_model->add('presence', $presence);
            if($success_presence){
                $update_service = $this->Services_model->presence($id);
                if ($update_service) {
                    echo 'Sucesso!';
                }
            }
            else{
                echo 'Fail!';
            }
        }
    }
    
    public function new_service()
    {
        $this->load->model('Services_model');
        
        $format = 'Y-m-d H:i';
        $string_date_start = $this->input->post('dia').' '.$this->input->post('inicio');
        $string_date_end = $this->input->post('dia').' '.$this->input->post('fim');
        $date_start = DateTime::createFromFormat($format, $string_date_start);
        $date_end = DateTime::createFromFormat($format, $string_date_end);

        $num_days = $this->input->post('dias_semana');
        $array_days = [];
        if($this->input->post('dia_seg') != null) { array_push($array_days, 'Mon');}
        if($this->input->post('dia_ter') != null) { array_push($array_days, 'Tue');}
        if($this->input->post('dia_qua') != null) { array_push($array_days, 'Wed');}
        if($this->input->post('dia_qui') != null) { array_push($array_days, 'Thu');}
        if($this->input->post('dia_sex') != null) { array_push($array_days, 'Fri');}
        if($this->input->post('dia_sab') != null) { array_push($array_days, 'Sat');}
        if($this->input->post('dia_dom') != null) { array_push($array_days, 'Sun');}
      
        $date_new = $date_start;


        $date_base = new DateTime($date_new->format('Y').'-'.$date_new->format('m').'-01');
        $hour_base_start = $this->input->post('inicio');
        $hour_base_end = $this->input->post('fim');
        
        $date_ger = get_object_vars($date_start)['date'];
        $mes = intval(substr($date_ger,5, 6));
        
        $first = '';
        $second = '';
        $third = '';

        $equipment_id = intval($this->input->post('equip'));
        if($array_days[0] != null){  $first =  $array_days[0]; }
        if(count($array_days) >= 2 && $array_days[1] != null){  $second = $array_days[1]; }
        if(count($array_days) >= 3){ if($array_days[2] != null){ $third =  $array_days[2]; }}
        $date_inicio = $date_base->format('Y-m-d').' '.$hour_base_start;

        $verify_serv = $this->Services_model->verify_serv($equipment_id, $date_start, $date_end, $first, $second, $third);

        if($num_days == 1) {
            if($verify_serv) {
                $service = array(
                    "client_id" => intval($this->input->post('cliente')),
                    "service_type_id" => intval($this->input->post('tipo_servico')),
                    "user_id" => 1,
                    "equipment_id" => intval($this->input->post('equip')),
                    "discount_value" => doubleval($this->input->post('desconto')), 
                    "service_start_date" => $date_start->format('Y-m-d H:i'),
                    "service_end_date" =>  $date_end->format('Y-m-d H:i'),
                    "service_name" => $this->input->post('desc'),
                    "service_color" => "#9699E8"
        
                );

                $this->Services_model->add('service', $service);
            }
        }else{
            while($mes == $date_base->format('m')){
                if($verify_serv){
                    $service = array(
                        "client_id" => intval($this->input->post('cliente')),
                        "service_type_id" => intval($this->input->post('tipo_servico')),
                        "user_id" => 1,
                        "equipment_id" => intval($this->input->post('equip')),
                        "discount_value" => doubleval($this->input->post('desconto')), 
                        "service_start_date" => $date_base->format('Y-m-d').' '.$hour_base_start,
                        "service_end_date" =>  $date_base->format('Y-m-d').' '.$hour_base_end,
                        "service_name" => $this->input->post('desc'),
                        "service_color" => "#9699E8"
            
                    );
        
                    if(in_array($date_base->format('D'), $array_days)){
                        $this->Services_model->add('service', $service);
                        $date_base->modify('+1 day');
                    }else{
                        $date_base->modify('+1 day');
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
        $this->load->model('Services_model');
        $services = $this->Services_model->get();

        echo json_encode($services);

    }

    public function get_json_places()
    {
        $this->load->model('Services_model');
        $places = $this->Services_model->get_places();
        echo json_encode($places);

    }

    public function get_json_service_type()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Services_model');
            $services = $this->Services_model->get_service_type_select($id);
            echo json_encode($services);
        }
    }

    public function get_json_equipment()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Services_model');
            $services = $this->Services_model->get_equipment_select($id);
            echo json_encode($services);
        }
    }

    public function delete_service_type()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Services_model');
            $this->Services_model->delete_service_type($id);
            redirect('Service/list_service_type');

        }
    }

    public function new_service_type()
    {

        $this->load->model('Services_model');

        $service_type = array(
            "service_type_description" => $this->input->post('description'),
            "service_type_value" => $this->input->post('value')
        );

        if($this->Services_model->add('service_type', $service_type)){
            $this->session->set_flashdata('message_fdbd','<div class="alert alert-success alert-dismissible show" role="alert">
            Tipo serviço cadastrado com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
           
        }else{
            $this->session->set_flashdata('message_fdbd','<div class="alert alert-danger alert-dismissible show" role="alert">
            Falha ao cadastrar tipo servico
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }
        redirect('Service');
    }

    public function search_type()
    {
        $this->load->model('Services_model');
        $data['service_type'] = $this->Services_model->get_service_type();

        $this->load->view('service/list_service_type', $data);
    }

    public function edit_service_type()
    {
        if (($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) {
            $id = $this->uri->segment(3);
            $this->load->model('Services_model');
            $type_service = $this->Services_model->get_service_type($id, true);
            if ($type_service) {
                $data['type_service'] = $type_service;
                $data['message_error'] = '';
                $this->load->view('Service/new_service', $data);
            }
        }
    }

    public function update_service_type()
    {
        $this->load->model('Services_model');

        $service_type = array(
            "service_type_id" => $this->input->post('id'),
            "service_type_description" => $this->input->post('description'),
            "service_type_value" => $this->input->post('value')
        );

        if($this->Services_model->update('service_type', $service_type)){
            $this->session->set_flashdata('message_fdbd','<div class="alert alert-success alert-dismissible show" role="alert">
            Tipo serviço cadastrado com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
           
        }else{
            $this->session->set_flashdata('message_fdbd','<div class="alert alert-danger alert-dismissible show" role="alert">
            Falha ao cadastrar tipo servico
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }
        redirect('Service');
    }
}
