<?php
class EmployeeModel extends CI_Model {

    public function getAllEmployees($branch_id = null){
        $this->db->select("*");
        $this->db->from("tbl_employee");
        $this->db->where("branch_id",$branch_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getEmployeeByCode(){
        $this->db->select("code");
        $this->db->from("tbl_employee");
        $this->db->order_by('code', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result =  $query->result_array();
            return $result['0'];
        }else{
            return false;
        }
    }

    // save received data into customer table
    public function save($data) {
        try {
            if($this->db->insert('tbl_employee',$data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }   
    }

    public function getEmployeeById($id = null){
        $this->db->select("*");
        $this->db->from("tbl_employee");
        $this->db->where("id",$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    // method to update employee in database
    public function updateEmployee($data = null, $employee_id = null) {
        $this->db->where('id', $employee_id);
        try {
            if($this->db->update('tbl_employee', $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    // delete customer based on id
    public function deleteEmployee($id = null) {
        $this->db->where('id', $id);
        try {
            if($this->db->delete('tbl_employee')) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    // get employees by their roles
    public function getEmployeesByDesignationAndByBranch($designation = null, $branch_id = null) {
        $this->db->select('*');
        $this->db->from('tbl_employee');
        $this->db->where('designation', $designation);
        $this->db->where('branch_id', $branch_id);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
}
?>