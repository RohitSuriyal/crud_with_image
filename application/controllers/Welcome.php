<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function table()
	{
		$this->load->database();
		$this->load->model("table_model");
		$fetch_data = $this->table_model->make_datatables();

		$data = array();
		$draw = isset($_POST["draw"]) ? intval($_POST["draw"]) : 0;
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$sub_array[] = $row->title;
			$sub_array[] = '<img height="50px" width="100px" style="max-height: 50px; max-width: 50px;" src="data:image/jpg|png|jpeg;base64,' . $row->image . '" />';

			$sub_array[] = $row->language;
			$sub_array[] = $row->status;
			$sub_array[] = '<button type="button" name="view" id=" ' . $row->id . ' " class="btn btn-success btn-xs view">View</button>';
			$sub_array[] = '<button type="button" name="view" id=" ' . $row->id . ' " class="btn btn-warning btn-xs update">Update</button>';
			$sub_array[] = '<button type="button" name="view" id=" ' . $row->id . ' " class="btn btn-danger btn-xs delete">Delete</button>';
			$data[] = $sub_array;

		}
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $this->table_model->get_all_data(),
			"recordsFiltered" => $this->table_model->get_filtered_data(),
			"data" => $data,


		);



		echo json_encode($output);
	}
	
}
