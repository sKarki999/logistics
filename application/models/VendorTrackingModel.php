<?php
class VendorTrackingModel extends CI_Model {

      /**
         * method to get All invoice
         *
         */
        public function getInvoiceByCnn($id = null, $cnn = null) {
          $this->db->select('*')->from('tbl_invoice')->where('customer_id', $id)->where('bill_number', $cnn);
          $query = $this->db->get();
          if($query->num_rows() > 0) {
              return $query->result_array();
          } else {
              return false;
          } 
      }

    public function manifestCreatedDate($cnno = null){
        $this->db->select("*");
        $this->db->from("tbl_manifest_details");
        $this->db->join("tbl_branch","tbl_branch.branch_id = tbl_manifest_details.sender_branch_id");
        $this->db->where("cnno",$cnno);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
          return false;
        }      
     }

     public function manifestReceivedDate($cnno = null){
        $this->db->select("*");
        $this->db->from("tbl_manifest_received_details");
        $this->db->join("tbl_branch","tbl_branch.branch_id = tbl_manifest_received_details.receiver_branch_id");
        $this->db->where("cnno",$cnno);
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
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

     public function getCnnTrackInfo($cnno = null, $branch_id = null, $customer_id = null){
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        $this->db->join("tbl_branch","tbl_branch.branch_id = tbl_invoice.branch_id");
        $this->db->where("bill_number",$cnno);
        $this->db->where("tbl_invoice.branch_id",$branch_id);
        $this->db->where("tbl_invoice.customer_id",$customer_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result =  $query->result_array();
            return $result[0];
        }else{
            return false;
        }
     }
}
?>