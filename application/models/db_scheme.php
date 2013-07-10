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

        // Load dbforge
        $this->load->dbforge()

        // Node Table
        $fields = array(
            'nid' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
            ),
            'type' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255',
            ),
            'title' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '255',
            ),
            'uowner' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE,
            ),
            'gowner' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE,
            ),
            'lore' => array(
                 'type' => 'TEXT',
                 'null' => TRUE,
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('node');

        
    }
    
    function detect_current_scheme()
    {
        return TRUE;
    }

    function delete_current_scheme()
    {
        return TRUE;
    }

}