<?php 

Class Home extends Controller
{
	public function index()
	{

		$User = $this->load_model('User');
		$user_data = $User->check_login();

		$Message = $this->load_model('Message');
		//get provinces
		$provinces = $this->load_model('Provinces');
		$data['provinces'] = $provinces->get_provinces();

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$Message->insert_message($_POST, $_FILES);
		}

		$DB = Database::newInstance();
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['page_title'] = "Home";
		$this->view("index", $data);
	}
}
