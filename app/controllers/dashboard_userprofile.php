<?php 

Class Dashboard_userprofile extends Controller
{
	public function index()
	{

		$User = $this->load_model('User');
		$user_data = $User->check_login();

		$Message = $this->load_model('Message');

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		if(isset($_POST['edit_profile']))
		{
            $id = $data['user_data']->id;
            $User->update_user_profile($_POST, $_FILES, $id);
            if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
				//show($_SESSION['error']);
				$data['errors'] = $_SESSION['error'];
			}
		}

        if(isset($_POST['send_message']))
		{
			$id = $data['user_data']->id;
			$Message->insert_message($_POST, $_FILES, $id);
		}

		$DB = Database::newInstance();
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['page_title'] = "Dashboard_userprofile";
		$this->view("dashboard_userprofile", $data);
	}
}