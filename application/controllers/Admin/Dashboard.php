<?php

class Dashboard extends CI_Controller {
    
    // constructor
    public function __construct(){
        parent:: __construct();
        // load the model
        $this->load->model('AdminDashboardModel');
        // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Account');
        }
    }

    // default method
    public function index() {
        $data['totalBranch']    = $this->AdminDashboardModel->count('tbl_branch');
        $data['totalLocation']  = $this->AdminDashboardModel->count('tbl_location');
        $data['totalUser']      = $this->AdminDashboardModel->count('tbl_users');
        $this->load->view('System/Setup/dashboard_view', $data);
    }
}
?>