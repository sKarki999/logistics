<?php

class BranchModel extends CI_Model {

    public function getAllBranches() {
        $this->db->select('*')->from('tbl_branch');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        } 
    }
    
    /**
     * countBranches
     *
     * @param mixed tablename
     *
     * @return number of rows in the given table
     */
    public function countBranches($tablename = null) {
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

    public function getBranchesWithPagination($startPage = null, $perPage = null) {
        $this->db->select("*")
            ->from('tbl_branch')
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

    /**
     * method to save branch into tablename
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

    public function getBranchById($id = null) {

        $this->db->select('*');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id', $id);
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

    public function updateBranch($tablename = null, $data = null, $id = null, $field = null) {
        
        $this->db->where($field, $id);
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

    public function deleteBranchById($tablename = null, $id = null, $field = null) {
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

    public function getsearchedBranchesWithPagination($search, $startPage = null, $perPage = null) {
        $this->db->select("*")
            ->from('tbl_branch')
            ->where("branch_name LIKE '%$search%'")
            ->limit($perPage, $startPage);
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function countSpecificBranches($tablename = null, $search = null) {
        $this->db->select('*')
            ->from($tablename)
            ->where("Branch_name LIKE '%$search%'");
            $query = $this->db->get();
            return $query->num_rows();
    }

}
?>


