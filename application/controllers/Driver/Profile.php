<?php

class Profile extends CI_Controller {

    public function __construct(){
        parent:: __construct();
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Driver/Account');
        }
    }

    public function index() {
        $this->load->view('System/driver/profile_view');
    }
}
?>