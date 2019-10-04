<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

	public function authenticate()
	{	
		$response = $this->User_model->check_user($this->input->post());
		if($response['status']){
			$this->session->set_userdata($response['data']);
			//Go to dashboard
			$message = '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.$response['message'].'</div>';
			$this->session->set_flashdata('dashboard_msg', $message);
                        redirect('manager/dashboard');
//			if(in_array($this->session->userdata('role'), array('subcounty', 'county', 'national'))){
//				redirect('manager/orders/reporting_rates');	
//			}else{
//				redirect('manager/dashboard');
//			}
		}else{
			//Go to login with error message
			$message = '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> '.$response['message'].'</div>';
			$this->session->set_flashdata('user_msg', $message);
			redirect('manager/login');
		}
	}

	public function get_role_scope($role){
		$response = array();
		$exempted_scopes = array('admin', 'national');
		if(!in_array($role, $exempted_scopes)){
			$response = $this->db->order_by('name', 'ASC')->get('tbl_' . $role)->result_array();
		}
		echo json_encode($response);
	}

	public function create_account()
	{
		$response = $this->User_model->create_user($this->input->post());
		if($response['status']){
			//Go to Login with success message
			$message = '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> '.$response['message'].'</div>';
			$this->session->set_flashdata('user_msg', $message);
			redirect('manager/login');
		}else{
			//Go to registration page with error message
			$message = '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> '.$response['message'].'</div>';
			$this->session->set_flashdata('user_msg', $message);
			redirect('manager/register_account');
		}
	}

	public function reset_account()
	{
		$response = $this->User_model->reset_user($this->input->post());
		if($response['status']){
			//Send new password to email
			$email_response = $this->send_password($response['data']['firstname'].' '.$response['data']['lastname'], $response['data']['email_address'], $response['data']['password']);
			//Go to Login with success message
			$message = '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> '.$response['message'].'</div>';
			//Append email message
			$message .= $email_response['message'];
			$this->session->set_flashdata('user_msg', $message);
			redirect('manager/login');
		}else{
			//Go to forgot page with error message
			$message = '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> '.$response['message'].'</div>';
			$this->session->set_flashdata('user_msg', $message);
			redirect('manager/forgot_pass');
		}
	}

	public function send_password($receipent_name, $email_address, $password) {
		$config['mailtype'] = 'html';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = stripslashes('webadt.chai@gmail.com');
		$config['smtp_pass'] = stripslashes('WebAdt_052013');

		$this -> load -> library('email', $config);
		$this -> email -> set_newline("\r\n");
		$this -> email -> from('noreply@absbahamas.org', 'Bahamas');
		$this -> email -> to($email_address);
		$this -> email -> subject('ABS Bahamas | User Password Reset');
		$this -> email -> message('Dear '.$receipent_name.', <br/> Your account password was changed to:<b> '.$password.'</b><br><br>Regards,<br>ABS Bahamas Team');

		if($this -> email -> send()){
			$data['message'] = '<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Success!</strong> New password was sent to <b>' . $email_address . '</b></div>';
			$data['status'] = TRUE;
			$this -> email -> clear(TRUE);
		}else {
			$data['message'] = '<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Error!</strong> '.$this -> email -> print_debugger().'</div>';;
			$data['status'] = FALSE;
		}
		return $data;
	}

	public function update_profile(){
		$response = $this->User_model->update_user($this->input->post(), $this->session->userdata('id'));
		if($response['status']){
			$this->session->set_userdata($response['data']);
			//Go to profile page with success message
			$message = '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> '.$response['message'].'</div>';
		}else{
			//Go to profile page with error message
			$message = '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> '.$response['message'].'</div>';
		}
		$this->session->set_flashdata('user_msg', $message);
		redirect('manager/profile');
	}

	public function update_password(){
		$response = $this->User_model->change_password($this->input->post(), $this->session->userdata('id'));
		if($response['status']){
			//Go to profile page with success message
			$message = '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> '.$response['message'].'</div>';
		}else{
			//Go to profile page with error message
			$message = '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> '.$response['message'].'</div>';
		}
		$this->session->set_flashdata('user_msg', $message);
		redirect('manager/profile');
	}

	public function logout(){
		$this->session->sess_destroy();
		//redirect('manager/login');
                redirect('manager/home');
	}
	
}