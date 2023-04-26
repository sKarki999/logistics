<?php

class Order extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        // load the models
        $this->load->model('VendorOrderModel');
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Vendor/Account');
        }
    }

    // default method to view orders
    public function index() {
        $customer_id = $this->session->userdata('customer_id');
        // package status count
        $data['totalInvoices']  = $this->VendorOrderModel->countInvoices('tbl_invoice', $customer_id);
        $data['countPending']   = $this->VendorOrderModel->countPackageStatus($customer_id, 'Pending');
        $data['countDelivered'] = $this->VendorOrderModel->countPackageStatus($customer_id, 'Delivered');
        $data['countCancelled'] = $this->VendorOrderModel->countPackageStatus($customer_id, 'Cancelled');
        $data['countReturned']  = $this->VendorOrderModel->countPackageStatus($customer_id, 'Returned');
        $data['countFailed']    = $this->VendorOrderModel->countPackageStatus($customer_id, 'Failed');
        $data['countReroute']   = $this->VendorOrderModel->countPackageStatus($customer_id, 'Reroute');
        $data['orders']         = $this->VendorOrderModel->getAllOrdersByCustomerId($customer_id);
        // print_r($data['orders']);
        $this->load->view('System/vendor/order_view', $data);
    }

    // method to count specific packages
    public function countPackage($status = null) {
        
        $customer_id = $this->session->userdata("customer_id");
        $data['totalInvoices']  = $this->VendorOrderModel->countInvoices('tbl_invoice', $customer_id);
        $data['countPending']   = $this->VendorOrderModel->countPackageStatus($customer_id, 'Pending');
        $data['countDelivered'] = $this->VendorOrderModel->countPackageStatus($customer_id, 'Delivered');
        $data['countCancelled'] = $this->VendorOrderModel->countPackageStatus($customer_id, 'Cancelled');
        $data['countReturned']  = $this->VendorOrderModel->countPackageStatus($customer_id, 'Returned');
        $data['countFailed']    = $this->VendorOrderModel->countPackageStatus($customer_id, 'Failed');
        $data['countReroute']   = $this->VendorOrderModel->countPackageStatus($customer_id, 'Reroute');
        $data['status'] = $status;
        $data['orders'] = $this->VendorOrderModel->getInvoicesByCustomerByStatus($customer_id, $status);
        
        // print_r($data['result']);
        $this->load->view('System/vendor/package_view', $data);

    }

}
?>