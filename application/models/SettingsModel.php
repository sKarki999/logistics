<?php
class SettingsModel extends CI_Model {


    public function getSettings() {
        $this->db->select('*')
            ->from('tbl_business_info');
        
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function update($tablename = null, $data = null, $id = null, $field = null) {
        $this->db->where($field, $id);
        try {
            if($this->db->update($tablename, $data)) {
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