<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Install Database scheme for the application
 */
class Install extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/install
     */
    public function index()
    {
        $this->load->model('DbScheme');

        $data = array();
        $data['message'] = "Application Installed";
        $data['message_type'] = "success";
        $this->load->view('home', $data);
    }

}