<?php

class Dashboard extends CI_Controller {

    public function __construct(){
        parent:: __construct();
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Driver/Account');
        }
    }

    // default method to land dashboard page
    public function index() {
        $this->load->view('System/driver/dashboard_view');
    }
}
?>