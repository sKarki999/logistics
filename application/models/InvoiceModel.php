<?php
    class InvoiceModel extends CI_Model {

        // to get all branches except the current branch
        public function getAllReceiverBranch($branch_id = null){
            $this->db->select("*");
            $this->db->from("tbl_branch");
            // $this->db->where_not_in("branch_id",$branch_id);
            $this->db->order_by("branch_name","ASC");
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return false;
            }
         }
         
         /**
          * method to get Columns from the passed table
          *
          * @param mixed tableName
          * @param mixed id
          * @param mixed idValue
          * @param mixed field
          *
          */
         public function getColHead($tableName = null, $id = null, $idValue = null, $field = null){
            $this->db->select($field);
            $this->db->from($tableName);
            $this->db->where($id,$idValue);
            $this->db->limit(1);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            }
         }


         /**
         * getCnno
         *
         * @return void
         */

         public function getCNNumber() {
            $this->db->select("bill_number");
            $this->db->from("tbl_invoice");
            $this->db->order_by('invoice_id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            }
         }


         // save the invoice into database
         public function saveInvoice($data = null) {
            if($this->db->insert('tbl_invoice',$data)) {
                        return true;
                    } else {
                        return false;
                    }
            }

        /**
         * method to get All invoice
         *
         */
        public function getAllInvoice($branch_id = null) {
            $this->db->select('*')->from('tbl_invoice')->where('branch_id', $branch_id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            } 
        }

        /**
         * method to get All invoice
         *
         */
        public function getInvoiceByCnn($branch_id = null, $cnn = null) {
            $this->db->select('*')->from('tbl_invoice')->where('branch_id', $branch_id)->where('bill_number', $cnn);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            } 
        }

        // get all invoice details from database based on id
        public function getInvoiceDetailsById($id =  null) {
            $this->db->select('*')
                ->from('tbl_invoice')
                ->where('invoice_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }

        // update the invoice in the database
        public function updateInvoice($id = null,$data = null) {
            $this->db->where('invoice_id', $id);
                if($this->db->update('tbl_invoice', $data)) {
                    return true;
                } else {
                    return false;
                }
        }

        public function updateOneFieldInInvoice($data = null, $cnno = null){
            $this->db->where("bill_number", $cnno);
            if($this->db->update("tbl_invoice", $data)){
                return true;
            }else{
                return false;
            }
        }
        
        // update status in the invoice table in the database
        public function updateStatus($data = null, $id = null) {

            $this->db->where('invoice_id', $id);
            try {
                if($this->db->update('tbl_invoice', $data)) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                die("<h3>Error:</h3>". $e->getMessage());
            }
        }
        // method to delete the invoice from database
        public function deleteInvoiceById($id = null) {
            $this->db->where('invoice_id', $id);
            try {
                if($this->db->delete('tbl_invoice')) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                die("<h3>Error:</h3>". $e->getMessage());
            }
        }

        // count the number of invoices
        public function countInvoices($tableName = null, $id = null){
            $this->db->select('*')->from("tbl_invoice")->where("branch_id", $id);
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

         public function countSpecificInvoices($tablename = null, $search = null, $id = null) {
            $this->db->select('*')
                ->from($tablename)
                ->where('receiver_branch_id', $id)
                ->where("one_time_cust LIKE '%$search%'");
                $query = $this->db->get();
                return $query->num_rows();
        }

        public function searchCNN($search = null) {
            $this->db->select('*');
            $this->db->from('tbl_invoice');
            $this->db->where('bill_number', $search);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return 'false';
            }

        }


         // fetch data from database based on given parameters
         public function getInvoicesWithPaginationByBranch($startPage = null, $perPage = null, $id=null) {
            $this->db->select("*")
                ->from('tbl_invoice')
                ->where('branch_id', $id)
                ->order_by('bill_number', 'DESC')
                ->limit($perPage, $startPage);
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

        public function getInvoicesWithPaginationByBranchByStatus($startPage = null, $perPage = null, $id = null, $status = null) {
            $this->db->select("*")
            ->from('tbl_invoice')
            ->where('branch_id', $id)
            ->where('delivery_status', $status)
            ->order_by('bill_number', 'DESC')
            ->limit($perPage, $startPage);
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
        
        // fetch data from database based on given parameters
         public function getSearchedInvoicesWithPaginationByBranch($startPage = null, $perPage = null, $search = null, $id = null) {
            $this->db->select("*")
                ->from('tbl_invoice')
                ->where('receiver_branch_id', $id)
                ->where('bill_number', $search)
                ->limit($perPage, $startPage);
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

        // method to get cn number from database
        public function getCnno(){
            $this->db->select("bill_number");
            $this->db->from("tbl_invoice");
            $this->db->order_by('invoice_id', 'DESC'); // 'create_at' is the column name of the date on which the record has stored in the database.
            $this->db->limit(1);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            }
         }

         // method to get all countries from database
         public function getAllCountries() {
            $this->db->select('*')
                ->from('tbl_countries');
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }

         }

        // package status count
        public function countPackageStatus($branch_id = null, $status = null) {
        $this->db->select('*')
            ->from('tbl_invoice')
            ->where('delivery_status', $status)
            ->where('branch_id', $branch_id);
        $query = $this->db->get();
        return $query->num_rows();
        }

        public function getRequiredBranchDetails($id = null){
            $this->db->select("*");
            $this->db->from("tbl_branch");
            $this->db->where("branch_id", $id);
            $this->db->limit(1);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            }
        }

    }
?>