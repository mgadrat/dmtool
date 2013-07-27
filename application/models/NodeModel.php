<?php

class NodeModel extends CI_Model {


    /** 
     * 
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        // Load database
        $this->load->database();
    }

    /**
     * Load the Node object from DB
     * 
     * @param  int $nid The nid of the object
     * @return bool true if sucessfull False if fail
     */
    public function load($nid){

        if(!is_int($nid)){
            show_error('Parameter for load method of Node Object should be an Integer');
            return false;
        }

        $query = $this->db->get_where('nodes', array('nid' => $nid), 1);

        $row = $query->row();

        // if no result return false, no error thrown
        if(empty($row)){
            return false;
        }

        // Populate the node
        foreach (get_object_vars($row) as $key => $value) {
            $this->$key = $value;
        }

        return true;

    }
    

}