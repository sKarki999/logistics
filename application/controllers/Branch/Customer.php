<?php
class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('CustomerModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    public function index() {
        $branch_id = $this->session->userdata('branch_id');
        $data['customers'] = $this->CustomerModel->getCustomer($branch_id);
        // print_r($data);
        $this->load->view('System/branch/customer_view', $data);
    }

    // function to render add new customer page
    public function addCustomer() {
        
        // print_r($data);
        $this->load->view('System/Branch/addCustomer_view');
    }

    // function to save the form data
    public function saveCustomer() {

        $customer_code = 1001;
        $code = $this->CustomerModel->getCustomerByCustomerCode();
        // print_r($customer_code);
        if($code) {
            $customer_code = $code['customer_code'] + 1;
        }
        $customer_code = 'CU' . strval($customer_code);
        // print_r($customer_code);
        $customer_name  = $this->input->post('customer_name');
        $address        = $this->input->post('address');
        $contact_number = $this->input->post('contact_number');
        $email          = $this->input->post('email');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $user_id        = $this->session->userdata("userId");
        $branch_id      = $this->session->userdata("branch_id");


        $data = [
            'customer_code'     => $customer_code,
            'customer_name'     => $customer_name,
            'address'           => $address,
            'contact_number'    => $contact_number,
            'email'             => $email,
            'cu_user'           => $username,
            'cu_password'       => $password,
            'user_id'           => $user_id,
            'branch_id'         => $branch_id,
        ];

        $result = $this->CustomerModel->save($data);
        if($result) {
            $message = "Customer added Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Customer");

    }

    public function getCustomer($id) {
        $data['customer'] = $this->CustomerModel->getCustomerById($id);
        $this->load->view('System/Branch/editCustomer_view', $data);
    }

    // function to update customer
    public function updateCustomer($customerId) {
        // echo 'update';
        // print_r($customer_code);
        $customer_name  = $this->input->post('customer_name');
        $address        = $this->input->post('address');
        $contact_number = $this->input->post('contact_number');
        $email          = $this->input->post('email');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');

        $data = [
            'customer_name'     => $customer_name,
            'address'           => $address,
            'contact_number'    => $contact_number,
            'email'             => $email,
            'cu_user'           => $username,
            'cu_password'       => $password
        ];

        $result = $this->CustomerModel->updateUser($data, $customerId);
        if($result) {
            $message = "Customer updated Succesfully...";
            $this->session->set_flashdata('msg', $message);
            redirect('Branch/Customer');
        } else {
            $this->getCustomer($id);
        }
    }

    // function to delete the customer
    public function deleteCustomer($id) {
        $result = $this->CustomerModel->deleteCustomerById($id);
        if($result) {
            $message = "Customer deleted Succesfully...";
            $this->session->set_flashdata('msg', $message);
            redirect('Branch/Customer');
        } else {
            redirect('Branch/Customer');
        }
    }


}

?>