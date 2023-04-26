<?php
class VendorOrderModel extends CI_Model {

    public function getAllOrdersByCustomerId($customer_id = null){
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        // $this->db->join("tbl_driver_delivery_details","tbl_invoice.bill_number = tbl_driver_delivery_details.cnno");
        $this->db->where("tbl_invoice.customer_id",$customer_id);
        $this->db->order_by("bill_number","DESC");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    // count the number of invoices
    public function countInvoices($tableName = null, $id = null){
        $this->db->select('*')->from("tbl_invoice")->where("customer_id", $id);
        $query = $this->db->get();
        try{
        
            if($query->num_rows() > 0) {
                return $query->num_rows();
            } else {
                return 0;
            }   
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
     }
    // package status count
    public function countPackageStatus($customer_id = null, $status = null) {
        $this->db->select('*')
            ->from('tbl_invoice')
            ->where('delivery_status', $status)
            ->where('customer_id', $customer_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getInvoicesByCustomerByStatus($id = null, $status = null) {
        $this->db->select("*")
        ->from('tbl_invoice')
        ->where('customer_id', $id)
        ->where('delivery_status', $status)
        ->order_by('bill_number', 'DESC');
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
    
}
?>