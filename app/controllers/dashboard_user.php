<?php 

Class Dashboard_user extends Controller
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

		
		$id = $data['user_data']->id;
		if(isset($_POST['send_message']))
		{
			$Message->insert_message($_POST, $_FILES, $id);
		}

		$DB = Database::newInstance();
		$data['user_message'] = $DB->read("select * from messages where user_id = '$id' order by id desc");
		$data['page_title'] = "Dashboard_user";
		$this->view("dashboard_user", $data);
	}
}