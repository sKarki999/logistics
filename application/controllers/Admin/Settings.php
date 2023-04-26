<?php

class Settings extends CI_Controller {
    // constructor
    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('SettingsModel');
        // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            true;
        } else {
            redirect('Account');
        }
    }

     // default method
    public function index() {
        $data['settings'] = $this->SettingsModel->getSettings(); 
        $this->load->view('System/Setup/settings_view', $data);
    }

    public function updateSettings($id) {
    
        // load validation library
        $this->load->library('form_validation');
        // set validation rules
        $this->form_validation->set_rules('business_name', 'Business Name', 'required');
        $this->form_validation->set_rules('business_address', 'Business Address', 'required');
        $this->form_validation->set_rules('business_contact', 'Contact', 'required');
        $this->form_validation->set_rules('business_url', 'URL', 'required');
        $this->form_validation->set_rules('business_email', 'Email', 'required');
     
        if($this->form_validation->run()) {

            $business_name = $this->input->post("business_name");
            $business_address = $this->input->post("business_address");
            $business_contact = $this->input->post("business_contact");
            $business_url = $this->input->post("business_url");
            $business_email = $this->input->post("business_email");

            $data = [
                'business_name'     => $business_name,
                'business_address'  => $business_address,
                'business_contact'  => $business_contact,
                'business_url'      => $business_url,
                'business_email'    => $business_email,
            ];
            
            $result = $this->SettingsModel->update('tbl_business_info', $data, $id, 'id');
            if($result) {
                $message = "Settings updated Succesfully...";
                $this->session->set_flashdata('msg', $message);
                redirect('Admin/Settings');
            }
        } else {
            redirect('Admin/Settings');
        }


    }


}

?>