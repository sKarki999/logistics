<?php
class ManifestModel extends CI_Model {

    // get manifest number if exists
    public function manifestNumber() {
        $this->db->select("manifest_number");
        $this->db->from("tbl_master_manifest");
        $this->db->order_by('manifest_master_id', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return false;
        }
    }

    public function saveManifest($data = null) {
        try {
            if($this->db->insert('tbl_master_manifest',$data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }

    }
    

    public function getManifest($cnNo = null, $receiver_branch = null){
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        // $this->db->join("tbl_location","tbl_location.location_id = tbl_invoice.customer_address");
        $this->db->where("bill_number",$cnNo);
        $this->db->where("receiver_branch_id", $receiver_branch);
        $this->db->where("manifest_no"," ");
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return false;
        }
    }
    
    public function saveManifestDetails($data = null){
        if($this->db->insert("tbl_manifest_details",$data)) {
            return true;
        }
    }
    
    public function getAllManifest($branch_id = null) {
        $this->db->select("*");
        $this->db->from("tbl_manifest_details");
        $this->db->join("tbl_master_manifest","tbl_master_manifest.manifest_master_id = tbl_manifest_details.master_id");
        $this->db->where('sender_branch', $branch_id);
        $this->db->order_by('mfno', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        $this->db->group_by('mfno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array(); 
        }else{
            return false;
        }
    }


    public function getCnnCount($mfno) {
        $this->db->select('cnno');
        $this->db->from('tbl_manifest_details');
        $this->db->where('mfno', $mfno);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }

    public function getMfno() {
        $this->db->select("mfno");
        $this->db->from("tbl_manifest_details");
        // $this->db->order_by('mfno', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


}
?>