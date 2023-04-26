<?php

class Pod extends CI_Controller {

    public function __construct(){
        parent:: __construct();
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Driver/Account');
        }
    }

    // default method to land pod view page
    public function index() {
        $branch_id    = $this->session->userData('branch_id');
        $data['pods'] = $this->PodModel->getAllPod($branch_id);
        // print_r($data);
        $this->load->view('System/driver/pod_view');
    }

}
?>