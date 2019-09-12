<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	private function is_verified() {
		$this->load->library('session');
		$session_hash = sha1($this->session->userdata('username').$this->session->userdata('faculty_name'));
		if ($session_hash == $this->session->userdata('session_hash')) {
			return TRUE;
		}
		return FALSE;
	}

	public function register()
	{
		if ($this->is_verified()) {
			redirect(base_url()."user/profile");
		} else {
			$this->load->database();
			$this->db->select('name');
			$query = $this->db->get('faculty');
			$data = array('faculties' => $query );
			$this->load->template('users/register', $data);
		}
	}

	public function register_process() {
		$this->load->database();
		$query = $this->db->get_where('faculty', array('name' => $this->input->post('faculty')));
		$query = $query->row();
		if ($this->input->post('token') == $query->auth_token) {
			$enc_pwd = sha1($this->input->post('password'));
			$data = array(
				'faculty_name' => $this->input->post('faculty'),
				'username' => $this->input->post('username'),
				'leader_name' => $this->input->post('display_name'),
				'password' => $enc_pwd,
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone')
			);
			$this->db->insert('contingent', $data);
			redirect(base_url()."user/login");
		} else {
			$this->load->library('session');
			$this->session->set_userdata(array('err_msg' => "Something went wrong. Please check your data again!"));
			redirect(base_url()."user/register");
		}
	}

	public function login()
	{
		if ($this->is_verified()) {
			redirect(base_url()."user/profile");
		} else {
			$this->load->template('users/login');
		}
	}

	public function login_process() {
		$this->load->database();
		$enc_pwd = sha1($this->input->post('password'));
		$query = $this->db->get_where('contingent', array(
			'username' => $this->input->post('username'),
			'password' => $enc_pwd
		));
		$this->load->library('session');
		if ($query->num_rows() != 0) {
			$data = $query->row();
			$session_data = array(
				'faculty_name' => $data->faculty_name, 
				'username' => $data->username, 
				'display_name' => $data->leader_name, 
				'session_hash' => sha1($data->username.$data->faculty_name)
			);
			$this->session->set_userdata($session_data);
			redirect(base_url()."user/profile");
		} else {
			$this->session->set_userdata(array('err_msg' => "Invalid username/password!"));
			redirect(base_url()."user/login");
		}
	}

	public function logout()
	{
		if ($this->is_verified()) {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}

	public function profile()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('faculty_sport');
			$this->db->join('sport', 'faculty_sport.sport_name = sport.name');
			$this->db->join('sport_category', 'sport.category = sport_category.category');
			$this->db->where('faculty_name', $this->session->userdata("faculty_name"));
			$this->db->where('sport_category.start_date <=', date("Y-m-d H:i:s"));
			$this->db->where('sport_category.end_date >=', date("Y-m-d H:i:s"));
			$query = $this->db->get();
			$category =array();
			foreach ($query->result() as $row) {
				if (!in_array($row->category, $category)) {
					array_push($category, $row->category);
				}
			}
			$data = array(
				'selected_sports' => $query,
				'sport_categories' => $category
			);
			$this->load->template('users/profile', $data);
		} else {
			redirect(base_url()."user/login");
		}
	}
}
