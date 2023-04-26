<?php
class DeliveryRunsheetModel extends CI_Model {

    public function runsheetNumber(){
        $this->db->select("runsheet_number");
        $this->db->from("tbl_master_delivery_runsheet");
        $this->db->order_by('runsheet_id', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
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

    public function saveRunsheet($data = null) {
        try {
            if($this->db->insert('tbl_master_delivery_runsheet',$data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }

    }

    public function saveRunsheetDetails($data = null){
        if($this->db->insert("tbl_delivery_runsheet_details",$data)) {
            return true;
        }
    }

    public function getAllRunsheets($branch = null) {
        $this->db->select("*");
        $this->db->from("tbl_delivery_runsheet_details");
        $this->db->join("tbl_master_delivery_runsheet","tbl_master_delivery_runsheet.runsheet_id = tbl_delivery_runsheet_details.r_id");
        $this->db->where('c_branch', $branch);
        $this->db->order_by('rsno', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        // $this->db->group_by('rsno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array(); 
        }else{
            return false;
        }
    }

    public function getAllRunsheetsForDriverById($id = null) {
        $this->db->select("*");
        $this->db->from("tbl_delivery_runsheet_details");
        $this->db->join("tbl_master_delivery_runsheet","tbl_master_delivery_runsheet.runsheet_id = tbl_delivery_runsheet_details.r_id");
        $this->db->join("tbl_employee","tbl_employee.id = tbl_delivery_runsheet_details.delivery_personnel_id");
        // $this->db->join("tbl_driver_delivery_details","tbl_driver_delivery_details.driver_id = tbl_delivery_runsheet_details.delivery_personnel_id");
        $this->db->where('delivery_personnel_id', $id);
        $this->db->where('status', 'Pending');
        $this->db->order_by('rsno', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        // $this->db->group_by('rsno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array(); 
        }else{
            return false;
        }
    }

    public function getAllDetailsForDriverByIdByCnn($id = null, $cnn = null, $status = null) {
        $this->db->select("*");
        $this->db->from("tbl_delivery_runsheet_details");
        $this->db->join("tbl_master_delivery_runsheet","tbl_master_delivery_runsheet.runsheet_id = tbl_delivery_runsheet_details.r_id");
        $this->db->join("tbl_employee","tbl_employee.id = tbl_delivery_runsheet_details.delivery_personnel_id");
        $this->db->where('delivery_personnel_id', $id);
        $this->db->where('tbl_delivery_runsheet_details.status', $status);
        $this->db->where('cnno', $cnn);
        $this->db->order_by('rsno', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
        // $this->db->group_by('rsno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array(); 
        }else{
            return false;
        }
    }


    // update the invoice in the database
    public function updatePod($data = null, $cn = null) {

        $this->db->where('cnno', $cn);
        try {
            if($this->db->update('tbl_pod_details', $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    // update the invoice in the database
    public function updateStatusInBranch($data = null, $cn = null) {

        $this->db->where('cnno', $cn);
        try {
            if($this->db->update('tbl_delivery_runsheet_details', $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function checkCnn($id = null, $cnn = null) {
        $this->db->select("*");
        $this->db->from("tbl_driver_delivery_details");
        $this->db->where('driver_id', $id);
        $this->db->where('cnno', $cnn);
        // $this->db->group_by('rsno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true; 
        }else{
            return false;
        }
    }

    // update the invoice in the database
    public function updateDetails($data = null, $cn = null) {

        $this->db->where('cnno', $cn);
        try {
            if($this->db->update('tbl_driver_delivery_details', $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    public function saveDetails($data = null){
        if($this->db->insert("tbl_driver_delivery_details",$data)) {
            return true;
        }
    }

    public function getCnnByStatusByDriverId($id = null) {
        $this->db->select("*");
        $this->db->from("tbl_driver_delivery_details");
        $this->db->where('status', 'Delivered');
        $this->db->where('driver_id', $id);
        // $this->db->group_by('rsno');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

}
?>