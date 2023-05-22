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
		$data['zaire'] = $DB->read("SELECT * FROM trash_buckets where province = 'Zaire' AND status = 'full'");
		$data['namibe'] = $DB->read("SELECT * FROM trash_buckets where province = 'Namibe' AND status = 'full'");
		$data['moxico'] = $DB->read("SELECT * FROM trash_buckets where province = 'Moxico' AND status = 'full'");
		$data['cabinda'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cabinda' AND status = 'full'");
		$data['malanje'] = $DB->read("SELECT * FROM trash_buckets where province = 'Malanje' AND status = 'full'");
		$data['lunda_norte'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Norte' AND status = 'full'");
		$data['lunda_sul'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Sul' AND status = 'full'");
		$data['cunene'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cunene' AND status = 'full'");
		$data['huila'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huila' AND status = 'full'");
		$data['kwanza_norte'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Norte' AND status = 'full'");
		$data['kwanza_sul'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Sul' AND status = 'full'");
		$data['bie'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bie' AND status = 'full'");
		$data['bengo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bengo' AND status = 'full'");
		$data['cuando_cubango'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cuando-Cubango' AND status = 'full'");


		//municipios de luanda
		$data['belas'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Belas' AND status = 'full'");
		$data['cacuaco'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cacuaco' AND status = 'full'");
		$data['cazenga'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cazenga' AND status = 'full'");
		$data['icolo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Icolo e Bengo' AND status = 'full'");
		$data['quissama'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Quissama' AND status = 'full'");
		$data['viana'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Viana' AND status = 'full'");
		$data['luandam'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Luanda' AND status = 'full'");

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

	public function empresa()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		$trash = $this->load_model('Trash');
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//get provinces
		$provinces = $this->load_model('Provinces');
		$empresa = $this->load_model('Empresa');
		$data['provinces'] = $provinces->get_provinces();

		//add trash
		if(isset($_POST['add_empresa']))
		{
			$empresa->add_empresa($_POST);
		}

		//edit trash
		if(isset($_POST['edit_empresa']))
		{
			$empresa->edit_empresa($_POST);
		}

		//delete trash
		if(isset($_POST['delete_empresa']))
		{
			$empresa->delete_empresa($_POST);
		}

		//upload_photo
		if(isset($_POST['upload_photo']))
		{
			$empresa->upload_photo($_POST);
		}

		$DB = Database::newInstance();

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['users'] = $DB->read("select * from users order by id desc");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		$data['trashes'] = $DB->read("select * from trash_buckets order by id desc");
		$data['empresas'] = $DB->read("select * from empresas");
		$data['page_title'] = "Empresa";
		$this->view("admin/empresa", $data);
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

	public function relatorioestatistico()
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
		$data['page_title'] = "RelatorioEstatistico";
		$this->view("admin/relatorioestatistico", $data);
	}

	public function imprimirelatorioestatistico()
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
		$data['page_title'] = "RelatorioEstatistico";
		$this->view("admin/imprimirelatorioetatistico", $data);
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
		$data['zaire'] = $DB->read("SELECT * FROM trash_buckets where province = 'Zaire' AND status = 'full'");
		$data['namibe'] = $DB->read("SELECT * FROM trash_buckets where province = 'Namibe' AND status = 'full'");
		$data['moxico'] = $DB->read("SELECT * FROM trash_buckets where province = 'Moxico' AND status = 'full'");
		$data['cabinda'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cabinda' AND status = 'full'");
		$data['malanje'] = $DB->read("SELECT * FROM trash_buckets where province = 'Malanje' AND status = 'full'");
		$data['lunda_norte'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Norte' AND status = 'full'");
		$data['lunda_sul'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Sul' AND status = 'full'");
		$data['cunene'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cunene' AND status = 'full'");
		$data['huila'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huila' AND status = 'full'");
		$data['kwanza_norte'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Norte' AND status = 'full'");
		$data['kwanza_sul'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Sul' AND status = 'full'");
		$data['bie'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bie' AND status = 'full'");
		$data['bengo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bengo' AND status = 'full'");
		$data['cuando_cubango'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cuando-Cubango' AND status = 'full'");


		$data['luanda_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'empty'");
		$data['uige_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Uige' AND status = 'empty'");
		$data['huambo_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huambo' AND status = 'empty'");
		$data['benguela_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Benguela' AND status = 'empty'");
		$data['zaire_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Zaire' AND status = 'empty'");
		$data['namibe_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Namibe' AND status = 'empty'");
		$data['moxico_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Moxico' AND status = 'empty'");
		$data['cabinda_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cabinda' AND status = 'empty'");
		$data['malanje_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Malanje' AND status = 'empty'");
		$data['lunda_norte_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Norte' AND status = 'empty'");
		$data['lunda_sul_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Sul' AND status = 'empty'");
		$data['cunene_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cunene' AND status = 'empty'");
		$data['huila_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huila' AND status = 'empty'");
		$data['kwanza_norte_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Norte' AND status = 'empty'");
		$data['kwanza_sul_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Sul' AND status = 'empty'");
		$data['bie_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bie' AND status = 'empty'");
		$data['bengo_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bengo' AND status = 'empty'");
		$data['cuando_cubango_empty'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cuando-Cubango' AND status = 'empty'");


		//municipios de luanda cheios
		$data['belas'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Belas' AND status = 'full'");
		$data['cacuaco'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cacuaco' AND status = 'full'");
		$data['cazenga'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cazenga' AND status = 'full'");
		$data['icolo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Icolo e Bengo' AND status = 'full'");
		$data['quissama'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Quissama' AND status = 'full'");
		$data['viana'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Viana' AND status = 'full'");
		$data['luandam'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Luanda' AND status = 'full'");


		//municipios de luanda vazios
		$data['belas_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Belas' AND status = 'empty'");
		$data['cacuaco_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cacuaco' AND status = 'empty'");
		$data['cazenga_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cazenga' AND status = 'empty'");
		$data['icolo_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Icolo e Bengo' AND status = 'empty'");
		$data['quissama_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Quissama' AND status = 'empty'");
		$data['viana_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Viana' AND status = 'empty'");
		$data['luandam_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Luanda' AND status = 'empty'");
		$data['luanda_v'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'empty'");

		
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
			//SELECT garbage_address.address, trash_buckets.address_id FROM `garbage_address` INNER join trash_buckets on garbage_address.id = trash_buckets.address_id;
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


	public function empresa_row()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["Administrador","Supervisor"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM empresas WHERE id=:id",['id'=>$id]);

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


	public function update_table()
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

		
		$DB = Database::newInstance();

		$trashes = $DB->read("select * from trash_buckets order by id desc");
		$tableRows = '';
		if (is_array($trashes)) {
			foreach ($trashes as $trash) {
				$id = $trash->created_by;
				$search = $DB->read("select * from users where id = '$id'");
				$search_add = $DB->read("select * from garbage_address where id = '$trash->address_id'");

				// Generate table row HTML based on the fetched data
				$tableRows .= '<tr>';
				$tableRows .= '<td><img src="' . ASSETS . THEME;
				if ($trash->status == 'full') {
					$tableRows .= '/assets/logo/garbage-red.png';
				} elseif ($trash->status == 'empty') {
					$tableRows .= '/assets/logo/garbage.jpg';
				} else {
					$tableRows .= '/assets/logo/garbage-yellow.jpg';
				}
				$tableRows .= '" class="img-circle" height="30px" width="30px"></td>';
				$tableRows .= '<td>' . $trash->id . '</td>';
				$tableRows .= '<td>' . $trash->name . '</td>';
				$tableRows .= '<td>' . $trash->province . '</td>';
				$tableRows .= '<td>' . $trash->municipy . '</td>';
				$tableRows .= '<td>' . $search_add[0]->address . '</td>';
				$tableRows .= '<td><span class="';
				if ($trash->status == "empty") {
					$tableRows .= 'label bg-green">Vazio';
				} elseif ($trash->status == "middle") {
					$tableRows .= 'label bg-yellow">Meio';
				} else {
					$tableRows .= 'label bg-red">Cheio';
				}
				$tableRows .= '</span></td>';
				$tableRows .= '<td>' . $search[0]->name . '</td>';
				$tableRows .= '<td>' . date('M d, Y', strtotime($trash->created_at)) . '</td>';
				$tableRows .= '<td>';
				$tableRows .= '<button class="btn btn-success btn-sm edit btn-flat" data-id="' . $trash->id . '"><i class="fa fa-edit"></i> Edit</button>';
				$tableRows .= '<button class="btn btn-danger btn-sm delete btn-flat" data-id="' . $trash->id . '"><i class="fa fa-trash"></i> Delete</button>';
				$tableRows .= '</td>';
				$tableRows .= '</tr>';
			}
		}

		// Return the generated table rows
		echo $tableRows;
	}
}
