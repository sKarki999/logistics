<?php
class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('EmployeeModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    // employee view master page
    public function index() {
        $branch_id = $this->session->userdata('branch_id');
        $data['employees'] = $this->EmployeeModel->getAllEmployees($branch_id);
        $this->load->view('System/branch/employee_view', $data);
    }

    // load form to add a new employee
    public function addEmployee() {
        $this->load->view('System/Branch/addEmployee_view');
    }

    // save the form data
    public function saveEmployee() {

        $employeeCode = 1001;
        $code = $this->EmployeeModel->getEmployeeByCode();
        if($code) {
            $employeeCode = $code['code'] + 1;
        }
        $name           = $this->input->post('employee_name');
        $address        = $this->input->post('address');
        $contact_number = $this->input->post('contact_number');
        $email          = $this->input->post('email');
        $designation    = $this->input->post('designation');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $branch_id      = $this->session->userdata("branch_id");

        $data = [
            'code'          => $employeeCode,
            'name'          => $name,
            'address'       => $address,
            'contact'       => $contact_number,
            'email'         => $email,
            'designation'   => $designation,
            'username'      => $username,
            'password'      => $password,
            'branch_id'     => $branch_id,
        ];

        $result = $this->EmployeeModel->save($data);
        if($result) {
            $message = "Employee added Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Employee");
    }

    // method to get employee based on id
    public function getEmployee($id) {
        $data['employee'] = $this->EmployeeModel->getEmployeeById($id);
        $this->load->view('System/Branch/editEmployee_view', $data);
    }

    // method to updated employee based on id
    public function updateEmployee($id) {

        $emp_name       = $this->input->post('employee_name');
        $address        = $this->input->post('address');
        $contact_number = $this->input->post('contact_number');
        $email          = $this->input->post('email');
        $designation    = $this->input->post('designation');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $branch_id      = $this->session->userdata("branch_id");

        $data = [
            'name'          => $emp_name,
            'address'       => $address,
            'contact'       => $contact_number,
            'email'         => $email,
            'designation'   => $designation,
            'username'      => $username,
            'password'      => $password,
            'branch_id'     => $branch_id,
        ];

        $result = $this->EmployeeModel->updateEmployee($data, $id);
        if($result) {
            $message = "Employee updated Succesfully...";
            $this->session->set_flashdata('msg', $message);
            redirect('Branch/Employee');
        } else {
            $this->getEmployee($id);
        }
    }

    // function to delete the customer
    public function deleteEmployeeById($id) {
        $result = $this->EmployeeModel->deleteEmployee($id);
        if($result) {
            $message = "Employee deleted Succesfully...";
            $this->session->set_flashdata('msg', $message);
            redirect('Branch/Employee');
        } else {
            redirect('Branch/Employee');
        }
    }

}

?>