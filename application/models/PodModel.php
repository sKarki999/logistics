<?php
class PodModel extends CI_Model {

    public function getPodNumber(){
        $this->db->select("pod_number");
        $this->db->from("tbl_pod");
        $this->db->order_by('pod_number', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return false;
        }
    }

    public function getCnn($branch_id = null, $cnNo = null){
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        //$this->db->join("tbl_consignee","tbl_consignee.consignee_id=tbl_invoice.con_id");
        $this->db->where("bill_number",$cnNo);
        $this->db->where("receiver_branch_id", $branch_id);
        // $this->db->where("runsheet_no"," ");
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return false;
        }
    }

    public function savePod($data = null) {
        try {
            if($this->db->insert('tbl_pod',$data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function savePodDetails($data = null){
        if($this->db->insert("tbl_pod_details",$data)) {
            return true;
        }
    }

    public function getAllPod($branch_id = null) {
        $this->db->select("*");
        $this->db->from("tbl_pod_details");
        $this->db->join("tbl_pod","tbl_pod.pod_id = tbl_pod_details.pod_master_id");
        $this->db->where('branch', $branch_id);
        $this->db->order_by('pod_number', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        // $this->db->group_by('mfno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array(); 
        }else{
            return false;
        }
    }
}
?>