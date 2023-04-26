<?php

class Location extends CI_Controller {
    // constructor
    public function __construct(){
        parent:: __construct();
        // load the model
        $this->load->model('LocationModel');
        // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            true;
        } else {
            redirect('Account');
        }
    }

    // default method
    public function index($currentPage =  null, $perPage = null) {
        $data['locations'] = $this->LocationModel->getAllLocations();
        // count the number of users
        $data['totalLocations'] = $this->LocationModel->countLocations('tbl_location');
        
        // pagination support
        // users to be shown per page
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
        $data['pageCount'] = ceil($data['totalLocations'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->LocationModel->getLocationsWithPagination($data['startPage'], $data['perPage']);        


        // print_r($data);
        $this->load->view('System/Setup/location_view', $data);
    }

  

    // add new location
    public function addLocation() {
        // $data['branches'] = $this->SetupModel->getBranchIdAndName();
        $this->load->view('System/Setup/addLocation');
    }
    
    /**
     * saveUser
     * method to save the user details in the database table
     */
    public function saveLocation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('location_name', 'Location Name', 'required|min_length[3]');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('location_type', 'Location Type', 'required');
        
        if($this->form_validation->run()) {
            
            // print_r($_POST);
            $location_name = $this->input->post("location_name");
            $category = $this->input->post("category");
            $location_type = $this->input->post("location_type");

            $data = [
                'location_name'     => $location_name,
                'category'          => $category,
                'location_type'     => $location_type
            ];

            // print_r($data);

            $result = $this->LocationModel->save('tbl_location', $data);
            if($result) {
                $message = "Location added Succesfully...";
                $this->session->set_flashdata('msg', $message);
            }
            redirect("Admin/Location");
            
        } else {

            $location_name = $this->input->post("location_name");
            $category = $this->input->post("category");
            $location_type = $this->input->post("location_type");

            $data = [
                'location_name'     => $location_name,
                'category'          => $category,
                'location_type'     => $location_type
            ];
            
            $this->load->view('System/Setup/addLocation', $data);
        }
    }

    /**
     * get details of user to be updated
     *
     * @param mixed userId
     *
     */
    public function getLocation($locationId) {
        $data['result'] = $this->LocationModel->getLocationById($locationId);
        // print_r($data);
        $this->load->view('System/Setup/editLocation', $data);
    }

    /**
     * updateUser
     * method to save the user details in the database table
     */
    public function update($locationId) {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('location_name', 'Location Name', 'required|min_length[3]');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('location_type', 'Location Type', 'required');
        
        if($this->form_validation->run()) {
            
            // print_r($_POST);
            $location_name = $this->input->post("location_name");
            $category = $this->input->post("category");
            $location_type = $this->input->post("location_type");

            $data = [
                'location_name'     => $location_name,
                'category'          => $category,
                'location_type'     => $location_type
            ];

            // print_r($data);

            $result = $this->LocationModel->updateLocation('tbl_location', $data, $locationId, 'location_id');
            if($result) {
                $message = "Location updated Succesfully...";
                $this->session->set_flashdata('msg', $message);
            }
            redirect("Admin/Location");
            
        } else {
            $this->getLocation($locationId);
        }
    }

    public function deleteLocation($id) {

        // echo "inside delete user function: " . $id;
        $result = $this->LocationModel->deleteLocationById('tbl_location', $id, 'location_id');
        if($result) {
            $message = "Location deleted Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect('Admin/Location');
    }

    /**
     * method to Search by location
     *
     */
    public function search($currentPage =  null, $perPage = null, $search = null) {
  
        if(isset($_POST['searchLocation'])) {
            $data['search'] = $_POST['searchLocation'];
        } else {
            $data['search'] =  $search;
        }
        // print_r($data['search']);

        // print_r($_POST['searchUsername']);
        // $data['locations'] = $this->LocationModel->searchByLocation($data['search']);
        // count the number of users
        $data['totalLocations'] = $this->LocationModel->countSpecificLocations('tbl_location', $data['search']);  
        // print_r($data['totalLocations']);

        // users to be shown per page
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
        $data['pageCount'] = ceil($data['totalLocations'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->LocationModel->getsearchedLocationsWithPagination($data['search'], $data['startPage'], $data['perPage']);        

        // print_r($data['result']);
        $this->load->view('System/Setup/location_view_search', $data);

    }

}
?>