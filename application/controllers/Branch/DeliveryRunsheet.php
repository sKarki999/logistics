<?php
class DeliveryRunsheet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('RunsheetModel');
        $this->load->model('InvoiceModel');
        $this->load->model('EmployeeModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    // default method
    public function index() {
        $data['runsheet_number'] = $this->RunsheetModel->runsheetNumber();
        $branch_id               = $this->session->userdata('branch_id');
        $data['drivers']         = $this->EmployeeModel->getEmployeesByDesignationAndByBranch('Driver', $branch_id);
        // print_r($data);
        $this->load->view('System/branch/createRunsheet_view', $data);
    }

    // method to get required cnn
    public function getRequiredCnn() {
        $branch_id = $this->session->userdata('branch_id');
        $cnNo = $this->input->post('cn');
        $result = $this->RunsheetModel->getCnn($branch_id, $cnNo);
        if($result){
            $data = json_encode($result);
            echo $data;
        }else{
            echo '0';
        }
    }

    // method to save runsheet
    public function saveRunsheet() {

        $runsheet_date      = $this->input->post('runsheet_date');
        $runsheet_number    = $this->input->post('runsheet_number');
        $branch             = $this->session->userdata('branch_id');
        $deliveryPersonnel  = $this->input->post('delivery_personnel');

        $data = array (
            'runsheet_created_date'     => $runsheet_date,
            'runsheet_number'           => $runsheet_number,
            'delivery_personnel'        => $deliveryPersonnel,
            'branch_id'                 => $branch
        );

        $result1 = $this->RunsheetModel->saveRunsheet($data);

        // save to master runsheet details
        $cnNo           = $this->input->post('cnno');
        $receiver_name  = $this->input->post('receiver_name');
        $address        = $this->input->post('address');
        $contact        = $this->input->post('contact');
        $booked_date    = $this->input->post('booked_date');
        $weight         = $this->input->post('weight');
        $qty            = $this->input->post('qty');
        $total          = count($cnNo);

        for ($i=0; $i<$total; $i++) {

            if($cnNo[$i]) {
                $runsheetData = array(
                    'r_id'           => $result1,
                    'rsno'                  => $runsheet_number,
                    'cnno'                  => $cnNo[$i],
                    'receiver'              => $receiver_name[$i],
                    'address'               => $address[$i],
                    'contact'               => $contact[$i],
                    'booked_on'             => $booked_date[$i],
                    'c_branch'              => $branch,
                    'delivery_personnel_id' => $deliveryPersonnel,
                    'created_date'          => $runsheet_date,
                    'status'                => 'Pending'
                );
                $data = array (
                    'runsheet_no' => $runsheet_number
                );
            }
            // print_r($manifestData);
            $result2 = $this->RunsheetModel->saveRunsheetDetails($runsheetData);
            $result3 = $this->InvoiceModel->updateOneFieldInInvoice($data, $cnNo[$i]);
        }

        if($result1 && $result2 && $result3) {
            $message = "Delivery Runsheet created Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/DeliveryRunsheet");

    }

    // method to view saved runsheets
    public function masterRunsheet() {
        $branch_id = $this->session->userData('branch_id');
        $data['runsheets'] = $this->RunsheetModel->getAllRunsheets($branch_id);
        // print_r($data);
        $this->load->view('System/Branch/runsheetDetail_view', $data);
    }
}
?>