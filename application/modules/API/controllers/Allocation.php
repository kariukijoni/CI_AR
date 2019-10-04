<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

/**
 *
 * @package         ART
 * @subpackage      API
 * @category        Controller
 * @author          Kevin Marete
 * @license         MIT
 * @link            https://github.com/KevinMarete/ART
 */
class Allocation extends \API\Libraries\REST_Controller  {

    function __construct()
    {
        parent::__construct();
        $this->load->model('allocation_model');
    }

    public function index_get()
    {
        // counties from a data store e.g. database
        $mflcode = $this->get('mfl');
        $period = (!empty($_GET['period'])) ? substr($this->get('period'), 0,4).'-'.substr($this->get('period'), 4).'-01': NULL;

        if (empty($_GET['mfl']))
        {   
                // Set the response and exit
            $this->set_response([
                'status' => FALSE,
                'message' => 'MFL Code not specified'
                ], \API\Libraries\REST_Controller::HTTP_NOT_FOUND);// NOT_FOUND (404) being the HTTP response code
            
            die;
        }
        // Find and return a single record for a particular county.
        else {
            $counties = $this->allocation_model->read($mflcode,$period);

            if (!empty($counties))
            {
                $this->set_response($counties, \API\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'No Allocation Data Found'
                ], \API\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
}