<?php
class Manifest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('ManifestModel');
        $this->load->model('BranchModel');
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
        $this->load->view('System/branch/createManifest_view', $data);
    }

    // method to get requireed manifest
    public function getRequiredManifest(){
        $branch_id          = $this->session->userdata("branch_id");
        $cnNo               = $this->input->post('cn');
        $receiver_branch    = $this->input->post('receiver_branch');
        $result             = $this->ManifestModel->getManifest($cnNo,$receiver_branch);
        if($result){
            $data = json_encode($result);
            echo $data;
        }else{
            echo '0';
        }   
    }

    // method to save  manifest
    public function saveManifest() {
        
        $manifest_date   = $this->input->post('manifest_date');
        $manifest_number = $this->input->post('manifest_number');
        $receiver_branch = $this->input->post('receiver_branch');
        $sender_branch   = $this->session->userdata('branch_id');
        
        $data = array (
            'manifest_date'         => $manifest_date,
            'manifest_number'       => $manifest_number,
            'receiver_branch'       => $receiver_branch,
            'sender_branch'         => $sender_branch 
        );

        // print_r($data);

        // save to master manifest
        $result1 = $this->ManifestModel->saveManifest($data);

        // save to master manifest details
        $cnNo = $this->input->post('cnno');
        $receiver_name = $this->input->post('receiver_name');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $booked_date = $this->input->post('booked_date');
        $weight = $this->input->post('weight');
        $qty = $this->input->post('qty');
        $total = count($cnNo);

        for ($i=0; $i<$total; $i++) {

            if($cnNo[$i]) {
                $manifestData = array(
                    'master_id'         => $result1,
                    'mfno'              => $manifest_number ,
                    'cnno'              => $cnNo[$i],
                    'receiver'          => $receiver_name[$i],
                    'address'           => $address[$i],
                    'contact'           => $contact[$i],
                    'booked_on'         => $booked_date[$i],
                    'weight'            => $weight[$i],
                    'qty'               => $qty[$i],
                    'sender_branch_id'  => $sender_branch,
                    'receiver_branch_id'=> $receiver_branch
                );
                $data = array (
                    'manifest_no' => $manifest_number
                );
            }
            // print_r($manifestData);
            $result2 = $this->ManifestModel->saveManifestDetails($manifestData);
            $result3 = $this->InvoiceModel->updateOneFieldInInvoice($data, $cnNo[$i]);
        }

        
        if($result1 && $result2 && $result3) {
            $message = "Manifest created Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Manifest");

    }

    // method to get saved manifests
    public function masterManifest() {

        $branch_id = $this->session->userData('branch_id');
        $data['manifests'] = $this->ManifestModel->getAllManifest($branch_id);
        // print_r($data);
        $this->load->view('System/Branch/manifestDetail_view', $data);
    }

}

?>