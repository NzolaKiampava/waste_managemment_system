<?php
/*
Class Contact_us extends Controller
{
		
	public function index()
	{
		
		$User = $this->load_model('User');
		$Message = $this->load_model('Message');
		$user_data = $User->check_login();
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();
		$data['errors'] = array();
		if(count($_POST))
		{
			$data['POST'] = $_POST;
			$data['errors'] = $Message->create($data['POST']);

			if(!is_array($data['errors']))
			{
				redirect("contact-us?success=true");
			}
		}

		$data['page_title'] = "Contact-Us";
	
		$this->view("contact-us", $data);
	}


}