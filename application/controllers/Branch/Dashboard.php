<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('BranchDashboardModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    // default method to land dashboard page
    public function index() {   
        $branch_id = $this->session->userdata('branch_id');
        $data['totalBookings'] = $this->BranchDashboardModel->count('tbl_invoice', $branch_id);
        $data['totalCustomers'] = $this->BranchDashboardModel->count('tbl_customer', $branch_id);
        $data['totalDrivers'] = $this->BranchDashboardModel->count('tbl_employee', $branch_id);
        // print_r($data);
        $this->load->view('System/branch/branch_dashboard_view', $data);
    }
}

?>