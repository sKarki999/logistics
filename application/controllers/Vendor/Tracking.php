<?php

class Tracking extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        // load the models
        $this->load->model('VendorTrackingModel');
        $this->load->model('InvoiceModel');
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Vendor/Account');
        }
    }

    // method to land the tracking view page
    public function index() {
        $this->load->view('System/vendor/tracking_view');
    }

    // method to display tracking page
    public function trackingResult() {
        $data['cnno']           = $this->input->post('cnno');
        $customer_id            = $this->session->userdata('customer_id');
        // $data['booked']         = $this->VendorTrackingModel->getInvoiceByCnn($customer_id, $data['cnno']);
        $branch_id              = $this->session->userdata('branch_id');
        // $data['booked']         = $this->VendorTrackingModel->getInvoiceByCnn($customer_id, $data['cnno']);
        $data['dispatched']     = $this->VendorTrackingModel->manifestCreatedDate($data['cnno']);
        $data['arrived']        = $this->VendorTrackingModel->manifestReceivedDate($data['cnno']);
        $data['deliveryDate']   = $this->VendorTrackingModel->podDate($data['cnno']);
        $data['cnnInfo']        = $this->VendorTrackingModel->getCnnTrackInfo($data['cnno'], $branch_id, $customer_id);
        // print_r($data['cnnInfo']);
        $this->load->view('System/vendor/extendedTracking_view', $data);
    }
}
?>