<?php

class User extends CI_Controller {
    // constructor
    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('SetupModel');
        // check if user is authorized
        if($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            true;
        } else {
            redirect('Account');
        }
    }

     // default method
    public function index($currentPage =  null, $perPage = null) {
        
        $data['users'] = $this->SetupModel->getAllUsers();
        $data['branch'] = $this->SetupModel->getBranchIdAndName();
        
        // count the number of users
        $data['totalUsers'] = $this->SetupModel->countUsers('tbl_users');
        
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
        
        // $data['perPage'] = '6';
        // counting pages , rouding off floating value to nearest whole number
        $data['pageCount'] = ceil($data['totalUsers'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->SetupModel->getUsersWithPagination($data['startPage'], $data['perPage']);        
        // print_r($data['startPage']);
        $this->load->view('System/Setup/User_View', $data);

    }
    
    /**
     * method to Search by username
     *
     */
    public function search($currentPage =  null, $perPage = null, $search = null) {
  
        if(isset($_POST['searchName'])) {
            $data['search'] = $_POST['searchName'];
        } else {
            $data['search'] =  $search;
        }

        // print_r($_POST['searchUsername']);
        // $data['users'] = $this->SetupModel->searchByName($data['search']);
        // print_r($data['users']);
        $data['branch'] = $this->SetupModel->getBranchIdAndName();
        // count the number of users
        $data['totalUsers'] = $this->SetupModel->countSpecificUsers('tbl_users', $data['search']);
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
        // $data['perPage'] = '6';
        // counting pages , rouding off floating value to nearest whole number
        $data['pageCount'] = ceil($data['totalUsers'] / $data['perPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = isset($currentPage) ? (int) $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling to model to get users with defined starting page number and perpage value
        $data['result'] = $this->SetupModel->getSearchedUsersWithPagination($data['search'], $data['startPage'], $data['perPage']);        
        $this->load->view('System/Setup/User_View_search', $data);

    }


    

    /**
     * addUser
     * method to add the user
     */
    public function addUser() {
        $data['branches'] = $this->SetupModel->getBranchIdAndName();
        $this->load->view('System/Setup/addUser', $data);
    }
    
    /**
     * saveUser
     * method to save the user details in the database table
     */
    public function saveUser() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('full_name', 'Fullname', 'required');
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        $this->form_validation->set_rules('user_type', 'Usertype', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        
        if($this->form_validation->run()) {
            
            // print_r($_POST);
            $full_name          = $this->input->post("full_name");
            $user_name          = $this->input->post("user_name");
            $user_password      = $this->input->post("user_password");
            $branch             = $this->input->post("branch_id");
            $user_type          = $this->input->post("user_type");
            $contact            = $this->input->post("contact");
            $dashboard          = $this->input->post("dashboard");
            $booking            = $this->input->post("booking");
            $manifest           = $this->input->post("manifest");
            $manifest_received  = $this->input->post("manifest_received");
            $pod                = $this->input->post("pod");
            $customer           = $this->input->post("customer");
            $employee           = $this->input->post("employee");
            $finance            = $this->input->post("finance");
            $runsheet           = $this->input->post("runsheet");
            $tracking           = $this->input->post("tracking");

            $data = [
                'full_name'         => $full_name,
                'user_name'         => $user_name,
                'user_password'     => $user_password,
                'branch_id'         => $branch,
                'user_type'         => $user_type,
                'contact'           => $contact,
                'dashboard'         => $dashboard,
                'booking'           => $booking,
                'manifest'          => $manifest,
                'manifest_received' => $manifest_received,
                'pod'               => $pod,
                'customer'          => $customer,
                'employee'          => $employee,
                'finance'           => $finance,
                'runsheet'          => $runsheet,
                'tracking'          => $tracking
            ];

            // print_r($data);

            $result = $this->SetupModel->save('tbl_users', $data);
            if($result) {
                $message = "User added Succesfully...";
                $this->session->set_flashdata('msg', $message);
            }
            redirect("Admin/user");
            
        } else {

            $full_name = $this->input->post("full_name");
            $user_name = $this->input->post("user_name");
            $user_password = $this->input->post("user_password");
            $branch = $this->input->post("branch_id");
            $user_type = $this->input->post("user_type");
            $contact = $this->input->post("contact");

            $data = [
                'full_name'     => $full_name,
                'user_name'     => $user_name,
                'user_password' => $user_password,
                'branch_id'     => $branch,
                'user_type'     => $user_type,
                'contact'       => $contact
            ];
            
            $data['current_branch'] = $this->SetupModel->getCurrentBranchAndId($branch); 
            $data['branches'] = $this->SetupModel->getBranchIdAndName();
            // print_r($data['current_branch']);
            $this->load->view('System/Setup/addUser', $data);
        }
    }

    
    /**
     * get details of user to be updated
     *
     * @param mixed userId
     *
     */
    public function getUser($userId) {

        $data['result'] = $this->SetupModel->getUserDetailsById($userId);
        $data['branches'] = $this->SetupModel->getBranchIdAndName();
        // print_r($data['result']['0']['branch_id']);
        $this->load->view('System/Setup/editUser', $data);
    }


    public function update($user_id) {
        
        // load validation library
        $this->load->library('form_validation');
        // set validation rules
        $this->form_validation->set_rules('full_name', 'Fullname', 'required');
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        $this->form_validation->set_rules('user_type', 'Usertype', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');


        if($this->form_validation->run()) {

            $full_name          = $this->input->post("full_name");
            $user_name          = $this->input->post("user_name");
            $user_password      = $this->input->post("user_password");
            $branch             = $this->input->post("branch_id");
            $user_type          = $this->input->post("user_type");
            $contact            = $this->input->post("contact");
            $dashboard          = $this->input->post("dashboard");
            $booking            = $this->input->post("booking");
            $manifest           = $this->input->post("manifest");
            $manifest_received  = $this->input->post("manifest_received");
            $pod                = $this->input->post("pod");
            $customer           = $this->input->post("customer");
            $employee           = $this->input->post("employee");
            $finance            = $this->input->post("finance");
            $runsheet           = $this->input->post("runsheet");
            $tracking           = $this->input->post("tracking");

            $data = [
                'full_name'         => $full_name,
                'user_name'         => $user_name,
                'user_password'     => $user_password,
                'branch_id'         => $branch,
                'user_type'         => $user_type,
                'contact'           => $contact,
                'dashboard'         => $dashboard,
                'booking'           => $booking,
                'manifest'          => $manifest,
                'manifest_received' => $manifest_received,
                'pod'               => $pod,
                'customer'          => $customer,
                'employee'          => $employee,
                'finance'           => $finance,
                'runsheet'          => $runsheet,
                'tracking'          => $tracking
            ];
            $result = $this->SetupModel->updateUser('tbl_users', $data, $user_id, 'user_id');
            if($result) {
                $message = "User updated Succesfully...";
                $this->session->set_flashdata('msg', $message);
                redirect('Admin/User');
            }
        } else {
            
            $this->getUser($user_id);
        }
    }

    // method to delete the user
    public function deleteUser($id) {

        // echo "inside delete user function: " . $id;
        $result = $this->SetupModel->deleteUserById('tbl_users', $id, 'user_id');
        if($result) {
            $message = "User deleted Succesfully...";
            $this->session->set_flashdata('msg', $message);
            redirect('Admin/User');
        } else {
            redirect('Admin/User');
        }
    }

}
?>
