<?php

class PickupList extends CI_Controller {

    public function __construct(){
        parent:: __construct();
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Driver/Account');
        }
    }

    // default method to land pickup view page
    public function index() {
        $this->load->view('System/driver/pickup_view');
    }

}
?>