<?php
class Pickup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('BranchDashboardModel');
        $this->load->model('PickupModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('login');
        }

    }

    // default method
    public function index() {
        
        $branch_id = $this->session->userdata("branch_id");
        $data['customers'] = $this->BranchDashboardModel->getCustomer($branch_id);
        // $data['employee'] = $this->setupmodel->getAllEmployee($branch_id);
        $data['requestMessages'] = $this->PickupModel->getPickupRequest($branch_id);
        // print_r($data);
        $this->load->view("System/branch/pickup_received_view", $data);    

    }

    // method to save pickup request
    public function addPickupRequest() {
        $prno = 1001;
        $cn = $this->PickupModel->getPickUpRequestNumber();
        if($cn) {
            $prno = $cn['prno'] + 1;
        }
        $prno = $prno;
        $branch_id      = $this->session->userdata('branch_id');
        $pickup_date    = $this->input->post("pickup_date");
        $pickup_time    = $this->input->post("pickup_time");
        $customer       = $this->input->post("customer");
        $pickup_address = $this->input->post("pickup_address");
        $pickup_contact = $this->input->post("pickup_contact");
        $total_packet   = $this->input->post("total_packet");
        $total_weight   = $this->input->post("total_weight");

        $data = [
            'prno'          => $prno,
            'customer_id'   => $customer,
            'address'       => $pickup_address,
            'contact'       => $pickup_contact,
            'b_id'          => $branch_id,
            'pickup_date'   => $pickup_date,
            'pickup_time'   => $pickup_time,
            'total_packet'  => $total_packet,
            'total_weight'  => $total_weight
        ];

        // print_r($data);
        $result = $this->PickupModel->savePickupRequest($data);
        if($result) {
            $message = "Pickup Request updated Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Pickup");

    }

}
?>