<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dmtool extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('home');
    }

    /**
     * Static test
     */
    public function test(){

        $this->load->model('Node');
        $this->load->model('Creature');
        $this->load->model('Character');
        
        $character = new Character;
        $character->load(1);

        echo '<pre>';
        var_dump($character);
        echo '<pre>';

        $data = array();
        $data['output'] = "Application Installed";
        $this->load->view('home', $data);

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */