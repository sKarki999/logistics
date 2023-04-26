<?php
class DailySales extends CI_Controller {

    public function __construct() {
        parent::__construct();
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    public function index() {
        $this->load->view('System/branch/dailysales_view');
    }
}

?>