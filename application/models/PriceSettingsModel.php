<?php
class PriceSettingsModel extends CI_Model {

    public function checkLocationPriceExists($branch_id = null, $location_id = null){
        $this->db->select("location_price");
        $this->db->from("tbl_location_price_info");
        $this->db->where("lpbranch_id", $branch_id);
        $this->db->where("location_id", $location_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getLocationPrice($branch_id = null, $location_id = null){
        $this->db->select("location_price");
        $this->db->from("tbl_location_price_info");
        $this->db->where("lpbranch_id", $branch_id);
        $this->db->where("location_id", $location_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function updateLocationPrice($branch_id = null, $locationId = null, $price = null){
        $data = array(
            "location_price" => $price
        );
        $this->db->where("lpbranch_id", $branch_id);
        $this->db->where("location_id", $locationId);
        if($this->db->update("tbl_location_price_info", $data)){
            return true;
        }else{
            return false;
        }
    }

    public function savePrice($data = null){
        if($this->db->insert("tbl_location_price_info",$data)) {
            return true;
        } else {
            return false;
        }
        
    }
}
?>