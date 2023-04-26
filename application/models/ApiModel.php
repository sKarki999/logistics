<?php
class ApiModel extends CI_Model {

    // method to get consignment details
    public function getCnDetails($cnno = null){
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        // $this->db->join("tbl_location","tbl_location.location_id = tbl_invoice.con_address");
        $this->db->join("tbl_branch","tbl_branch.branch_id = tbl_invoice.branch_id");
        // $this->db->join("tbl_customer","tbl_customer.customer_id = tbl_invoice.customer_id");
        $this->db->where("bill_number", $cnno);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
     }

    public function getManifestCreatedDate($cnno = null) {
        $mfno = $this->mfNo($cnno);
        if($mfno){
            $this->db->select("manifest_date");
            $this->db->from("tbl_master_manifest");
            $this->db->where("manifest_number",$mfno['manifest_no']);
            $this->db->limit(1);
            $query = $this->db->get();
                if($query->num_rows() > 0) {
                    $result = $query->result_array();
                    return $result[0];
                } else {
                    return false;
                }
        }
    }

    public function mfNo($cnno = null){
        $this->db->select("manifest_no");
        $this->db->from("tbl_invoice");
        $this->db->where("bill_number", $cnno);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return false;
        }
    }

    public function getManifestReceivedDate($cnno = null) {
        $this->db->select("*");
        $this->db->from("tbl_manifest_received_details");
        $this->db->join("tbl_branch","tbl_branch.branch_id = tbl_manifest_received_details.receiver_branch_id");
        $this->db->where("cnno",$cnno);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
          $result = $query->result_array();
          return $result[0];
        } else {
            return false;
        }
    }

    public function podDate($cnno = null){
        $this->db->select("*");
        $this->db->from("tbl_pod_details");
        $this->db->join("tbl_branch","tbl_branch.branch_id = tbl_pod_details.branch");
        $this->db->where("cnno",$cnno);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
          $result = $query->result_array();
          return $result[0];
        }else{
          return false;
        }
     }

     public function getCustomerName($id) {
        $this->db->select('customer_name');
        $this->db->from('tbl_customer');
        $this->db->where('customer_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $result =  $query->result_array();
            return $result['0']['customer_name'];
        } else {
            return false;
        }
     }

}
?>