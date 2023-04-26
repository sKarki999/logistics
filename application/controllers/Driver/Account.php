<?php

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AccountModel');
        $this->load->model('BranchModel');
        $this->load->model('SetupModel');
    }

    // default method to land login page
    public function index() {
        $data['branches'] = $this->BranchModel->getAllBranches();
        $this->load->view('System/driver/login_view', $data);
    }

    // method to validate driver
    public function login() {
        
            $username     = $this->input->post('username');
            $password     = $this->input->post('password');
            $branch       = $this->input->post('branch');

            $data = [
                'username'    => $username,
                'password'    => $password,
                'branch_id'   => $branch
            ];

            $result = $this->AccountModel->driverValidate($data);
            // print_r($result);
            if($result) {
                $id             = $result['0']['id'];
                $name           = $result['0']['name'];
                $address        = $result['0']['address'];
                $contact        = $result['0']['contact'];
                $email          = $result['0']['email'];
                $branch_id      = $result['0']['branch_id'];
                $bName          = $this->SetupModel->getBranchName($branch_id);
                $branchName     = $bName['branch_name'];

                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('name', $name);
                $this->session->set_userdata('address', $address);
                $this->session->set_userdata('contact', $contact);
                $this->session->set_userdata('email', $email);
                $this->session->set_userdata('branchName', $branchName);
                $this->session->set_userdata('branch_id', $branch_id);
                $this->session->set_userdata('logged_in', true);

                redirect('Driver/Dashboard');

            } else {
                $msg = "Invalid Details !";
                $this->session->set_flashdata('msg', $msg);
                redirect('Driver/Account');
            }
    }

    // method to logout from the system
    public function logout() {
        $this->session->sess_destroy();
        redirect('Driver/Account');
    }

}
?>