<?php

class LocationModel extends CI_Model {
    
    /**
     * method to get All Locations from given table
     *
     */
    public function getAllLocations() {
        $this->db->select('*')->from('tbl_location');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        } 
    }

    /**
     * method to get All tiemzones from given table
     *
     */
    public function getAllTimezones() {
        $this->db->select('*')->from('tbl_timezone');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        } 
    }


    /**
     * countLocations
     *
     * @param mixed tablename
     *
     * return number of rows in the given table
     */
    public function countLocations($tablename = null) {
        $this->db->select('*');
        $this->db->from($tablename);
        $query = $this->db->get();
        try{
        
            if($query->num_rows() > 0) {
                return $query->num_rows();
            } else {
                return 'false';
            }   
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }
    
    
    /**
     * getLocationsWithPagination
     *
     * @param mixed startPage
     * @param mixed perPage
     *
     */
    
    public function getLocationsWithPagination($startPage = null, $perPage = null) {
        $this->db->select("*")
            ->from('tbl_location')
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


    /**
     * method to save location into tablename
     *
     * @param mixed tablename
     * @param mixed data
     *
     * @return void
     */
    public function save($tablename, $data) {
        try {
            if($this->db->insert($tablename,$data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
        
        
    }
    
    
    /**
     * method to get Location based on id
     *
     * @param mixed id
     *
     */

    public function getLocationById($id = null) {

        $this->db->select('*');
        $this->db->from('tbl_location');
        $this->db->where('location_id', $id);
        $query = $this->db->get();
        try {
            if($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    /**
     * method to update Location
     *
     * @param mixed tablename
     * @param mixed data
     * @param mixed id
     * @param mixed field
     *
     */

    public function updateLocation($tablename = null, $data = null, $id = null, $field = null) {
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
    
    /**
     * deleteLocationById
     *
     * @param mixed tablename
     * @param mixed id
     * @param mixed field
     *
     */
    public function deleteLocationById($tablename = null, $id = null, $field = null) {
        $this->db->where($field, $id);
        try {
            if($this->db->delete($tablename)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("<h3>Error:</h3>". $e->getMessage());
        }
    }

    /**
     * getsearchedLocationsWithPagination
     *
     * @param mixed search
     * @param mixed startPage
     * @param mixed perPage
     *
     * @return array of searched locations
     */

    public function getsearchedLocationsWithPagination($search = null, $startPage = null, $perPage = null) {
        $this->db->select("*")
            ->from('tbl_location')
            ->where("location_name LIKE '%$search%'")
            ->limit($perPage, $startPage);
        $query = $this->db->get();
        return $query->result_array(); 
    }

    /**
     * countSpecificLocations
     *
     * @param mixed tablename
     * @param mixed search
     *
     * @return number of rows
     */

    public function countSpecificLocations($tablename = null, $search = null) {
        $this->db->select('*')
            ->from($tablename)
            ->where("location_name LIKE '%$search%'");
            $query = $this->db->get();
            return $query->num_rows();
    }

}

?>



