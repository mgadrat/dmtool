<?php

class Character extends Creature {


    /** 
     * 
     */
    function __construct()
    {
        // Call the Node constructor
        parent::__construct();
    }

    /**
     * Load the Character object from DB
     * 
     * @param  int $nid The nid of the object
     * @return bool true if sucessfull False if fail
     */
    public function load($nid){

        if(!is_int($nid)){
            show_error('Parameter for load method of Node Object should be an Integer');
            return false;
        }

        $this->db->select('*');
        $this->db->from('nodes');
        $this->db->join('creatures', 'nodes.nid = creatures.nid');
        $this->db->join('characters', 'nodes.nid = characters.nid');
        $this->db->where('nodes.nid', $nid); 

        $query = $this->db->get();

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