<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	var $table = 'tbl_user';

    public function check_user($data){
		$response = array();
		try{
			$user_data = $this->db->get_where($this->table, array('email_address' => $data['email_address'], 'password' =>md5($data['password'])))->row_array();
			if(!empty($user_data)){
				$response['message'] = 'Welcome, <b>'.$user_data['firstname'].'</b> to the Commodity Manager!';
				unset($user_data['password']);
				$response['data'] = $user_data;
				$response['data']['scope_name'] = 'NASCOP';
				//Get menu data
				$this->db->select('m.name module,m.icon, sm.name submodule, r.name role, IF(us.scope_id IS NULL, " ", us.scope_id) scope', FALSE);
				$this->db->from('tbl_role_submodule rsm');
				$this->db->join('tbl_submodule sm', 'sm.id = rsm.submodule_id', 'inner');
				$this->db->join('tbl_module m', 'm.id = sm.module_id', 'inner');
				$this->db->join('tbl_role r', 'r.id = rsm.role_id', 'inner');
				$this->db->join('tbl_user_scope us', 'us.role_id = rsm.role_id AND us.user_id = '.$user_data['id'], 'left');
				$this->db->where(array('rsm.role_id' => $user_data['role_id']));
				foreach ($this->db->get()->result_array() as $value) {
					$response['data']['modules'][$value['module']]['icon'] = $value['icon'];
					$response['data']['modules'][$value['module']]['submodules'][] = $value['submodule'];
					$response['data']['role'] = $value['role'];
					$response['data']['scope'] = $value['scope'];
				}
				//Set scopename
				if(in_array($response['data']['role'], array('subcounty', 'county'))){
					$this->db->select('name');
					$response['data']['scope_name'] = $this->db->get_where('tbl_'.$response['data']['role'], array('id' => $response['data']['scope']))->row_array()['name'];
				}
				$response['status'] = TRUE;
			}else{
				$response['message'] = 'Please enter valid user account credentials!';
				$response['status'] = FALSE;
			}
		}catch(Execption $e){
			$response['status'] = FALSE;
			$response['message'] = $e->getMessage();
		}
		return $response;
	}

	public function create_user($data){
		$response = array();
		try{
			$scope_id = $data['scope_id'];
			$data['password'] = md5($data['password']);
			unset($data['cpassword']);
			unset($data['scope_id']);
			$this->db->insert($this->table, $data);
			$count = $this->db->affected_rows();
			if($count > 0){
				$data['id'] = $this->db->insert_id();
				//Assign scope of user role
				if($scope_id){
					$this->db->replace('tbl_user_scope', array('scope_id' => $scope_id, 'role_id' => $data['role_id'], 'user_id' => $data['id']));	
				}
				//Set response message
				$response['message'] = 'User account for <b>'.$data['firstname'].' '.$data['lasttname'].'</b> was created!';
				$response['data'] = $data;
				$response['status'] = TRUE;
			}else{
				$response['message'] = 'The email address <b>'.$data['email_address'].'</b> is already used in another account!';
				$response['status'] = FALSE;
			}
		}catch(Execption $e){
			$response['status'] = FALSE;
			$response['message'] = $e->getMessage();
		}
		return $response;
	}

	public function reset_user($data){
		$response = array();
		try{
			$user_data = $this->db->get_where($this->table, array('email_address' => $data['email_address']))->row_array();
			if(!empty($user_data)){
				//Create new password
				$characters = strtoupper("abcdefghijklmnopqrstuvwxyz") . 'abcdefghijklmnopqrstuvwxyz0123456789';
				$random_string_length = 8;
				$password = '';
				for ($i = 0; $i < $random_string_length; $i++) {
					$password .= $characters[rand(0, strlen($characters) - 1)];
				}
				//Update new password
				$this->db->where('email_address', $data['email_address']);
				$this->db->update($this->table, array('password' => md5($password)));
				$count = $this->db->affected_rows();
				if($count > 0){
					$response['message'] = 'Please check <b>'.$data['email_address'].'</b> for the new password!';
					$user_data['password'] = $password;
					$response['data'] = $user_data;
					$response['status'] = TRUE;
				}else{
					$response['message'] = 'The password for user account linked to <b>'.$data['email_address'].'</b> cannot be reset!';
					$response['status'] = FALSE;
				}
			}else{
				$response['message'] = 'The user account linked to <b>'.$data['email_address'].'</b> does not exist!';
				$response['status'] = FALSE;
			}
		}catch(Execption $e){
			$response['status'] = FALSE;
			$response['message'] = $e->getMessage();
		}
		return $response;
	}

	public function update_user($data, $id){
		$response = array();
		try{
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			$count = $this->db->affected_rows();
			if($count > 0){
				$response['message'] = 'User Profile for <b>'.$data['firstname'].' '.$data['lasttname'].'</b> was updated!';
				$response['data'] = $data;
				$response['status'] = TRUE;
			}else{
				$response['message'] = 'User Profile for <b>'.$data['firstname'].' '.$data['lasttname'].'</b> could not be updated!';
				$response['status'] = FALSE;
			}
		}catch(Execption $e){
			$response['status'] = FALSE;
			$response['message'] = $e->getMessage();
		}
		return $response;
	}

	public function change_password($data, $id){
		$response = array();
		try{
			$user_data = $this->db->get_where($this->table, array('id' => $id, 'password' => md5($data['oldpassword'])))->row_array();
			if(!empty($user_data)){
				$this->db->where('id', $id);
				$this->db->update($this->table, array('password' => md5($data['password'])));
				$count = $this->db->affected_rows();
				if($count > 0){
					$response['message'] = 'Password was changed!';
					$response['status'] = TRUE;
				}else{
					$response['message'] = 'Password was not changed!';
					$response['status'] = FALSE;
				}
			}else{
				$response['message'] = 'Old Password does not match!';
				$response['status'] = FALSE;
			}
		}catch(Execption $e){
			$response['status'] = FALSE;
			$response['message'] = $e->getMessage();
		}
		return $response;
	}

}