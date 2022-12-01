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
		$data['groups'] = $DB->read("SELECT * FROM colector_group");
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

	public function groups()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		$Group = $this->load_model('Group');
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//add group
		if(isset($_POST['add_group']))
		{
			$Group->add_group($_POST);
		}

		//edit group
		if(isset($_POST['edit_group']))
		{
			$Group->edit_group($_POST);
		}

		//delete group
		if(isset($_POST['delete_group']))
		{
			$Group->delete_group($_POST);
		}

		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['groups'] = $DB->read("select * from colector_group order by id desc");
		$data['page_title'] = "Groups";
		$this->view("admin/groups", $data);
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

		// add user
		if(isset($_POST['add']))
		{
			//show($_POST);
			$User->add_user($_POST);
		}

		//edit user
		if(isset($_POST['edit']))
		{
			//show($_POST);
			$User->edit_user($_POST);
		}

		//delete user
		if(isset($_POST['delete']))
		{
			$User->delete_user($_POST);
		}

		//upload_photo
		if(isset($_POST['upload_photo']))
		{
			$User->upload_photo($_POST);
		}

		$data['page_title'] = "Usuarios";
		$this->view("admin/users", $data);
	}

	public function trash()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		$trash = $this->load_model('Trash');
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//add trash
		if(isset($_POST['add_trash']))
		{
			$trash->add_trash($_POST);
		}

		//edit trash
		if(isset($_POST['edit_trash']))
		{
			$trash->edit_trash($_POST);
		}

		//delete trash
		if(isset($_POST['delete_trash']))
		{
			$trash->delete_trash($_POST);
		}

		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['trashes'] = $DB->read("select * from trash_buckets order by id desc");
		$data['page_title'] = "Trash";
		$this->view("admin/trash", $data);
	}

	public function address()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		$address = $this->load_model('Address');
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//add address
		if(isset($_POST['add_address']))
		{
			$address->add_address($_POST);
		}

		//edit address
		if(isset($_POST['edit_address']))
		{
			$address->edit_address($_POST);
		}

		//delete address
		if(isset($_POST['delete_address']))
		{
			$address->delete_address($_POST);
		}

		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['address'] = $DB->read("select * from garbage_address order by id desc");
		$data['page_title'] = "Address";
		$this->view("admin/address", $data);
	}

	public function address_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM garbage_address WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}

	/*public function address_fetch()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();
		$fetch = $DB->read("SELECT * FROM garbage_address");

		if(is_array($fetch))
		{
			foreach($fetch as $row)
			{
				$output .= "
					<option value='".$row->id."' class='append_items'>".$row->address."</option>
				";
			}
		}

		echo json_encode($output);
	}*/

	public function users_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM users WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}

	public function trash_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT *, (SELECT address from garbage_address where id='$id') as add_name FROM trash_buckets WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}

	public function groups_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM colector_group WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}
}
