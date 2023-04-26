<?php
class ManifestReceivedModel extends CI_Model {

    public function getManifest($cnNo = null, $sender_branch = null){
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        // $this->db->join("tbl_location","tbl_location.location_id = tbl_invoice.customer_address");
        $this->db->where("bill_number",$cnNo);
        $this->db->where("branch_id", $sender_branch);
        // $this->db->where("manifest_no"," ");
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return false;
        }
    }

    public function saveReceivedManifest($data = null) {
        try {
            if($this->db->insert('tbl_master_manifest_received',$data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function saveReceivedManifestDetails($data = null){
        if($this->db->insert("tbl_manifest_received_details",$data)) {
            return true;
        }
    }

    public function getAllManifest($branch_id = null) {
        $this->db->select("*");
        $this->db->from("tbl_manifest_received_details");
        $this->db->join("tbl_master_manifest_received","tbl_master_manifest_received.manifest_received_id = tbl_manifest_received_details.master_id");
        $this->db->where('receiver_branch', $branch_id);
        $this->db->order_by('mrno', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        // $this->db->group_by('mrno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array(); 
        }else{
            return false;
        }
    }

    public function getCnnCount($mrno) {
        $this->db->select('cnno');
        $this->db->from('tbl_manifest_received_details');
        $this->db->where('mrno', $mrno);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }

}
?>