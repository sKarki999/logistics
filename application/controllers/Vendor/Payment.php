<?php
class Payment extends CI_Controller {

    public function __construct(){
        parent:: __construct();
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Vendor/Account');
        }
    }

    // default method to land payment view page
    public function index() {
        $this->load->view('System/vendor/payment_view');
    }
}
?>