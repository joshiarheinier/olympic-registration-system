<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends CI_Controller {

	private function is_verified() {
		$this->load->library('session');
		$session_hash = sha1($this->session->userdata('username').$this->session->userdata('faculty_name'));
		if ($session_hash == $this->session->userdata('session_hash')) {
			return TRUE;
		}
		return FALSE;
	}

	private function is_available($name, $type) {
		$this->db->select('*')
		;$this->db->from('faculty_sport');
		$this->db->join('sport', 'faculty_sport.sport_name = sport.name');
		$this->db->join('sport_category', 'sport.category = sport_category.category');
		$this->db->where('faculty_name', $this->session->userdata("faculty_name"));
		// $this->db->where('start_date <=', date("Y-m-d H:i:s"));
		// $this->db->where('end_date >=', date("Y-m-d H:i:s"));
		$this->db->where($type, urldecode($name));
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			show_404();
			exit();
		}
	}

	private function upload_with_config($path, $types, $max_size, $file, $name) 
	{
		$config['upload_path'] = $path;
		$config['allowed_types']=$types;
		$config['max_size']=$max_size;
		$config['file_name'] = $file;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload($name)) {
			return array('upload_data' => $this->upload->data());
		} else {
			return FALSE;
		}
	}

	public function entry_number()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->order_by('category', 'ASC');
			$this->db->order_by('name', 'ASC');
			$query = $this->db->get('sport');
			$query2 = $this->db->get_where('faculty_sport', array(
				'faculty_name' => $this->session->userdata("faculty_name")
			));
			$participate_list = array();
			foreach ($query2->result() as $row) {
				array_push($participate_list, $row->sport_name);
			}
			$data = array(
				'sports' => $query, 
				'participate_list' => $participate_list
			);
			$this->load->template('entry/number', $data);
		} else {
			redirect(base_url()."user/login");
		}
	}

	public function number_process()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$query = $this->db->get('sport');
			$this->db->delete('faculty_sport', array(
				'faculty_name' => $this->session->userdata("faculty_name")
			));
			$limit = 0;
			foreach ($query->result() as $row) {
				$tmp_name = strtolower($row->name);
				$tmp_name = str_replace(" ", "-", $tmp_name);
				if ($this->input->post($tmp_name)) {
					$limit += 1;
					if ($limit == 59) {
						$err = array('err_msg' => "Maximum number of entries are 58!");
						$this->session->set_userdata($err);
						redirect(base_url()."contingent/entry/number");
					} else {
						$tmp_result = array(
							'faculty_name' => $this->session->userdata("faculty_name"), 
							'sport_name' => $row->name
						);
						$this->db->insert('faculty_sport', $tmp_result);
					}
				}
			}
			redirect(base_url()."user/profile");
		}
	}

	public function entry_name($sport_name)
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->is_available($sport_name, 'sport_name');
			$query = $this->db->get_where('faculty_sport', array(
				'faculty_name' => $this->session->userdata("faculty_name"), 
				'sport_name' => urldecode($sport_name)
			));
			if ($query->num_rows() != 0) {
				$query2 = $this->db->get_where('participant_sport', array(
					'participant_faculty_name' => $this->session->userdata("faculty_name"), 
					'sport_name' => urldecode($sport_name)
				));
				$participant = array();
				foreach ($query2->result() as $row) {
					$query3 = $this->db->get_where('participant', array(
						'npm' => $row->participant_npm
					));
					foreach ($query3->result() as $row2) {
						array_push($participant, $row2);
					}
				}
				$query4 = $this->db->get_where('sport', array('name' => urldecode($sport_name)));
				$query4 = $query4->row();
				$data = array(
					'sport_name' => $query4->name,
					'max_player' => $query4->max_player,
					'participant' => $participant
				);
				$this->load->template('entry/name', $data);
			}
		} else {
			redirect(base_url()."user/login");
		}
	}

	public function entry_official($category)
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->is_available($category, 'sport.category');
			$query = $this->db->get_where('official_sport', array(
				'official_faculty_name' => $this->session->userdata("faculty_name"), 
				'category' => urldecode($category)
			));
			$participant = array();
			foreach ($query->result() as $row) {
				$query2 = $this->db->get_where('participant', array(
					'npm' => $row->official_npm
				));
				foreach ($query2->result() as $row2) {
					array_push($participant, $row2);
				}
			}
			$query3 = $this->db->get_where('sport_category', array('category' => urldecode($category)));
			$query3 = $query3->row();
			$data = array(
				'category' => $query3->category,
				'max_official' => $query3->max_official, 
				'participant' => $participant
			);
			$this->load->template('entry/official', $data);
		} else {
			redirect(base_url()."user/login");
		}
	}

	public function save_participant_data()
	{
		# Upload student photo
		$img_data = $this->upload_with_config("./public/uploads/photos", 'jpeg|jpg|png', 200, sha1($this->input->post('participant_id')), "participant_photo");
		# Upload student id card
		$card_data = $this->upload_with_config("./public/uploads/cards", 'jpeg|jpg|png', 300, sha1($this->input->post('participant_id')), "participant_card");
		# Upload screenshot
		$screenshot_data = $this->upload_with_config("./public/uploads/screenshots", 'jpeg|jpg|png', 500, sha1($this->input->post('participant_id')), "participant_screenshot");
		if($img_data && $card_data && $screenshot_data){
			$participant_data = array(
				'faculty_name' => $this->session->userdata("faculty_name"),
				'npm' => $this->input->post('participant_id'), 
				'full_name' => $this->input->post('participant_name'), 
				'major' => $this->input->post('participant_major'),
				'image_link' => base_url()."public/uploads/photos/".$img_data['upload_data']['file_name'], 
				'id_card_link' => base_url()."public/uploads/cards/".$card_data['upload_data']['file_name'], 
				'screenshot_link' => base_url()."public/uploads/screenshots/".$screenshot_data['upload_data']['file_name']
			);
			$this->db->insert('participant', $participant_data);
		} else {
			die(json_encode(array('status' => 'error', 'message' => $this->upload->display_errors())));
		}
	}

	public function name_process()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->is_available($this->input->post('sport_name'), 'sport_name');
			if ($this->player_is_off_limit()) {
				echo json_encode(array(
					"status" => "error",
					"message"=> "<p>Number of player has reached its maximum amount!</p>"
					 ));
			} else {
				$query = $this->db->get_where('participant', array(
					'npm' => $this->input->post("participant_id")
				));
				if ($query->num_rows() == 0) { //save the player data if there is no record on participant
					$this->save_participant_data();
				}
				$participant_sport_data = array(
					'participant_faculty_name' => $this->session->userdata("faculty_name"), 
					'participant_npm' => $this->input->post('participant_id'),
					'sport_name' => $this->input->post('sport_name')
				);
				$this->db->insert('participant_sport', $participant_sport_data);
				$query = $this->db->get_where('participant', array(
					'npm' => $this->input->post("participant_id")
				));
				$res = $query->row();
				$return_data = array(
					'status' => 'success',
					'id' => $res->npm,
					'name' => $res->full_name,
					'major' => $res->major,
					'role' => 'Pemain',
					'image_link' => $res->image_link, 
				);
				echo json_encode($return_data);
			}
		}
	}

	public function official_process()
	{
		if ($this->is_verified()) {
			$this->load->database();
			$this->is_available($this->input->post('category'), 'sport.category');
			if ($this->official_is_off_limit()) {
				echo json_encode(array(
					"status" => "error",
					"message"=> "<p>Number of official has reached its maximum amount!</p>"
					 ));
			} else {
				$query = $this->db->get_where('participant', array(
					'npm' => $this->input->post("participant_id")
				));
				if ($query->num_rows() == 0) { //save the player data if there is no record on participant
					$this->save_participant_data();
				}
				$official_sport_data = array(
					'official_faculty_name' => $this->session->userdata("faculty_name"), 
					'official_npm' => $this->input->post('participant_id'),
					'category' => $this->input->post('category')
				);
				$this->db->insert('official_sport', $official_sport_data);
				$query = $this->db->get_where('participant', array(
					'npm' => $this->input->post("participant_id")
				));
				$res = $query->row();
				$return_data = array(
					'status' => 'success',
					'id' => $res->npm,
					'name' => $res->full_name,
					'major' => $res->major,
					'role' => 'Pemain',
					'image_link' => $res->image_link, 
				);
				echo json_encode($return_data);
			}
		}
	}

	private function player_is_off_limit()
	{
		$query = $this->db->get_where('sport', array(
			'name' => $this->input->post('sport_name')
		));
		$query = $query->row();
		$query2 = $this->db->get_where('participant_sport', array(
			'participant_faculty_name' =>  $this->session->userdata("faculty_name"),
			'sport_name' => $this->input->post('sport_name')
		));
		if ($query2->num_rows() < $query->max_player) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	private function official_is_off_limit()
	{
		$query = $this->db->get_where('sport_category', array(
			'category' => $this->input->post('category')
		));
		$query = $query->row();
		$query2 = $this->db->get_where('official_sport', array(
			'official_faculty_name' =>  $this->session->userdata("faculty_name"),
			'category' => $this->input->post('category')
		));
		if ($query2->num_rows() < $query->max_official) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function name_delete_process() {
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->delete('participant_sport', array(
				'participant_faculty_name' => $this->session->userdata("faculty_name"), 
				'participant_npm' => $this->input->post('participant_id'),
				'sport_name' => $this->input->post('sport_name')
			));
			$o_query = $this->db->get_where('official_sport', array(
				'official_faculty_name' => $this->session->userdata("faculty_name"), 
				'official_npm' => $this->input->post('participant_id')
			));
			$p_query = $this->db->get_where('participant_sport', array(
				'participant_faculty_name' => $this->session->userdata("faculty_name"), 
				'participant_npm' => $this->input->post('participant_id')
			));
			if ($o_query->num_rows() == 0 && $o_query->num_rows() == 0) {
				$query2 = $this->db->get_where('participant', array(
					'npm' => $this->input->post('participant_id')
				));
				$ret = $query2->row();
				$base_path = 'C:/xampp/htdocs/olimpiade-ui-2018/';
				$imglink = str_replace(base_url(), $base_path, $ret->image_link);
				$cardlink = str_replace(base_url(), $base_path, $ret->id_card_link);
				$sslink = str_replace(base_url(), $base_path, $ret->screenshot_link);
				unlink($imglink);
				unlink($cardlink);
				unlink($sslink);
				$this->db->delete('participant', array(
					'npm' => $this->input->post('participant_id')
				));
			}
			redirect(base_url()."contingent/entry/name/".$this->input->post('sport_name'));
		}
	}

	public function official_delete_process() {
		if ($this->is_verified()) {
			$this->load->database();
			$this->db->delete('official_sport', array(
				'official_faculty_name' => $this->session->userdata("faculty_name"), 
				'official_npm' => $this->input->post('participant_id'),
				'category' => $this->input->post('category')
			));
			$o_query = $this->db->get_where('official_sport', array(
				'official_faculty_name' => $this->session->userdata("faculty_name"), 
				'official_npm' => $this->input->post('participant_id')
			));
			$p_query = $this->db->get_where('participant_sport', array(
				'participant_faculty_name' => $this->session->userdata("faculty_name"), 
				'participant_npm' => $this->input->post('participant_id')
			));
			if ($p_query->num_rows() == 0 && $o_query->num_rows() == 0) {
				$query2 = $this->db->get_where('participant', array(
					'npm' => $this->input->post('participant_id')
				));
				$ret = $query2->row();
				$base_path = 'C:/xampp/htdocs/olimpiade-ui-2018/';
				$imglink = str_replace(base_url(), $base_path, $ret->image_link);
				$cardlink = str_replace(base_url(), $base_path, $ret->id_card_link);
				$sslink = str_replace(base_url(), $base_path, $ret->screenshot_link);
				unlink($imglink);
				unlink($cardlink);
				unlink($sslink);
				$this->db->delete('participant', array(
					'npm' => $this->input->post('participant_id')
				));
			}
			redirect(base_url()."contingent/entry/official/".$this->input->post('category'));
		}
	}
}
