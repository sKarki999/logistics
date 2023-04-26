<?php
class Account extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('AccountModel');
        $this->load->model('SetupModel');
    }

    // default method to land login view page
    public function index() {
        $this->load->view('System/login_view');
    }

    // method to validate the user
    public function login() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('user_password', 'Password', 'required');

        // print_r($_POST);
        if($this->form_validation->run()) {
            $username     = $this->input->post('user_name');
            $password     = $this->input->post('user_password');
        
            $data = [
                'user_name' => $username,
                'user_password' => $password
            ];

            $result = $this->AccountModel->userValidate($data);

            if($result) {
                // echo 'all good';
                // print_r($result);
                $user_id = $result['0']['user_id'];
                $username = $result['0']['user_name'];
                $fullname = $result['0']['full_name'];
                $user_type = $result['0']['user_type'];
                $branch_id = $result['0']['branch_id'];
                $bName = $this->SetupModel->getBranchName($branch_id);
                $branchName = $bName['branch_name'];
                $branchAddress = $bName['branch_address'];
                // print_r($branchName);
                $this->session->set_userdata('userId', $user_id);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('fullname', $fullname);
                $this->session->set_userdata('user_type', $user_type);
                $this->session->set_userdata('branchName', $branchName);
                $this->session->set_userdata('branchAddress', $branchAddress);
                $this->session->set_userdata('branch_id', $branch_id);
                $this->session->set_userdata('logged_in', true);
    
                if($user_type == 'Admin') {
                    redirect('Admin/Dashboard');
                } else {
                    redirect('Branch/Dashboard');
                }
            } else {
                $msg = "Invalid Username and password !";
                $this->session->set_flashdata('msg', $msg);
                redirect('Account');
            }

        } else {
                $this->load->view('System/login_view');
        }
    }   

    // method to log out from the system
    public function logout() {
        $this->session->sess_destroy();
        redirect('Account');
    }
}
?>