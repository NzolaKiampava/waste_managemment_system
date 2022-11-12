<?php

Class Admin extends Controller
{

	public function index()
	{
		/*$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}*/


		$data['page_title'] = "Admin";
		$data['current_page'] = "dashboard";
		$this->view("admin/index", $data);
	}

	/*
	public function users($type = "customers")
	{
		$User = $this->load_model('User');
		$Order = $this->load_model('Order');

		$user_data = $User->check_login(true, ["admin"]);

		//count_down
			$DB = Database::newInstance();
			$data['count_products'] = $DB->read("select * from products");
			$data['count_category'] = $DB->read("select * from categories");
			$data['count_brand'] = $DB->read("select * from brands");
			$data['count_order'] = $DB->read("select * from orders");
			$data['count_message'] = $DB->read("select * from contact_us order by id desc limit 10");


		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		
		if($type == "admins")
		{
			$users = $User->get_admins();

			if(count($_POST) > 0 && !isset($_POST['mult_delete']))
			{
				$User->add_user($_POST);
				
			}
			
			if(isset($_GET['delete']))
			{
				$id = addslashes($_GET['delete']);
				$User->delete($id);
				header("Location: ".ROOT."admin/users/admins");
			}
			

		}else{
			$users = $User->get_customers();
			
			if(count($_POST) > 0 && !isset($_POST['mult_delete']))
			{
				$User->add_user($_POST);
				
			}
			
			if(isset($_GET['delete']))
			{
				$id = addslashes($_GET['delete']);
				$User->delete($id);
				header("Location: ".ROOT."admin/users/customers");
			}
			
		}

		if(is_array($users)){
			foreach ($users as $key => $row) {
				// code...
				$orders_num = $Order->get_orders_count($row->url_address);
				$users[$key]->orders_count = $orders_num;
			}
		}

		$data['users'] = $users;
		$data['type'] = $type;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "users";
		$this->view("admin/users", $data);

	}

	public function admin_profile()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);
		$data['errors'] = "";
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$id = $data['user_data']->id;

		//count_down
			$DB = Database::newInstance();
			$data['count_products'] = $DB->read("select * from products");
			$data['count_category'] = $DB->read("select * from categories");
			$data['count_brand'] = $DB->read("select * from brands");
			$data['count_order'] = $DB->read("select * from orders");
			$data['count_message'] = $DB->read("select * from contact_us order by id desc limit 10");


		if(count($_POST) > 0)
		{
			//show($_POST);
			$data['errors'] = $User->update_admin_profile($_POST, $id);

			if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
				//show($_SESSION['error']);
				$data['errors'] = $_SESSION['error'];
				$data['POST'] = $_POST;
			}
			
		}
		$data['page_title'] = "Admin - Profile";
		$this->view("admin/admin_profile", $data);
	}


	public function messages($type = '')
	{
		$type = "Messages";
		$mode = "read";

		$User = $this->load_model('User');
		$Message = $this->load_model('Message');

		$user_data = $User->check_login(true, ["admin"]);

		//count_down
			$DB = Database::newInstance();
			$data['count_products'] = $DB->read("select * from products");
			$data['count_category'] = $DB->read("select * from categories");
			$data['count_brand'] = $DB->read("select * from brands");
			$data['count_order'] = $DB->read("select * from orders");
			$data['count_message'] = $DB->read("select * from contact_us order by id desc limit 10");


		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		
		if(isset($_GET['delete']))
		{
			$mode = "delete";
		} 

		if(isset($_GET['delete_confirmed']))
		{
			$mode = "delete_confirmed";
			$id = $_GET['delete_confirmed'];
			$Message->delete($id);
		}
		

		if ($mode == "delete") {
			$id = $_GET['delete'];
			$messages = $Message->get_one($id);
		}else{
			$messages = $Message->get_all();
		}
		
		$data['mode'] = $mode;
		$data['messages'] = $messages;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "messages";
		$this->view("admin/messages", $data);

	}*/

	
}