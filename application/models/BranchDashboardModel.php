<?php
class BranchDashboardModel extends CI_Model {

    public function getCustomer($branch_id = null){
        $this->db->select("customer_id,customer_code,customer_name");
        $this->db->from("tbl_customer");
        $this->db->where("branch_id",$branch_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function count($tablename = null, $id = null) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('branch_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }   
    }
    
}
?>