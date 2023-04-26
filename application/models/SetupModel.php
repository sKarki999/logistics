<?php

class SetupModel extends CI_Model {
    
    /**
     * getAllUsers
     * method to get all the users from the table
     * @return users 
     */
    public function getAllUsers() {

        // return $data = [
        //     '2' => ['2', 'Mo Salah', 'Liverpool', 'Winger', 'mo@lfc.com', 'To Do'],
        //     '3' => ['3', 'D Nuney', 'Liverpool', 'Striker', 'nunez@lfc.com', 'To Do'],
        //     '4' => ['4', 'D Jota', 'Liverpool', 'Striker', 'Jota@lfc.com', 'To Do'],
        // ];

        $this->db->select("user_id,user_name,branch_id,user_type,contact");
        $this->db->from('tbl_users');
        $query = $this->db->get();
        // $query->result_array();
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        } 

        // Method 2:
        // $query = $this->db->select("user_id,user_name,branch_id,user_type,contact")
        //     ->from('tbl_users');
        // $query = $this->db->get();
        // $result = $query->result_array();
        // print_r($result);

        //Method 3:
        // $query = "SELECT * FROM tbl_users";
        // $query = $this->db->query($query);
        // print_r($query->result_Array());


    }

    
    /**
     * method to save user into tablename
     *
     * @param mixed tablename
     * @param mixed data
     *
     * @return void
     */
    public function save($tablename, $data) {
        try {
            if($this->db->insert($tablename,$data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }    
    }


    public function getUserDetailsById($id = null) {

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        try {
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }


    public function getBranchIdAndName() {

        $this->db->select('branch_id, branch_name');
        $this->db->from('tbl_branch');
        $query = $this->db->get();
        try{
            if($query->num_rows() > 0) {
                // print_r($query);
                return $query->result_array();
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }


    public function getCurrentBranchAndId($id = null) {
        $this->db->select('branch_id, branch_name');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id', $id);
        $query = $this->db->get();
        try{
            if($query->num_rows() > 0) {
                // print_r($query);
                return $query->result_array();
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function getBranchName($id = null) {
        $this->db->select('*');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id', $id);
        $query = $this->db->get();
        try {
            if($query->num_rows() > 0) {
                $result = $query->result_array();
                return $result['0'];
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }


    public function updateUser($tablename = null, $data = null, $user_id = null, $field = null) {
        $this->db->where($field, $user_id);
        try {
            if($this->db->update($tablename, $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function deleteUserById($tablename = null, $id = null, $field=null) {
        $this->db->where($field, $id);
        try {
            if($this->db->delete($tablename)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    
    /**
     * countUsers
     *
     * @param mixed tablename
     *
     * @return number of rows in the given table
     */
    public function countUsers($tablename = null) {
        $this->db->select('*');
        $this->db->from($tablename);
        $query = $this->db->get();
        try{
        
            if($query->num_rows() > 0) {
                return $query->num_rows();
            } else {
                return 'false';
            }   
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function countSpecificUsers($tablename = null, $search = null) {

        $this->db->select('*')
            ->from($tablename)
            ->where("full_name LIKE '%$search%'");
            $query = $this->db->get();
            return $query->num_rows();
    }


    public function getUsersWithPagination($startPage = null, $perPage = null) {
        $this->db->select("user_id,user_name,branch_id,user_type,contact")
            ->from('tbl_users')
            ->limit($perPage, $startPage);
        $query = $this->db->get();
        try {
            if($query->num_rows()>0) {
                return $query->result_array() ;
            } else {
                return 'false';
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function getSearchedUsersWithPagination($search, $startPage = null, $perPage = null) {
        $this->db->select("user_id,user_name,branch_id,user_type,contact")
            ->from('tbl_users')
            ->where("full_name LIKE '%$search%'")
            ->limit($perPage, $startPage);
        $query = $this->db->get();
        return $query->result_array(); 
    }


    public function searchByName($searchByName) {

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where("full_name LIKE '%$searchByName%'");
        // $this->db->like('full_name', "'". $searchByname. "'");
        $query = $this->db->get();
        $result = $query->result_array();
        // print_r($result);
    }

}
?>
















