<?php
class AccountModel extends CI_Model {

    public function getBranches() {
        $this->db->select('*')
            ->from('tbl_branch');
        $query = $this->db->get();
        try {
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch(Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());   
        }
    }

    public function userValidate($data = null) {
        $username = $data['user_name'];
        $password = $data['user_password'];
        $this->db->select('*')
            ->from('tbl_users')
            ->where('user_name', $username)
            ->where('user_password', $password)
            ->limit(1);
        $query = $this->db->get();
            if($query->num_rows() == 1) {
                return $query->result_array();
            } else {
                return false;
            }
    }

    public function customerValidate($data = null) {
        $username = $data['username'];
        $password = $data['password'];
        $this->db->select('*')
            ->from('tbl_customer')
            ->where('cu_user', $username)
            ->where('cu_password', $password)
            ->limit(1);
        $query = $this->db->get();
        try {
            if($query->num_rows() == 1) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch(Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function driverValidate($data = null) {
        $username    = $data['username'];
        $password    = $data['password'];
        $branch_id   = $data['branch_id'];

        $this->db->select('*')
            ->from('tbl_employee')
            ->where('username', $username)
            ->where('password', $password)
            ->where('branch_id', $branch_id)
            ->limit(1);
        $query = $this->db->get();
        try {
            if($query->num_rows() == 1) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch(Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

}
?>