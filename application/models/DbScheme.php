<?php

define('SCHEME_STATUS_ABSENT', 0);
define('SCHEME_STATUS_OK', 1);
define('SCHEME_STATUS_OUT_OF_DATE', 2);

class DbScheme extends CI_Model {

    var $version = '0.0.0.1';

    /** 
     * Verify if there's already a scheme installed
     * ask for confirmation to replace scheme
     * Install DB Scheme
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        // Load dbforge && database
        $this->load->dbforge();
        $this->load->database();
    }
    
    /**
     * Verify if the db scheme is already installed
     * 
     * @return int the status of the database scheme
     */
    private function get_scheme_status()
    {
        // Check if schema installed
        $tables = $this->db->query('SHOW TABLES')->result();
        if(empty($tables)){
            return SCHEME_STATUS_ABSENT;
        }

        // Query schema version
        $scheme_version = $this->db->get_where('system', array('variable' => 'scheme_version'))->result();

        if(empty($scheme_version[0]->value)){
            return SCHEME_STATUS_ABSENT;
        }else if($scheme_version[0]->value != $this->version){
            return SCHEME_STATUS_OUT_OF_DATE;
        }

        return SCHEME_STATUS_OK;
    }

    /**
     * Delete current db scheme
     * 
     * @return bool TRUE on success FALSE on failure
     */
    private function delete_current_scheme()
    {

        // Load application scheme
        $tables = $this->get_scheme();

        foreach($tables as $key => $table) {
            $this->dbforge->drop_table($key);
        }

        return TRUE;
    }

    /**
     * Install dmtools db scheme
     * 
     * @return bool TRUE on success FALSE on failure
     */
    public function create_scheme() {

        // (temp)
        // delete scheme
        // $this->delete_current_scheme();

        // Load application scheme
        $tables = $this->get_scheme();

        // Parse scheme and create each tables
        foreach($tables as $key => $table) {

            $this->dbforge->add_field($table['scheme']);

            // if a primary is defined use it, if not use default CI implementation
            if(isset($table['primary'])) {
                $this->dbforge->add_key($table['primary'], TRUE);
            } else {
                $this->dbforge->add_field('id');
            }

            // Create table
            $this->dbforge->create_table($key);

        }

        $data = array(
           'variable' => 'scheme_version' ,
           'value'    => $this->version,
        );

        $this->db->insert('system', $data); 

        return TRUE;
    }

    /**
     * Returns a nested array representing the full
     * database scheme of the application
     *
     * This method is public so the other models
     * can access the application scheme
     * 
     * @return Array Full db scheme of the application
     */
    public function get_scheme() {

        return array(
            // System information and configuration
            'system' => array(
                'scheme' => array(
                    'variable' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                    ),
                    'value' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                    ),
                ),
                'primary' => 'variable',
            ),
            'nodes' => array(
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
            ), // end of node table
            'creatures' => array(
                'scheme' => array(
                    // Node id
                    'nid' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // level (characters and Monsters)
                    'level' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // maximum health point
                    'max_hp' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // health point
                    'hp' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                    ),
                    // maximum action point
                    'max_ap' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // action point
                    'ap' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Ability Strengh
                    'ab_str' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Ability Constitution
                    'ab_con' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Ability Dexterity
                    'ab_dex' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Ability Intelligence
                    'ab_int' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Ability Wisdom
                    'ab_wis' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Ability Charisma
                    'ab_cha' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),

                ),
            ), // end of creatures table
            'characters' => array(
                'scheme' => array(
                    // Node Id
                    'nid' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Experience accumulated
                    'xp' => array(
                         'type'       => 'INT',
                         'constraint' => 11, 
                         'unsigned'   => TRUE,
                    ),
                    // Race
                    'race' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                    ),
                    // Size (S, M, L)
                    'size' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                    ),
                    // Character class
                    'class' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                    ),
                    // Paragon Path
                    'paragon' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // Epic Destiny
                    'epic' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // Gods
                    'deity' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // How old
                    'age' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // Male / Female / Other...
                    'gender' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // Vertically
                    'height' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // Horizontally
                    'weight' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // Good / evil
                    'alignment' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                    // Company or affiliation in the game
                    'affiliation' => array(
                         'type'       => 'VARCHAR',
                         'constraint' => '255',
                         'null'       => TRUE,
                    ),
                ),
            ), // end of characters table
        );

    }

}