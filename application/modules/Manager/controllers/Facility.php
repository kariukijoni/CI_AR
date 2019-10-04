<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author kariukye
 */
class Facility extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Facility_model', 'facility');
    }
     public function facility() {
        $data['page_title'] = 'ABS | Facility';
        $data['content_view'] = 'pages/dashboard/facility_view';
        $this->load->view('template/template_view', $data);
    }


    public function facility_list() {
        $list = $this->facility->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $facility) {
            $no++;
            $row = array();
            $row[] = $facility->facility;
            $row[] = $facility->Sub_County;
            $row[] = $facility->Level;
            $row[] = $facility->Owner;
            $row[] = $facility->Focal_Person;
            $row[] = $facility->Partner_Support;
            $row[] = '<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Edit" onclick="edit_facility(' . "'" . $facility->ID . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Delete" onclick="delete_facility(' . "'" . $facility->ID . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->facility->count_all(),
            "recordsFiltered" => $this->facility->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function facility_edit($id) {
        $data = $this->facility->get_by_id($id);
        echo json_encode($data);
    }

    public function facility_add() {
        $this->_validate();
        $insert = $this->facility->save($_POST);
        echo json_encode(array("status" => TRUE));
    }

    public function facility_update() {
        $this->_validate();
        $this->facility->update(array('ID' => $this->input->post('ID')), $_POST);
        echo json_encode(array("status" => TRUE));
    }

    public function facility_delete($id) {
        $this->facility->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('facility') == '') {
            $data['inputerror'][] = 'facility';
            $data['error_string'][] = 'Facility Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('Sub_County') == '') {
            $data['inputerror'][] = 'Sub_County';
            $data['error_string'][] = 'Sub County is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('Level') == '') {
            $data['inputerror'][] = 'Level';
            $data['error_string'][] = 'Level is required';
            $data['status'] = FALSE;
        }


        if ($this->input->post('Owner') == '') {
            $data['inputerror'][] = 'Owner';
            $data['error_string'][] = 'Owner is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('Focal_Person') == '') {
            $data['inputerror'][] = 'Focal_Person';
            $data['error_string'][] = 'Focal Person is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('Partner_Support') == '') {
            $data['inputerror'][] = 'Partner_Support';
            $data['error_string'][] = 'Partner Support is required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
