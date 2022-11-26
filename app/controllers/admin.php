<?php

Class Admin extends Controller
{
	public function index()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users");
		$data['limit_users'] = $DB->read("select * from users limit 8");
		
		$data['page_title'] = "Admin";
		$this->view("admin/index", $data);
	}

//profile for admins and other previlegies users
	public function profile()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users");

		//verify user created
		$session_user = $_SESSION['user_url'];
		$create_check = $DB->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");
		$user_created = $create_check[0]->id;

		$data['user_created'] = $DB->read("select * from users where created_by = '$user_created'");

		$id = $data['user_data']->id;

		if(isset($_POST['admin_profile_button']))
		{
			//show($_POST);
			$User->update_admin_profile($_POST, $id);

			if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
				//show($_SESSION['error']);
				$data['errors'] = $_SESSION['error'];
				$data['POST'] = $_POST;
			}
		}

		$data['page_title'] = "Profile";
		$this->view("admin/profile", $data);
	}

	public function users()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users order by id desc");

		if(isset($_POST['add']))
		{
			//show($_POST);
			$User->add_user($_POST);
		}

		$data['page_title'] = "Usuarios";
		$this->view("admin/users", $data);
	}
}