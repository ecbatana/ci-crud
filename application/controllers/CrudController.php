<?php
	defined('BASEPATH') or die('No direct access script allowed!');

	class CrudController extends CI_Controller
	{

		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url', 'form'));
			$this->load->library(array('form_validation', 'session'));
			$this->load->model('crud_model');
		}

		public function index() {
			$query = $this->crud_model->getAll();
			$data = array("data" => $query);
			$this->load->view('index', $data);
		}

		public function add() {
			$this->form_validation->set_rules('name', 'Name fields', 'required|alpha_numeric_spaces|max_length[255]');
			$this->form_validation->set_rules('status', 'Status fields', 'required|alpha_numeric_spaces|max_length[255]');

			if($this->form_validation->run() == FALSE) {
				$this->load->view('add');
			} else {
				$data = array(
					"id" => htmlspecialchars(strip_tags($this->security->xss_clean($this->input->post('id')))),
					"name" => htmlspecialchars(strip_tags($this->security->xss_clean($this->input->post('name')))),
					"status" => htmlspecialchars(strip_tags($this->security->xss_clean($this->input->post('status')))),
				);
				$this->crud_model->setData($data);
				$this->session->set_flashdata('success', "ID : {$data['id']} has been added!");
				redirect('/');
			}
		}

		public function delete($id = NULL) {
			if(empty($id) && $id === NULL) {
				$this->session->set_flashdata('error', 'Define the id\'s before try to delete something');
				redirect('/');
			} else {
				$result = $this->crud_model->getDataById($id);
				if(empty($result) && !isset($result)) {
					$this->session->set_flashdata('error', "ID : {$id} not found");
					redirect('/');
				} else {
					$this->crud_model->unsetDataById($result->id);
					$this->session->set_flashdata('success', "ID : {$id} has been deleted!");
					redirect('/');
				}
			}
		}

		public function edit($id = NULL) {
			if(empty($id) && $id === NULL) {
				$this->session->set_flashdata('error', 'Define the id\'s before try to update something');
				redirect('/');
			} else {
				$result = $this->crud_model->getDataById($id);
				if(empty($result) && !isset($result)) {
					$this->session->set_flashdata('error', 'ID: {$id} not found');
					redirect('/');
				} else {
					$data = array('data' => $result);
					$this->session->set_userdata('referred_from', current_url());
					$this->load->view('edit', $data);
				}
			}
		}

		public function update() {
			$this->form_validation->set_rules('name', 'Name fields', 'required|alpha_numeric_spaces|max_length[255]');
			$this->form_validation->set_rules('status', 'Status fields', 'required|alpha_numeric_spaces|max_length[255]');

			if($this->form_validation->run() == TRUE) {
				$data = array(
					"id" => htmlspecialchars(strip_tags($this->security->xss_clean($this->input->post('id')))),
					"name" => htmlspecialchars(strip_tags($this->security->xss_clean($this->input->post('name')))),
					"status" => htmlspecialchars(strip_tags($this->security->xss_clean($this->input->post('status')))),
				);
				$this->crud_model->updateData($data);
				$this->session->set_flashdata('success', "ID : {$data['id']} has been updated!");
				redirect('/');
			} else {
				$this->session->set_flashdata('error', validation_errors());
				$referred_from = $this->session->userdata('referred_from');
				redirect($referred_from, 'refresh');
			}
		}
	}