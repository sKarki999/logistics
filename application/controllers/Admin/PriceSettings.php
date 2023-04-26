<?php
class PriceSettings extends CI_Controller {
    // constructor
    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('PriceSettingsModel');
        $this->load->model('BranchModel');
        $this->load->model('LocationModel');
        // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            true;
        } else {
            redirect('Account');
        }
    }

    // default method
    public function index() {
        $data['branches'] = $this->BranchModel->getAllBranches();
        $this->load->view('System/Setup/priceSettings_view', $data);
    }

    public function setPrice() {
        $data['branch_id'] = $this->input->post('branch_id');
        $data['locations'] = $this->LocationModel->getAllLocations();
        // print_r($data['locations']);
        $this->load->view("System/Setup/extendedPriceSettings_view", $data);
    }


    public function savePrice($locationBranchId = null) {
        
        $indexnumber = $this->input->post("indexnum");
        if(!$indexnumber) {
            $message = "Please tick the Location you want to update ...";
            $this->session->set_flashdata('error', $message);
            $data['branch_id'] = $locationBranchId;
            $data['locations'] = $this->LocationModel->getAllLocations();
            // print_r($data['locations']);
            $this->load->view("System/Setup/extendedPriceSettings_view", $data);    
        } else {
            $price = $this->input->post('price');
            $locationId = $this->input->post('location');
            // print_r($locationId);
            if($indexnumber != null) {
                foreach($indexnumber as $indexnum) {
                    $checkPrice = $this->PriceSettingsModel->checkLocationPriceExists($locationBranchId,$locationId[$indexnum]);
                    if($checkPrice){
                        $result = $this->PriceSettingsModel->updateLocationPrice($locationBranchId,$locationId[$indexnum],$price[$indexnum]);
                    } else {
                        $data = array(
                            "lpbranch_id" => $locationBranchId,
                            "location_id" => $locationId[$indexnum],
                            "location_price" => $price[$indexnum]
                            );
                            // print_r($data);
                            $result = $this->PriceSettingsModel->savePrice($data);  
                    }
                }

                if($result) {
                    $message = "Price added Succesfully...";
                    $this->session->set_flashdata('msg', $message);
                }
                redirect("Admin/PriceSettings");
            } else {
                redirect("Admin/PriceSettings/setPrice");
            }
        }
    
    }

}
?>