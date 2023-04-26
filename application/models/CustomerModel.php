<?php
class CustomerModel extends CI_Model {

    public function getCustomer($branch_id = null){
        $this->db->select("*");
        $this->db->from("tbl_customer");
        $this->db->where("branch_id",$branch_id);
        $this->db->order_by("customer_id", "DESC");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getCustomerById($id = null){
        $this->db->select("*");
        $this->db->from("tbl_customer");
        $this->db->where("customer_id",$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getCustomerByCustomerCode(){
        $this->db->select("customer_code");
        $this->db->from("tbl_customer");
        $this->db->order_by('customer_code', 'DESC');
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
            if($this->db->insert('tbl_customer',$data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }   
    }

    // method to update customer in database
    public function updateUser($data = null, $customer_id = null) {
        $this->db->where('customer_id', $customer_id);
        try {
            if($this->db->update('tbl_customer', $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }



    // delete customer based on id
    public function deleteCustomerById($id = null) {
        $this->db->where('customer_id', $id);
        try {
            if($this->db->delete('tbl_customer')) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

}
?>