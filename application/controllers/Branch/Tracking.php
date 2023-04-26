<?php
class Tracking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('TrackingModel');
        $this->load->model('InvoiceModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    public function index() {
        $this->load->view('System/branch/tracking_view');
    }


    public function trackingResult() {
        
        $data['cnno']           = $this->input->post('cnno');
        $branch_id              = $this->session->userdata('branch_id');
        $data['booked']         = $this->InvoiceModel->getInvoiceByCnn($branch_id, $data['cnno']);
        $data['dispatched']     = $this->TrackingModel->manifestCreatedDate($data['cnno']);
        $data['arrived']        = $this->TrackingModel->manifestReceivedDate($data['cnno']);
        $data['deliveryDate']   = $this->TrackingModel->podDate($data['cnno']);
        $data['cnnInfo']        = $this->TrackingModel->getCnnTrackInfo($data['cnno'], $branch_id);
        // print_r($data);
        $this->load->view('System/branch/extendedtracking_view', $data);

    }

}

?>