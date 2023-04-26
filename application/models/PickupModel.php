<?php
class PickupModel extends CI_Model {

    public function getPickupRequest($branch_id = null){
        $this->db->select("*");
        $this->db->from("tbl_pickup_request");
        $this->db->join("tbl_customer","tbl_customer.customer_id = tbl_pickup_request.customer_id");
        $this->db->where("b_id", $branch_id);
        $this->db->order_by("pickup_message_id","desc");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
     }

    public function getPickUpRequestNumber() {
        $this->db->select("*");
        $this->db->from("tbl_pickup_request");
        $this->db->order_by('pickup_message_id','DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result[0];
        }else{
            return false;
        }
    }

    public function savePickupRequest($data = null) {
        try {
            if($this->db->insert('tbl_pickup_request',$data)) {
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