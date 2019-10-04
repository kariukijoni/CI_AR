<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User
 *
 * @author kariukye
 */
class S_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('S_user_model', 'user');
    }

    public function manage_user() {
        $data['page_title'] = 'ABS | User';
        $data['content_view'] = 'pages/dashboard/s_user_view';
        $this->load->view('template/template_view', $data);
    }

    public function user_list() {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $user->firstname;
            $row[] = $user->lastname;
            $row[] = $user->email_address;
            $row[] = $user->name;
            $row[] = $user->phone_number;
            $row[] = '<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Edit" onclick="edit_user(' . "'" . $user->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Delete" onclick="delete_user(' . "'" . $user->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function user_edit($id) {
        $data = $this->user->get_by_id($id);
        echo json_encode($data);
    }

    public function user_add() {
        $this->_validate();
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email_address' => $this->input->post('email_address'),
            'phone_number' => $this->input->post('phone_number'),
            'password' => md5($this->input->post('password')),
            'nameId' => $this->input->post('nameId'),
            'createdDtm' => date('Y-m-d H:i:s'),
            'updatedDtm' => date('Y-m-d H:i:s')
        );
        $insert = $this->user->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function user_update() {
        $this->_validate();
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email_address' => $this->input->post('email_address'),
            'phone_number' => $this->input->post('phone_number'),
            'password' => md5($this->input->post('password')),
            'nameId' => $this->input->post('nameId'),
            'createdDtm' => date('Y-m-d H:i:s'),
            'updatedDtm' => date('Y-m-d H:i:s')
        );
        $this->user->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function user_delete($id) {
        $this->user->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('firstname') == '') {
            $data['inputerror'][] = 'firstname';
            $data['error_string'][] = 'First Name is required';
            $data['status'] = FALSE;
        }


        if ($this->input->post('lastname') == '') {
            $data['inputerror'][] = 'lastname';
            $data['error_string'][] = 'Last Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('email_address') == '') {
            $data['inputerror'][] = 'email_address';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nameId') == '') {
            $data['inputerror'][] = 'nameId';
            $data['error_string'][] = 'Role type is required';
            $data['status'] = FALSE;
        }


        if ($this->input->post('phone_number') == '') {
            $data['inputerror'][] = 'phone_number';
            $data['error_string'][] = 'Mobile is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
