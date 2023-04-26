<?php

class Branch extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        // load the models
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
    public function index($currentPage =  null, $perPage = null) {
        $data['branches'] = $this->BranchModel->getAllBranches();
        // count the number of branches
        $data['totalBranches'] = $this->BranchModel->countBranches('tbl_branch');
        
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
        $data['pageCount'] = ceil($data['totalBranches'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->BranchModel->getBranchesWithPagination($data['startPage'], $data['perPage']);        


        // print_r($data);
        $this->load->view('System/Setup/branch_view', $data);
    }

    // method to search for specific data
    public function search($currentPage =  null, $perPage = null, $search = null) {
  
        if(isset($_POST['searchBranch'])) {
            $data['search'] = $_POST['searchBranch'];
        } else {
            $data['search'] =  $search;
        }

        $data['totalBranches'] = $this->BranchModel->countSpecificBranches('tbl_branch', $data['search']);
        
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
        $data['pageCount'] = ceil($data['totalBranches'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->BranchModel->getSearchedBranchesWithPagination($data['search'], $data['startPage'], $data['perPage']);        


        // print_r($data);
        $this->load->view('System/Setup/branch_view_search', $data);


    }


    // add new Branch
    public function addBranch() {
        $data['locations'] = $this->LocationModel->getAllLocations();
        // print_r($data['locations']);
        $this->load->view('System/Setup/addBranch', $data);
    }

    /**
     * saveUser
     * method to save the user details in the database table
     */
    public function saveBranch() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required|min_length[3]');
        $this->form_validation->set_rules('branch_code', 'Branch Code', 'required|min_length[3]');
        $this->form_validation->set_rules('branch_location', 'Branch Location', 'required');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'required|min_length[3]');
        $this->form_validation->set_rules('branch_contact', 'Branch Contact', 'required');
        $this->form_validation->set_rules('branch_email', 'Branch Email', 'required');

        if($this->form_validation->run()) {
            
            // print_r($_POST);
            $branch_name      = $this->input->post("branch_name");
            $branch_code      = $this->input->post("branch_code");
            $branch_location  = $this->input->post("branch_location");
            $branch_address   = $this->input->post("branch_address");
            $branch_contact   = $this->input->post("branch_contact");
            $branch_email     = $this->input->post("branch_email");

            $data = [
                'branch_name'     => $branch_name,
                'branch_code'     => $branch_code,
                'location_id'     => $branch_location,
                'branch_address'  => $branch_address,
                'branch_contact'  => $branch_contact,
                'branch_email'    => $branch_email
            ];

            // print_r($data);

            $result = $this->BranchModel->save('tbl_branch', $data);
            if($result) {
                $message = "Branch added Succesfully...";
                $this->session->set_flashdata('msg', $message);
            }
            redirect("Admin/Branch");
            
        } else {

            $branch_name      = $this->input->post("branch_name");
            $branch_code      = $this->input->post("branch_code");
            $branch_location  = $this->input->post("branch_location");
            $branch_address   = $this->input->post("branch_address");
            $branch_contact   = $this->input->post("branch_contact");
            $branch_email     = $this->input->post("branch_email");

            $data = [
                'branch_name'     => $branch_name,
                'branch_code'     => $branch_code,
                'location_id'     => $branch_location,
                'branch_address'  => $branch_address,
                'branch_contact'  => $branch_contact,
                'branch_email'    => $branch_email
            ];
            
            $data['current_location'] = $this->LocationModel->getLocationById($branch_location);
            $data['locations'] = $this->LocationModel->getAllLocations();
            // print_r($data['current_location']);
            $this->load->view('System/Setup/addBranch', $data);
        }
    }

    /**
     * get details of branch to be updated
     *
     * @param mixed branchId
     *
     */
    public function getBranch($branchId) {

        $data['locations'] = $this->LocationModel->getAllLocations();
        $data['result'] = $this->BranchModel->getBranchById($branchId);
        // print_r($data);
        $this->load->view('System/Setup/editBranch', $data);
    }

    /**
     * updateBranch
     * method to save the user details in the database table
     */
    public function update($branchId) {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
        $this->form_validation->set_rules('branch_code', 'Branch Code', 'required');
        $this->form_validation->set_rules('branch_location', 'Branch Location', 'required');
        $this->form_validation->set_rules('branch_address', 'Branch Address', 'required');
        $this->form_validation->set_rules('branch_contact', 'Branch Contact', 'required');
        $this->form_validation->set_rules('branch_email', 'Branch Email', 'required');
        
        if($this->form_validation->run()) {
            
            // print_r($_POST);
            $branch_name      = $this->input->post("branch_name");
            $branch_code      = $this->input->post("branch_code");
            $branch_location  = $this->input->post("branch_location");
            $branch_address   = $this->input->post("branch_address");
            $branch_contact   = $this->input->post("branch_contact");
            $branch_email     = $this->input->post("branch_email");

            $data = [
                'branch_name'     => $branch_name,
                'branch_code'     => $branch_code,
                'location_id'     => $branch_location,
                'branch_address'  => $branch_address,
                'branch_contact'  => $branch_contact,
                'branch_email'    => $branch_email
            ];

            // print_r($data);

            $result = $this->BranchModel->updateBranch('tbl_branch', $data, $branchId, 'branch_id');
            if($result) {
                $message = "Branch updated Succesfully...";
                $this->session->set_flashdata('msg', $message);
            }
            redirect("Admin/Branch");
            
        } else {
            $this->getBranch($branchId);
        }
    }
    
    /**
     * method to delete the branch based on id
     *
     * @param mixed id
     *
     * @return void
     */
    
    public function deleteBranch($id) {

        // echo "inside delete user function: " . $id;
        $result = $this->BranchModel->deleteBranchById('tbl_branch', $id, 'branch_id');
        if($result) {
            $message = "Branch deleted Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect('Admin/Branch');
    }

}
?>







