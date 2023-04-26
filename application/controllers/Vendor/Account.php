<?php

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('AccountModel');
        $this->load->model('SetupModel');
    }
    
    // default method to land the login page
    public function index() {
        $this->load->view('System/vendor/login_view');
    }

    // method to validate the customer
    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // print_r($_POST);
        if($this->form_validation->run()) {

            $username     = $this->input->post('username');
            $password     = $this->input->post('password');
            $data = [
                'username' => $username,
                'password' => $password
            ];
            $result = $this->AccountModel->customerValidate($data);

            if($result) {
                $customer_id    = $result['0']['customer_id'];
                $customer_name  = $result['0']['customer_name'];
                $cu_user    	= $result['0']['cu_user'];
                $branch_id      = $result['0']['branch_id'];
                $bName          = $this->SetupModel->getBranchName($branch_id);
                $branchName     = $bName['branch_name'];

                $this->session->set_userdata('customer_id', $customer_id);
                $this->session->set_userdata('cu_user', $cu_user);
                $this->session->set_userdata('customer_name', $customer_name);
                $this->session->set_userdata('branchName', $branchName);
                $this->session->set_userdata('branch_id', $branch_id);
                $this->session->set_userdata('logged_in', true);

                redirect('Vendor/Dashboard');

            } else {
                $msg = "Invalid Username or password !";
                $this->session->set_flashdata('msg', $msg);
                redirect('Vendor/Account');
            }
        } else {
            $this->load->view('System/vendor/login_view');
        }

    }

    // method to logout from the system
    public function logout() {
        $this->session->sess_destroy();
        redirect('Vendor/Account');
    }

}
?>