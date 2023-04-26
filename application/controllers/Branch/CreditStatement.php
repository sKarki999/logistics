<?php

class CreditStatement extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model("Setupmodel");
        $this->load->model("LocationModel");
        $this->load->model("CustomerModel");
        $this->load->model("CreditStatementModel");
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

     // default method to land credit statement view page
    public function index() {
        $branch_id = $this->session->userdata("branch_id");
        $data['location'] = $this->LocationModel->getAllLocations();
        $data['customers'] = $this->CustomerModel->getCustomer($branch_id);
        // print_r($data);
        $this->load->view('system/branch/creditstatement_view',$data);

    }

    // method to list all the data between posted dates
    public function extended($customer = null,$date_from = null,$date_to = null){
        $branch_id = $this->session->userdata("branch_id");
        $data['creditStatement'] = $this->CreditStatementModel->getRequiredCredistatement($customer,$date_from,$date_to,$branch_id);
        // print_r($data);
         $this->load->view("system/branch/creditstatementextended_view",$data);
    }

   
}