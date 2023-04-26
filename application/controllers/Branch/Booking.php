<?php
class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model("InvoiceModel");
        $this->load->model('BranchDashboardModel');
        $this->load->model('BranchModel');
        $this->load->model("LocationModel");
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    // landing page 
    public function index($currentPage =  null, $perPage = null) {
        $branch_id = $this->session->userdata("branch_id");
        // $data['bookings'] = $this->InvoiceModel->getAllInvoice($branch_id);

        // count the number of invoices
        $data['totalInvoices'] = $this->InvoiceModel->countInvoices('tbl_invoice', $branch_id);
        // print_r($data['totalInvoices']);
        // invoices to be shown per page
        if(isset($_POST['selectPerPage'])) {
            // getting perpage value submitted by form, if any
            $data['perPage'] = $_POST['selectPerPage'];
            // echo $_POST['selectPerPage'];
        } else if(!empty($perPage)) {
            // perpage passed from url, if any
            $data['perPage'] = $perPage;
        } else {
            $data['perPage'] = '7';
        }
        
        // counting pages , rouding off floating value to nearest whole number
        $data['pageCount'] = ceil($data['totalInvoices'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->InvoiceModel->getInvoicesWithPaginationByBranch($data['startPage'], $data['perPage'], $branch_id);
        
        // package status count
        $data['countPending']   = $this->InvoiceModel->countPackageStatus($branch_id, 'Pending');
        $data['countDelivered'] = $this->InvoiceModel->countPackageStatus($branch_id, 'Delivered');
        $data['countCancelled'] = $this->InvoiceModel->countPackageStatus($branch_id, 'Cancelled');
        $data['countReturned']  = $this->InvoiceModel->countPackageStatus($branch_id, 'Returned');
        $data['countFailed']    = $this->InvoiceModel->countPackageStatus($branch_id, 'Failed');
        $data['countReroute']   = $this->InvoiceModel->countPackageStatus($branch_id, 'Reroute');

        // print_r($data['result']);
        $this->load->view('System/branch/Booking_view', $data);
        
    } 

    public function search() {

        // retrieve branch id from session
        $branch_id = $this->session->userdata("branch_id");
        if(isset($_POST['searchCNN'])) {
            $data['search'] = $_POST['searchCNN'];
        } 
        // count invoices based on search parameter
        $data['result'] = $this->InvoiceModel->SearchCNN($data['search']);
        // print_r($data['result']);
        // package status count
        $data['countPending']   = $this->InvoiceModel->countPackageStatus($branch_id, 'Pending');
        $data['countDelivered'] = $this->InvoiceModel->countPackageStatus($branch_id, 'Delivered');
        $data['countCancelled'] = $this->InvoiceModel->countPackageStatus($branch_id, 'Cancelled');
        $data['countReturned']  = $this->InvoiceModel->countPackageStatus($branch_id, 'Returned');
        $data['countFailed']    = $this->InvoiceModel->countPackageStatus($branch_id, 'Failed');
        $data['countReroute']   = $this->InvoiceModel->countPackageStatus($branch_id, 'Reroute');
        $data['totalInvoices'] = $this->InvoiceModel->countInvoices('tbl_invoice', $branch_id);
        $this->load->view('System/branch/searchCNN_view', $data);
    }


    // new booking
    public function newBooking(){
        // $data['agent'] = $this->dashboardmodel->getAgent();
        // $data['consignee'] = $this->dashboardmodel->getConsignee($branch_id);
        // $data['merchandise'] = $this->dashboardmodel->getMerchandise();
        $branch_id = $this->session->userdata("branch_id");
        $data['branches'] = $this->InvoiceModel->getAllReceiverBranch($branch_id);
        $data['locations'] = $this->LocationModel->getAllLocations();
        $data['customers'] = $this->BranchDashboardModel->getCustomer($branch_id);
        $data['countries'] = $this->InvoiceModel->getAllCountries();
        $data['timezones'] = $this->LocationModel->getAllTimezones();
        // print_r($data);
        $this->load->view('System/branch/newBooking_view', $data);

    }

    // get customer address
    public function getCustomerAddress(){
        $customer_id = $this->input->post('customer_id');
        $result = $this->InvoiceModel->getColHead("tbl_customer","customer_id",$customer_id,"address");
        // print_r($result);
        $data = json_encode($result, true);
        echo $data;
    }

    // get branch location
    public function getBranchLocation(){
        $receiver_branch = $this->input->post('receiver_branch');
        $result = $this->InvoiceModel->getColHead("tbl_branch","branch_id",$receiver_branch,"branch_address");
        $data = json_encode($result, true);
        echo $data;   
    }

    public function billProcess() {

        // echo 'all good';
        $cnNo = 100001;
        $cn = $this->InvoiceModel->getCNNumber();
        if($cn){
           $cnNo = $cn['bill_number'] + 1;
        }
        $bill_no                  = $cnNo;
        $cross_no                 = $this->input->post('cross_number');
        $date                     = $this->input->post('booking_date');
        $category                 = $this->input->post('category');
        $payment_mode             = $this->input->post('mode_of_payment');
        $one_time_customer        = $this->input->post('one_time_customer_name');
        $customer_id              = $this->input->post('customer');
        $customer_address         = $this->input->post('customer_address');
        $customer_number          = $this->input->post('customer_number');
        $origin                   = $this->input->post('origin');
        $one_time_receiver_name   = $this->input->post('one_time_receiver_name');
        $receiver_branch          = $this->input->post("receiver_branch");
        $branch_address           = $this->input->post("branch_address");
        $receiver_country         = $this->input->post("receiver_country");
        $receiver_city            = $this->input->post("receiver_city");
        $receiver_state           = $this->input->post("receiver_state");
        $zip_code                 = $this->input->post("zip_code");
        $time_zone                = $this->input->post('time_zone');
        $dropOff_address          = $this->input->post('dropOff_address');
        $receiver_number          = $this->input->post('receiver_number');
        $item_type                = $this->input->post('item_type');
        $item_price               = $this->input->post('item_price');
        $weight                   = $this->input->post('weight');
        $qty                      = $this->input->post('qty');
        $rate                     = $this->input->post('rate');
        $delivery_charge          = $this->input->post('delivery_charge');
        $total_amount             = $this->input->post('total_amount');
        $mailing_mode             = $this->input->post('mailing_mode');
        $delivery_status          = $this->input->post('delivery_status');
        $description              = $this->input->post('description');
        $prepared_by              = $this->input->post('prepared_by');
        $prepared_on              = $this->input->post('prepared_on');
        $orderProcess             = uniqid(rand());

        $data = array(
            'bill_number'           => $bill_no,
            'cross_number'          => $cross_no,
            'booking_date'          => $date,
            'category'              => $category,
            'customer_id'           => $customer_id,
            'one_time_customer'     => $one_time_customer,
            'customer_address'      => $customer_address,
            'customer_number'       => $customer_number,
            'origin'                => $origin,
            'one_time_receiver'     => $one_time_receiver_name,
            'time_zone'              => $time_zone,
            'receiver_country'      => $receiver_country,
            'receiver_city'         => $receiver_city,
            'receiver_state'        => $receiver_state,
            'zip_code'              => $zip_code,
            'dropOff_address'       => $dropOff_address,
            'receiver_number'       => $receiver_number,
            'item_type'             => $item_type,
            'item_price'            => $item_price,
            'qty'                   => $qty,
            'rate'                  => $rate,
            'delivery_charge'       => $delivery_charge,
            'mailing_mode'          => $mailing_mode,
            'delivery_status'       => $delivery_status,
            'weight'                => $weight,
            'payment_mode'          => $payment_mode,
            'total'                 => $total_amount,
            'prepared_by'           => $prepared_by,
            'Prepared_on'           => $prepared_on,
            'order_entry'           => $orderProcess,
            'receiver_branch_id'    => $receiver_branch,
            'receiver_branch_address' => $branch_address,
            'branch_id'             => $this->session->userdata("branch_id"),
            'userId'                => $this->session->userdata("userId")
        );

        $result = $this->InvoiceModel->saveInvoice($data);
        if($result) {
            $message = "Booked Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Booking/newBooking");
    }

    // land to the invoice edit page
    public function editBooking($invoice_id = null) {
        $branch_id = $this->session->userdata("branch_id");
        $data['branches'] = $this->InvoiceModel->getAllReceiverBranch($branch_id);
        $data['locations'] = $this->LocationModel->getAllLocations();
        $data['customers'] = $this->BranchDashboardModel->getCustomer($branch_id);
        $data['invoice'] = $this->InvoiceModel->getInvoiceDetailsById($invoice_id);
        // $data['countries'] = $this->InvoiceModel->getAllCountries();
        // $data['timezones'] = $this->LocationModel->getAllTimezones();
        // print_r($data['invoice']);
        $this->load->view('System/Branch/editBooking_view', $data);

    }

    // get the updated data from form and update in database
    public function updateBillProcess($invoice_id) {
        // echo 'all good';
        $cross_no                 = $this->input->post('cross_number');
        $date                     = $this->input->post('booking_updated_date');
        $category                 = $this->input->post('category');
        $payment_mode             = $this->input->post('mode_of_payment');
        $one_time_customer        = $this->input->post('one_time_customer_name');
        $customer_id              = $this->input->post('customer_id');
        $customer_address         = $this->input->post('customer_address');
        $customer_number          = $this->input->post('customer_number');
        $origin                   = $this->input->post('origin');
        $one_time_receiver_name   = $this->input->post('one_time_receiver_name');
        $receiver_branch          = $this->input->post("receiver_branch");
        $branch_address           = $this->input->post("branch_address");
        $time_zone                = $this->input->post('time_zone');
        $receiver_country         = $this->input->post("receiver_country");
        $receiver_city            = $this->input->post("receiver_city");
        $receiver_state           = $this->input->post("receiver_state");
        $zip_code                 = $this->input->post("zip_code");
        $dropOff_address          = $this->input->post('dropOff_address');
        $receiver_number          = $this->input->post('receiver_number');
        $item_type                = $this->input->post('item_type');
        $item_price               = $this->input->post('item_price');
        $weight                   = $this->input->post('weight');
        $qty                      = $this->input->post('qty');
        $rate                     = $this->input->post('rate');
        $delivery_charge          = $this->input->post('delivery_charge');
        $total_amount             = $this->input->post('total_amount');
        $mailing_mode             = $this->input->post('mailing_mode');
        $delivery_status          = $this->input->post('delivery_status');
        $description              = $this->input->post('description');
        $prepared_by              = $this->input->post('prepared_by');
        $prepared_on              = $this->input->post('prepared_on');

        $data = array(
            'cross_number'          => $cross_no,
            'booking_updated_date'  => $date,
            'category'              => $category,
            'one_time_customer'     => $one_time_customer,
            'customer_id'           => $customer_id,
            'customer_address'      => $customer_address,
            'customer_number'       => $customer_number,
            'origin'                => $origin,
            'one_time_receiver'     => $one_time_receiver_name,
            'receiver_country'      => $receiver_country,
            'receiver_city'         => $receiver_city,
            'receiver_state'        => $receiver_state,
            'zip_code'              => $zip_code,
            'time_zone'              => $time_zone,
            'dropOff_address'       => $dropOff_address,
            'receiver_number'       => $receiver_number,
            'item_type'             => $item_type,
            'item_price'            => $item_price,
            'qty'                   => $qty,
            'rate'                  => $rate,
            'delivery_charge'       => $delivery_charge,
            'mailing_mode'          => $mailing_mode,
            'delivery_status'       => $delivery_status,
            'weight'                => $weight,
            'payment_mode'          => $payment_mode,
            'total'                 => $total_amount,
            'prepared_by'           => $prepared_by,
            'Prepared_on'           => $prepared_on,
            'receiver_branch_id'    => $receiver_branch,
            'receiver_branch_address' => $branch_address,
            'branch_id'             => $this->session->userdata("branch_id"),
            'userId'                => $this->session->userdata("userId")
        );

        $result = $this->InvoiceModel->updateInvoice($invoice_id, $data);
        if($result) {
            $message = "Booking updated Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Booking/newBooking");

    }

    // delete invoice based on Id
    public function deleteBooking($invoice_id) {

        if($this->InvoiceModel->deleteInvoiceById($invoice_id)) {
            $message = "Booking delete Succesfully...";
            $this->session->set_flashdata('del_msg', $message);
        }
        redirect("Branch/Booking/Booking");

    }


    // landing page to change the status of the package
    public function changeStatus($invoice_id = null) {
        $data['result'] = $this->InvoiceModel->getInvoiceDetailsById($invoice_id);
        $data['invoice'] = $invoice_id;
        // print_r($data);
        $this->load->view('System/Branch/changeStatus_view', $data);
    }

    // method to update the status
    public function updateStatus($invoice_id) {
        
        $status_updated_date    = $this->input->post('status_updated_date');
        $status                 = $this->input->Post('status');
        $package_remark         = $this->input->post('package_remark');
        $package_condition      = $this->input->Post('package_condition');


        if($status_updated_date !=  null) {
            $data = [
                'status_updated_date'   => $status_updated_date,
                'delivery_status'       => $status,
                'package_remark'        => $package_remark,
                'package_condition'     => $package_condition
            ];
        } else {
            $data = [
                'delivery_status'   => $status,
                'package_remark'    => $package_remark,
                'package_condition' => $package_condition
            ];
        }
        // print_r($data);

        $result = $this->InvoiceModel->updateStatus($data, $invoice_id);
        if($result) {
            $message = "Status Updated Succesfully...";
            $this->session->set_flashdata('msg', $message);
            redirect('Branch/Booking');
        }
    }


    // landing page for re-route process
    public function rerouteInvoice($invoice_id) {
        $branch_id          = $this->session->userdata("branch_id");
        $data['branches']   = $this->InvoiceModel->getAllReceiverBranch($branch_id);
        $data['locations']  = $this->LocationModel->getAllLocations();
        $data['customers']  = $this->BranchDashboardModel->getCustomer($branch_id);
        $data['result']     = $this->InvoiceModel->getInvoiceDetailsById($invoice_id);
        $data['invoice']    = $invoice_id;
        $data['countries'] = $this->InvoiceModel->getAllCountries();
        $data['timezones'] = $this->LocationModel->getAllTimezones();
        // print_r($data['result']);
        $this->load->view('System/Branch/reroute_view', $data);
    }

    // method to update reroute in the database
    public function updateReroute($invoice_id) {
        // $data['post']       = $_POST;
        // print_r($data);
        $cn = $this->InvoiceModel->getCnno();
        if($cn){
           $cnNo = $cn['bill_number'] + 1;
          }
        //   echo $cnNo;
        $bill_no            = $cnNo;
        $cross_no           = $this->input->post('cross_number');
        $date               = $this->input->post('booking_date');
        $category           = $this->input->post('category');
        $receiver_name      = $this->input->post('one_time_receiver_name');
        $receiver_address   = $this->input->post('receiver_address');
        $receiver_branch    = $this->input->post('receiver_branch');
        $branch_address     = $this->input->post("branch_address");
        $receiver_country   = $this->input->post("receiver_country");
        $receiver_city      = $this->input->post("receiver_city");
        $receiver_state     = $this->input->post("receiver_state");
        $zip_code           = $this->input->post("zip_code");
        $time_zone          = $this->input->post('time_zone');
        $dropOff_address    = $this->input->post('dropOff_address');
        $receiver_number    = $this->input->post('receiver_number');
        $item_price         = $this->input->post('item_price');
        $delivery_charge    = $this->input->post('delivery_charge');
        $service_charge     = $this->input->post('service_charge');
        $total_amount       = $this->input->post('total_amount');
        $mailing_mode       = $this->input->post('mailing_mode');
        $payment_mode       = $this->input->post('mode_of_payment');
        
        $invoice            = $this->InvoiceModel->getInvoiceDetailsById($invoice_id);

        $data = [
            'bill_number'           => $bill_no,
            'cross_number'          => $cross_no,
            'refno'                 => $invoice['0']['bill_number'],
            'booking_date'          => $date,
            'category'              => $category,
            'customer_id'           => $invoice['0']['customer_id'],
            'one_time_customer'     => $invoice['0']['one_time_customer'],
            'customer_address'      => $invoice['0']['customer_address'],
            'customer_number'       => $invoice['0']['customer_number'],
            'origin'                => $invoice['0']['origin'],
            'one_time_receiver'     => $receiver_name,
            'receiver_country'      => $receiver_country,
            'receiver_city'         => $receiver_city,
            'receiver_state'        => $receiver_state,
            'time_zone'             => $time_zone,
            'zip_code'              => $zip_code,
            'dropOff_address'       => $dropOff_address,
            'receiver_number'       => $receiver_number,
            'item_type'             => $invoice['0']['item_type'],
            'item_price'            => $item_price,
            'qty'                   => $invoice['0']['qty'],
            'rate'                  => $invoice['0']['rate'],
            'delivery_charge'       => $delivery_charge,
            'mailing_mode'          => $mailing_mode,
            'logistic_charge'       => $service_charge,
            'delivery_status'       => 'Pending',
            'weight'                => $invoice['0']['weight'],
            'payment_mode'          => $payment_mode,
            'total'                 => $total_amount,
            'prepared_by'           => $this->session->userdata("username"),
            'Prepared_on'           => $invoice['0']['Prepared_on'],
            'receiver_branch_id'    => $receiver_branch,
            'receiver_branch_address' => $branch_address,
            'branch_id'             => $this->session->userdata("branch_id"),
            'userId'                => $this->session->userdata("userId")

        ];

        $uData = [
            'refno'             => $bill_no,
            'delivery_status'   => 'Reroute'
        ];
        
        $result1 = $this->InvoiceModel->updateInvoice($invoice_id, $uData);
        $result2 = $this->InvoiceModel->saveInvoice($data);
        if($result1 && $result2) {
            $message = "Rerouted Succesfully...";
            $this->session->set_flashdata('msg', $message);
            redirect('Branch/Booking');
        }
        
    }

    // method to count specific packages
    public function countPackage( $status = null, $currentPage =  null, $perPage = null) {

        $branch_id = $this->session->userdata("branch_id");
        // $data['bookings'] = $this->InvoiceModel->getAllInvoice($branch_id);

        // count the number of invoices
        $data['totalInvoices'] = $this->InvoiceModel->countInvoices('tbl_invoice', $branch_id);
        // print_r($data['totalInvoices']);
        // invoices to be shown per page
        if(isset($_POST['selectPerPage'])) {
            // getting perpage value submitted by form, if any
            $data['perPage'] = $_POST['selectPerPage'];
            // echo $_POST['selectPerPage'];
        } else if(!empty($perPage)) {
            // perpage passed from url, if any
            $data['perPage'] = $perPage;
        } else {
            $data['perPage'] = '5';
        }
        
        // counting pages , rouding off floating value to nearest whole number
        $data['pageCount'] = ceil($data['totalInvoices'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->InvoiceModel->getInvoicesWithPaginationByBranchByStatus($data['startPage'], $data['perPage'], $branch_id, $status);
        $data['status'] = $status;
        // package status count
        $data['countPending']   = $this->InvoiceModel->countPackageStatus($branch_id, 'Pending');
        $data['countDelivered'] = $this->InvoiceModel->countPackageStatus($branch_id, 'Delivered');
        $data['countCancelled'] = $this->InvoiceModel->countPackageStatus($branch_id, 'Cancelled');
        $data['countReturned']  = $this->InvoiceModel->countPackageStatus($branch_id, 'Returned');
        $data['countFailed']    = $this->InvoiceModel->countPackageStatus($branch_id, 'Failed');
        $data['countReroute']   = $this->InvoiceModel->countPackageStatus($branch_id, 'Reroute');

        // print_r($data['result']);
        $this->load->view('System/branch/package_view', $data);

    }


    public function recordProcess($invoice_id) {
        // echo 'all good';
        $data['invoiceDetails'] = $this->InvoiceModel->getInvoiceDetailsById($invoice_id);
        $data['branch_info'] = $this->InvoiceModel->getRequiredBranchDetails($this->session->userdata("branch_id"));
        // print_r($data);
        $this->load->view('System/Branch/extendedPrint', $data);
    }


}

?>