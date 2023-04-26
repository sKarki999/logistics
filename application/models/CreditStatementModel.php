<?php
class CreditStatementModel extends CI_Model {

    public function getRequiredCredistatement($customer_id = null, $date_from = null, $date_to = null, $branch_id = null){
        $this->db->select("*");
        $this->db->from("tbl_invoice");
        // $this->db->join("tbl_branch","tbl_branch.branch_id = tbl_invoice.receiver_branch_id");
        $this->db->where("customer_id",$customer_id);
        $this->db->where('booking_date >= date("'.$date_from.'")');
        $this->db->where('booking_date <= date("'.$date_to.'")');
        //$this->db->where("payment_mode","credit");
        //$this->db->where("tbl_invoice.status"," ");
        $this->db->where("statement_no"," ");
        $this->db->where("branch_id",$branch_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
        }
}
?>