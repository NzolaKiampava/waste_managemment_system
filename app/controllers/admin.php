<?php

Class Admin extends Controller
{
	public function index()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users");
		$data['groups'] = $DB->read("SELECT * FROM colector_group");
		$data['limit_users'] = $DB->read("select * from users order by id desc limit 8");

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['count_address'] = $DB->read("SELECT * FROM garbage_address");	
		$data['count_car'] = $DB->read("select * from garbage_cars");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		
		$data['luanda'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'full'");
		$data['uige'] = $DB->read("SELECT * FROM trash_buckets where province = 'Uige' AND status = 'full'");
		$data['huambo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huambo' AND status = 'full'");
		$data['benguela'] = $DB->read("SELECT * FROM trash_buckets where province = 'Benguela' AND status = 'full'");

		$data['page_title'] = "Admin";
		$this->view("admin/index", $data);
	}

//profile for admins and other previlegies users
	public function profile()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users");

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		//verify user created
		$session_user = $_SESSION['user_url'];
		$create_check = $DB->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");
		$user_created = $create_check[0]->id;

		$data['user_created'] = $DB->read("select * from users where created_by = '$user_created'");
		$data['messages'] = $DB->read("select * from messages order by id desc");

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
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

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

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['groups'] = $DB->read("select * from colector_group order by id desc");
		$data['page_title'] = "Groups";
		$this->view("admin/groups", $data);
	}

	public function users()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");

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
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		$trash = $this->load_model('Trash');
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//get provinces
		$provinces = $this->load_model('Provinces');
		$data['provinces'] = $provinces->get_provinces();

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

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['trashes'] = $DB->read("select * from trash_buckets order by id desc");
		$data['page_title'] = "Trash";
		$this->view("admin/trash", $data);
	}

	public function address()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

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

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['address'] = $DB->read("select * from garbage_address order by id desc");
		$data['page_title'] = "Address";
		$this->view("admin/address", $data);
	}

	//colector cars
	public function trucks()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);
		
		$truck = $this->load_model('Truck');

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['add']))
		{
			$truck->add_truck($_POST);
		}

		if(isset($_POST['edit']))
		{
			$truck->edit_truck($_POST);
		}

		if(isset($_POST['delete']))
		{
			$truck->delete_truck($_POST);
		}
		
		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['trashes'] = $DB->read("select * from trash_buckets order by id desc");
		$data['trucks'] = $DB->read("select * from garbage_cars order by id desc");
		$data['page_title'] = "Truck";
		$this->view("admin/trucks", $data);
	}

	public function messages() 
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);
		
		$message = $this->load_model('Message');

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['delete_message']))
		{
			$message->delete_message($_POST);
		}
		
		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['page_title'] = "Messages";
		$this->view("admin/messages", $data);
	}

	public function geolocalizacao()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['last_msg_img'] = $DB->read("select image from messages order by id desc limit 4");
		$data['last_msg'] = $DB->read("select * from messages order by id desc limit 1");
		$data['page_title'] = "Geolocalizacao";
		$this->view("admin/geolocalizacao", $data);
	}

	public function relatoriogeral()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);
		
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		$data['contentores'] = $DB->read('SELECT * FROM trash_buckets');

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['groups'] = $DB->read("select * from colector_group order by id desc");
		$data['page_title'] = "RelatorioGeral";
		$this->view("admin/relatoriogeral", $data);
	}

	public function imprimirelatorio()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);
		
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		$data['contentores'] = $DB->read('SELECT * FROM trash_buckets');

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['groups'] = $DB->read("select * from colector_group order by id desc");
		$data['page_title'] = "RelatorioGeral";
		$this->view("admin/imprimirelatorio", $data);
	}


	public function grafico_geral()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users");
		$data['groups'] = $DB->read("SELECT * FROM colector_group");
		$data['limit_users'] = $DB->read("select * from users order by id desc limit 8");

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['count_address'] = $DB->read("SELECT * FROM garbage_address");	
		$data['count_car'] = $DB->read("select * from garbage_cars");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		
		$data['luanda'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'full'");
		$data['uige'] = $DB->read("SELECT * FROM trash_buckets where province = 'Uige' AND status = 'full'");
		$data['huambo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huambo' AND status = 'full'");
		$data['benguela'] = $DB->read("SELECT * FROM trash_buckets where province = 'Benguela' AND status = 'full'");

		$data['luanda_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'empty'");
		$data['uige_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Uige' AND status = 'empty'");
		$data['huambo_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huambo' AND status = 'empty'");
		$data['benguela_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Benguela' AND status = 'empty'");


		$data['page_title'] = "GraficoGeral";
		$this->view("admin/grafico_geral", $data);
	}

	public function grafico_contentores()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users");
		$data['groups'] = $DB->read("SELECT * FROM colector_group");
		$data['limit_users'] = $DB->read("select * from users order by id desc limit 8");

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['count_address'] = $DB->read("SELECT * FROM garbage_address");	
		$data['count_car'] = $DB->read("select * from garbage_cars");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		
		$data['luanda'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'full'");
		$data['uige'] = $DB->read("SELECT * FROM trash_buckets where province = 'Uige' AND status = 'full'");
		$data['huambo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huambo' AND status = 'full'");
		$data['benguela'] = $DB->read("SELECT * FROM trash_buckets where province = 'Benguela' AND status = 'full'");

		$data['luanda_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'empty'");
		$data['uige_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Uige' AND status = 'empty'");
		$data['huambo_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huambo' AND status = 'empty'");
		$data['benguela_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Benguela' AND status = 'empty'");

		
		$data['page_title'] = "GraficoContentores";
		$this->view("admin/grafico_contentores", $data);
	}

	public function qrcode()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);
		
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		$data['contentores'] = $DB->read('SELECT * FROM trash_buckets');

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");
		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['groups'] = $DB->read("select * from colector_group order by id desc");
		$data['page_title'] = "RelatorioGeral";
		$this->view("admin/qrcode", $data);
	}

	public function truck_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM garbage_cars WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}
	
	// some row no controllers
	public function address_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

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
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

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
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

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
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

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
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

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

	public function message_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM messages WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}
}
