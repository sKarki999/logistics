<?php
class ManifestReceived extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('ManifestReceivedModel');
        $this->load->model('BranchModel');
        $this->load->model('ManifestModel');
        $this->load->model('InvoiceModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    // default method
    public function index() {
        $branch_id = $this->session->userdata('branch_id');
        $data['branches']        = $this->InvoiceModel->getAllReceiverBranch($branch_id);
        $data['manifest_number'] = $this->ManifestModel->manifestNumber(); 
        $this->load->view('System/branch/createManifestReceived_view', $data);
    }

    // method to get required manifest
    public function getRequiredManifest(){
        $branch_id          = $this->session->userdata("branch_id");
        $cnNo               = $this->input->post('cn');
        $sender_branch      = $this->input->post('sender_branch');
        $result             = $this->ManifestReceivedModel->getManifest($cnNo,$sender_branch);
        // print_r($result);
        if($result){
            $data = json_encode($result);
            echo $data;
        }else{
            echo '0';
        }
        
    }

    // method to save manifest
    public function saveReceivedManifest() {
        // print_r($_POST);
        $manifest_date      = $this->input->post('manifest_date');
        $manifest_number    = $this->input->post('manifest_number');
        $sender_branch      = $this->input->post('sender_branch');
        $receiver_branch    = $this->session->userdata('branch_id');
        
        $data = array (
            'manifest_received_date'        => $manifest_date,
            'manifest_received_number'      => $manifest_number,
            'receiver_branch'               => $receiver_branch,
            'sender_branch'                 => $sender_branch 
        );

        $result1 = $this->ManifestReceivedModel->saveReceivedManifest($data);

        // save to master manifest details
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
                $manifestData = array(
                    'master_id'                 => $result1,
                    'mrno'                      => $manifest_number,
                    'cnno'                      => $cnNo[$i],
                    'receiver'                  => $receiver_name[$i],
                    'address'                   => $address[$i],
                    'contact'                   => $contact[$i],
                    'manifest_received_date'    => $booked_date[$i],
                    'weight'                    => $weight[$i],
                    'qty'                       => $qty[$i],
                    'sender_branch_id'          => $sender_branch,
                    'receiver_branch_id'        => $receiver_branch
                );
                $data = array (
                    'manifest_received_number' => $manifest_number
                );
            }
            // print_r($manifestData);
            $result2 = $this->ManifestReceivedModel->saveReceivedManifestDetails($manifestData);
            $result3 = $this->InvoiceModel->updateOneFieldInInvoice($data, $cnNo[$i]);
        }

        if($result1 && $result2 && $result3) {
            $message = "Manifest Received Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Manifest");

    }

    // method to view all the saved manifest
    public function masterManifestReceived() {
        $branch_id = $this->session->userData('branch_id');
        $data['manifests'] = $this->ManifestReceivedModel->getAllManifest($branch_id);
        // print_r($data);
        $this->load->view('System/Branch/manifestReceivedDetail_view', $data);
    }



}   

?>