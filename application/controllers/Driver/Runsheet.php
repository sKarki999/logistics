<?php

class Runsheet extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        // load the required models
        $this->load->model('DeliveryRunsheetModel');
        $this->load->model('RunsheetModel');
         // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')== true) {
            true;
        } else {
            redirect('Driver/Account');
        }
    }

    // default method to land runsheet view page
    public function index() {
        $data['id'] = $this->session->userdata('id');
        $data['runsheets'] = $this->DeliveryRunsheetModel->getAllRunsheetsForDriverById($data['id']);
        // echo $id;
        // print_r($data);
        $this->load->view('System/driver/runsheet_view',$data);
    }

    // method to change the status
    public function changeStatus() {

        $cnno = $this->input->post("cnn");
        $id = $this->session->userdata('id');
        
        if(!$cnno) {
            $message = "Please tick the parcel you want to update ...";
            $this->session->set_flashdata('error', $message);
            $id        = $this->session->userdata('id');
            $data['runsheets'] = $this->DeliveryRunsheetModel->getAllRunsheetsForDriverById($id);
            $this->load->view('System/driver/runsheet_view',$data);
        } else {
            $data['runsheets'] = $this->DeliveryRunsheetModel->getAllRunsheetsForDriverById($id);
            foreach($cnno as $cnn) {
                // echo $cnn."<br />". $id;
                $data['deliveryDetails'] = $this->DeliveryRunsheetModel->getAllDetailsForDriverByIdByCnn($id, $cnn);
                // print_r($data['deliveryDetails']);
                $receiver   = $data['runsheets']['0']['receiver'];
                $address    = $data['runsheets']['0']['address'];
                $contact    = $data['runsheets']['0']['contact'];     
                // echo $contact;
                $status     = 'Delivered';
                $delivered_date = date("Y-m-d H:i:s");

                    $data = [
                        'driver_id'         =>  $id,
                        'receiver'          =>  $receiver,
                        'address'           =>  $address,
                        'contact'           =>  $contact,
                        'delivered_date'    =>  $delivered_date,
                        'status'            =>  $status,
                        'cnno'              => $cnn
                    ];
                
                $checkCnnExists   = $this->DeliveryRunsheetModel->checkCnn($id, $cnn);
                if($checkCnnExists) {
                    $result = $this->DeliveryRunsheetModel->updateDetails($data, $cnn);
                } else {
                    $result = $this->DeliveryRunsheetModel->saveDetails($data);
                }

                if($result) {

                    $data1 = ['status' => 'Delivered'];
                    $result1 = $this->RunsheetModel->updateStatus($data1, $cnn);

                    $message = "Operation completed Succesfully...";
                    $this->session->set_flashdata('msg', $message);
                    redirect("Driver/Runsheet");
                }
            }
        }
    }

    // method to view all the runsheet based on driver id
    public function masterRecord() {
        $id = $this->session->userdata('id');
        $data['details'] = $this->DeliveryRunsheetModel->getCnnByStatusByDriverId($id);
        $this->load->view('System/driver/master_runsheet_view', $data);
    }

    
}
?>