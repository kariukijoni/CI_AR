<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author kariukye
 */
class Landing_page extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['page_title'] = 'ABS';
        $this->load->view('Home/landing_page', $data);
    }

}
