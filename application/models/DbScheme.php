<?php

class DbScheme extends CI_Model {

    var $version = '0.0.0.0';

    /** 
     * Verify if there's already a scheme installed
     * ask for confirmation to replace scheme
     * Install DB Scheme
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        if(!$this->is_scheme_installed()){
            $this->create_scheme();
        }
        
    }
    
    /**
     * Verify if the db scheme is already installed
     * 
     * @return bool
     */
    private function is_scheme_installed()
    {
        return FALSE;
    }

    /**
     * Delete current db scheme
     * 
     * @return bool TRUE on success FALSE on failure
     */
    private function delete_current_scheme()
    {
        // Load dbforge
        $this->load->dbforge();

        // Load application scheme
        $tables = $this->get_scheme();

        foreach($tables as $key => $table){
            $this->dbforge->drop_table($key);
        }

        return TRUE;
    }

    /**
     * Install dmtools db scheme
     * 
     * @return bool TRUE on success FALSE on failure
     */
    private function create_scheme(){

        // (temp)
        // delete scheme
        $this->delete_current_scheme();

        // Load dbforge
        $this->load->dbforge();

        // Load application scheme
        $tables = $this->get_scheme();

        // Parse scheme and create each tables
        foreach($tables as $key => $table){

            $this->dbforge->add_field($table['scheme']);

            // if a primary is defined use it, if not use default CI implementation
            if(isset($table['primary'])){
                $this->dbforge->add_key($table['primary'], TRUE);
            }else{
                $this->dbforge->add_field('id');
            }

            // Create table
            $this->dbforge->create_table($key);

        }

        return TRUE;
    }

    /**
     * Returns a nested array representing the full
     * database scheme of the application
     * 
     * @return Array Full db scheme of the application
     */
    private function get_scheme(){

        return array(
            'node' => array(
                'scheme' => array(
                    'nid' => array(
                         'type'           => 'INT',
                         'constraint'     => 11, 
                         'unsigned'       => TRUE,
                         'auto_increment' => TRUE
                    ),
                    'type' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                    ),
                    'title' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                    ),
                    'uowner' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    'gowner' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    'lore' => array(
                         'type' => 'TEXT',
                         'null' => TRUE,
                    ),
                ),
                'primary' => 'nid',
            ),// end of node table
        );

    }

}