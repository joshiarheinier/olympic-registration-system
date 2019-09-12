<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private function is_verified() {
		$this->load->library('session');
		$session_hash = sha1($this->session->userdata('adm').$this->session->userdata('datum'));
		if ($session_hash == $this->session->userdata('session_hash')) {
			return TRUE;
		}
		return FALSE;
	}

	public function admin_login()
	{
		if ($this->is_verified()) {
			redirect(base_url()."admin/official/dashboard");
		} else {
			$this->load->template('admin/login');
		}
	}

	public function admin_login_process() 
	{
		$this->load->database();
		$enc_pwd = sha1($this->input->post('password'));
		$query = $this->db->get_where('olimpiad', array(
			'username' => $this->input->post('username'),
			'password' => $enc_pwd
		));
		$this->load->library('session');
		if ($query->num_rows() != 0) {
			$data = $query->row();
			$date_now = date('Y-m-d H:i:s');
			$session_data = array(
				'adm' => $data->username, 
				'session_hash' => sha1($data->username.$date_now), 
				'datum' => $date_now
			);
			$this->session->set_userdata($session_data);
			redirect(base_url()."admin/official/dashboard");
		} else {
			$this->session->set_userdata(array('err_msg' => "Invalid username/password!"));
			redirect(base_url()."admin/official/login");
		}
	}

	public function admin_logout()
	{
		if ($this->is_verified()) {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}

	public function admin_dashboard()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('name');
			$query = $this->db->get('faculty');
			$this->db->select('name');
			$query2 = $this->db->get('sport');
			$this->db->select('category');
			$query3 = $this->db->get('sport_category');
			$data = array(
				'faculties' => $query,
				'sports' => $query2,
				'categories' => $query3
			);
			$this->load->template('admin/dashboard', $data);
		} else {
			show_404();
		}
	}

	public function view_entry_number()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('faculty_sport');
			$this->db->join('sport', 'faculty_sport.sport_name = sport.name');
			$this->db->order_by('category', 'ASC');
			$this->db->order_by('name', 'ASC');
			$this->db->where('faculty_name', $this->input->post("faculty"));
			$query = $this->db->get();
			$data = array(
				'sports' => $query
			);
			$this->load->template('admin/entry_number', $data);
		} else {
			redirect(base_url()."admin/official/login");
		}
	}

	public function download_entry_number()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('faculty_sport');
			$this->db->join('sport', 'faculty_sport.sport_name = sport.name');
			$this->db->order_by('category', 'ASC');
			$this->db->order_by('name', 'ASC');
			$this->db->where('faculty_name', $this->input->post("faculty"));
			$query = $this->db->get();
			$data = array(
				'sports' => $query
			);
			$this->load->library('pdf');
			$html = $this->load->view('pdfs/number_pdf', $data, TRUE);
			$this->pdf->load_html($html);
			$this->pdf->render();
			$this->pdf->stream("Entry Number - ".$this->input->post("faculty").".pdf");
		}
	}

	public function view_entry_name()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('participant_sport');
			$this->db->join('participant', 'participant_sport.participant_npm = participant.npm');
			$this->db->order_by('participant_npm', 'ASC');
			$this->db->where('participant_faculty_name', $this->input->post("faculty"));
			$this->db->where('sport_name', $this->input->post("sport_name"));
			$query = $this->db->get();
			$data = array(
				'participant' => $query,
				'sport_name' => $this->input->post("sport_name")
			);
			$this->load->template('admin/entry_name', $data);
		} else {
			redirect(base_url()."admin/official/login");
		}
	}

	public function download_entry_name()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('participant_sport');
			$this->db->join('participant', 'participant_sport.participant_npm = participant.npm');
			$this->db->order_by('participant_npm', 'ASC');
			$this->db->where('participant_faculty_name', $this->input->post("faculty"));
			$this->db->where('sport_name', $this->input->post("sport_name"));
			$query = $this->db->get();
			$data = array(
				'participant' => $query,
				'sport_name' => $this->input->post("sport_name")
			);
			$this->load->library('pdf');
			$this->pdf->set_option('isRemoteEnabled', TRUE);
			$html = $this->load->view('pdfs/name_pdf', $data, TRUE);
			$this->pdf->load_html($html);
			$this->pdf->render();
			$this->pdf->stream("Entry Name - ".$this->input->post("faculty")." - ".$this->input->post("sport_name").".pdf");
		}
	}

	public function view_entry_official()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('official_sport');
			$this->db->join('participant', 'official_sport.official_npm = participant.npm');
			$this->db->order_by('official_npm', 'ASC');
			$this->db->where('official_faculty_name', $this->input->post("faculty"));
			$this->db->where('category', $this->input->post("category"));
			$query = $this->db->get();
			$data = array(
				'participant' => $query,
				'category' => $this->input->post("category")
			);
			$this->load->template('admin/entry_official', $data);
		} else {
			redirect(base_url()."admin/official/login");
		}
	}

	public function download_entry_official()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('official_sport');
			$this->db->join('participant', 'official_sport.official_npm = participant.npm');
			$this->db->order_by('official_npm', 'ASC');
			$this->db->where('official_faculty_name', $this->input->post("faculty"));
			$this->db->where('category', $this->input->post("category"));
			$query = $this->db->get();
			$data = array(
				'participant' => $query,
				'category' => $this->input->post("category")
			);
			$this->load->library('pdf');
			$this->pdf->set_option('isRemoteEnabled', TRUE);
			$html = $this->load->view('pdfs/official_pdf', $data, TRUE);
			$this->pdf->load_html($html);
			$this->pdf->render();
			$this->pdf->stream("Entry Official - ".$this->input->post("faculty")." - ".$this->input->post("category").".pdf");
		}
	}
}