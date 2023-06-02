<?php

Class Empresas extends Controller
{
	public function index()
	{
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa'");
		$data['groups'] = $DB->read("SELECT * FROM colector_group where id_empresa = '$id_empresa'");
		$data['limit_users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc limit 8 ");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets  where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");

		$data['count_address'] = $DB->read("SELECT * FROM garbage_address");	
		$data['count_car'] = $DB->read("select * from garbage_cars where id_empresa = '$id_empresa'");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");



		//municipios de luanda
		$data['belas'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' and municipy = 'Belas' AND status = 'full'");
		$data['cacuaco'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' and municipy = 'Cacuaco' AND status = 'full'");
		$data['cazenga'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' and municipy = 'Cazenga' AND status = 'full'");
		$data['icolo'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' and municipy = 'Icolo e Bengo' AND status = 'full'");
		$data['quissama'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' and municipy = 'Quissama' AND status = 'full'");
		$data['viana'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' and municipy = 'Viana' AND status = 'full'");
		$data['luandam'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' and municipy = 'Luanda' AND status = 'full'");
		$data['luanda'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa' AND province = 'Luanda' AND status = 'full'");

		$data['page_title'] = "Empresa";
		$this->view("empresas/index", $data);
	}

	public function users(){
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");

		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");

		// add user
		if(isset($_POST['add']))
		{
			//show($_POST);
			$User->add_user($_POST, $id_empresa);
		}

		//edit user
		if(isset($_POST['edit']))
		{
			//show($_POST);
			$User->edit_user($_POST, $id_empresa);
		}

		//delete user
		if(isset($_POST['delete']))
		{
			$User->delete_user($_POST, $id_empresa);
		}

		$data['page_title'] = "Usuarios";
		$this->view("empresas/users", $data);

	}

	public function groups()
	{
		$Group = $this->load_model('Group');
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();
		//add group
		if(isset($_POST['add_group']))
		{
			$Group->add_group($_POST, $id_empresa);
		}

		//edit group
		if(isset($_POST['edit_group']))
		{
			$Group->edit_group($_POST, $id_empresa);
		}

		//delete group
		if(isset($_POST['delete_group']))
		{
			$Group->delete_group($_POST, $id_empresa);
		}

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");

		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['groups'] = $DB->read("select * from colector_group where id_empresa = '$id_empresa' order by id desc");
		$data['page_title'] = "Groups";
		$this->view("empresas/groups", $data);
	}

	public function trash()
	{
		$trash = $this->load_model('Trash');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();
		//get provinces
		$provinces = $this->load_model('Provinces');
		$data['provinces'] = $provinces->get_provinces();

		//add trash
		if(isset($_POST['add_trash']))
		{
			$trash->add_trash($_POST, $id_empresa);
		}

		//edit trash
		if(isset($_POST['edit_trash']))
		{
			$trash->edit_trash($_POST, $id_empresa);
		}

		//delete trash
		if(isset($_POST['delete_trash']))
		{
			$trash->delete_trash($_POST, $id_empresa);
		}

		$DB = Database::newInstance();

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");

		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['trashes'] = $DB->read("select * from trash_buckets where id_empresa = '$id_empresa' order by id desc");
		$data['page_title'] = "Trash";
		$this->view("empresas/trash", $data);
	}

	//colector cars
	public function trucks()
	{	
		$truck = $this->load_model('Truck');

		$Group = $this->load_model('Group');
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['add']))
		{
			$truck->add_truck($_POST, $id_empresa);
		}

		if(isset($_POST['edit']))
		{
			$truck->edit_truck($_POST, $id_empresa);
		}

		if(isset($_POST['delete']))
		{
			$truck->delete_truck($_POST, $id_empresa);
		}
		
		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['trashes'] = $DB->read("select * from trash_buckets where id_empresa = '$id_empresa' order by id desc");
		$data['trucks'] = $DB->read("select * from garbage_cars where id_empresa = '$id_empresa' order by id desc");
		$data['page_title'] = "Truck";
		$this->view("empresas/trucks", $data);
	}

	public function address()
	{
		$truck = $this->load_model('Truck');

		$Group = $this->load_model('Group');
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();
		//add address
		if(isset($_POST['add_address']))
		{
			$address->add_address($_POST, $id_empresa);
		}

		//edit address
		if(isset($_POST['edit_address']))
		{
			$address->edit_address($_POST, $id_empresa);
		}

		//delete address
		if(isset($_POST['delete_address']))
		{
			$address->delete_address($_POST, $id_empresa);
		}

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");

		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['address'] = $DB->read("select * from garbage_address order by id desc");
		$data['page_title'] = "Address";
		$this->view("empresas/address", $data);
	}
	
	public function messages() 
	{
		
		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['delete_message']))
		{
			$Empresa->delete_message($_POST);
		}
		
		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['page_title'] = "Messages";
		$this->view("empresas/messages", $data);
	}


	public function relatoriogeral()
	{
		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['print'])){
			$this->imprimirelatorio();
			die;
		}

		$data['contentores'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['groups'] = $DB->read("select * from colector_group where id_empresa = '$id_empresa' order by id desc");
		$data['page_title'] = "RelatorioGeral";
		$this->view("empresas/relatoriogeral", $data);
	}

	public function relatorioestatistico()
	{
		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['imprimir'])){
			$this->imprimirelatorioestatistico($_POST);
			die;
		}

		$data['contentores'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['groups'] = $DB->read("select * from colector_group where id_empresa = '$id_empresa' order by id desc");
		$data['history_buckets_full'] = $DB->read("select * from trash_buckets as tb inner join history_trashbucket ht on tb.id = ht.trashbucket_id where ht.status = 'full' AND tb.id_empresa = '$id_empresa'");
		$data['history_buckets_empty'] = $DB->read("select * from trash_buckets as tb inner join history_trashbucket ht on tb.id = ht.trashbucket_id where ht.status = 'empty' AND tb.id_empresa = '$id_empresa'");
		
		$month = date('m');
		$data['months_history'] = $DB->read("SELECT * FROM trash_buckets AS tb INNER JOIN history_trashbucket AS ht ON tb.id = ht.trashbucket_id WHERE MONTH(ht.status_date) <= '$month' and ht.status = 'full' AND tb.id_empresa = '$id_empresa'");

		$data['page_title'] = "RelatorioEstatistico";
		$this->view("empresas/relatorioestatistico", $data);
	}

	public function imprimirelatorioestatistico($POST)
	{
		$date1 = $POST['date1'];
		$date2 = $POST['date2'];

		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		$data['contentores'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['groups'] = $DB->read("select * from colector_group where id_empresa = '$id_empresa' order by id desc");
		$data['history_buckets_full'] = $DB->read("SELECT * from trash_buckets as tb inner join history_trashbucket ht on tb.id = ht.trashbucket_id where (ht.status_date >= '$date1' and ht.status_date <= '$date2') and tb.id_empresa = '$id_empresa' and  ht.status = 'full'");
		$data['history_buckets_empty'] = $DB->read("SELECT * from trash_buckets as tb inner join history_trashbucket ht on tb.id = ht.trashbucket_id where (ht.status_date >= '$date1' and ht.status_date <= '$date2') and tb.id_empresa = '$id_empresa' and  ht.status = 'empty'");
		$data['date1'] = $date1;
		$data['date2'] = $date2;
		$month = date('m');
		$data['months_history'] = $DB->read("SELECT * FROM trash_buckets AS tb INNER JOIN history_trashbucket AS ht ON tb.id = ht.trashbucket_id WHERE (ht.status_date >= '$date1' and ht.status_date <= '$date2') and tb.id_empresa = '$id_empresa' and ht.status = 'full'");

		$data['page_title'] = "RelatorioEstatistico";
		$this->view("empresas/imprimirelatorioestatistico", $data);

	}

	public function imprimirelatorio()
	{
		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		$data['contentores'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['groups'] = $DB->read("select * from colector_group where id_empresa = '$id_empresa' order by id desc");
		$data['page_title'] = "RelatorioGeral";
		$this->view("empresas/imprimirelatorio", $data);
	}

	public function filtrar_relatorio()
	{
		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}

		if(isset($_POST['imprimirstatus'])){
			$this->imprimirelatoriostatus($_POST);
			die;
		}
		$DB = Database::newInstance();

		$data['contentores'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['groups'] = $DB->read("select * from colector_group where id_empresa = '$id_empresa' order by id desc");

		$data['page_title'] = "FiltrarRelatorio";
		$this->view("empresas/filtrar_relatorio", $data);
	}

	public function imprimirelatoriostatus($POST){
		$date1 = $POST['date1'];
		$date2 = $POST['date2'];
		$status = $POST['status'];

		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		$data['contentores'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['groups'] = $DB->read("select * from colector_group where id_empresa = '$id_empresa' order by id desc");
		$data['history_buckets'] = $DB->read("SELECT * from trash_buckets as tb inner join history_trashbucket ht on tb.id = ht.trashbucket_id where (ht.status_date >= '$date1' and ht.status_date <= '$date2') and tb.id_empresa = '$id_empresa' and  ht.status = '$status'");
		$data['date1'] = $date1;
		$data['date2'] = $date2;

		if($status == "empty"){
			$data['status'] = "Vazio";
		}else if($status == "full"){
			$data['status'] = "Cheio";
		}else{
			$data['status'] = "Meio";
		}
		$data['status_c'] = $status;
		
		$month = date('m');
		$data['months_history'] = $DB->read("SELECT * FROM trash_buckets AS tb INNER JOIN history_trashbucket AS ht ON tb.id = ht.trashbucket_id WHERE (ht.status_date >= '$date1' and ht.status_date <= '$date2') and tb.id_empresa = '$id_empresa' and ht.status = '$status'");

		$data['page_title'] = "FiltrarRelatorio";
		$this->view("empresas/imprimirelatoriostatus", $data);
	}


	public function profile()
	{
		$Empresa = $this->load_model('Infoempresa');
		$address = $this->load_model('Address');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa'");

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");

		//verify user created
		$session_user = $_SESSION['empresa_url'];
		$create_check = $DB->read("SELECT * FROM empresas WHERE url_address = '$session_user' limit 1");
		$user_created = $create_check[0]->id;

		//$data['user_created'] = $DB->read("select * from users where created_by = '$user_created'");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");

		$id = $data['user_data']->id;

		if(isset($_POST['admin_profile_button']))
		{
			//show($_POST);
			$Empresa->update_empresa_profile($_POST, $id);

			if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
				//show($_SESSION['error']);
				$data['errors'] = $_SESSION['error'];
				$data['POST'] = $_POST;
			}
		}

		$data['page_title'] = "Profile";
		$this->view("empresas/profile", $data);
	}

	// JAVASCRIPT OBJECTS

	
	public function message_row()
	{
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$row = $DB->read("SELECT * FROM messages WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}

	public function truck_row()
	{
		$truck = $this->load_model('Truck');

		$Group = $this->load_model('Group');
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM garbage_cars WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}

	public function users_row()
	{
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();


		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM users WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}

	public function groups_row()
	{
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM colector_group WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}

	public function trash_row()
	{
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT *, (SELECT address from garbage_address where id='$id') as add_name FROM trash_buckets WHERE id=:id",['id'=>$id]);
			//SELECT garbage_address.address, trash_buckets.address_id FROM `garbage_address` INNER join trash_buckets on garbage_address.id = trash_buckets.address_id;
			echo json_encode($row);
		}
	}

	// some row no controllers
	public function address_row()
	{
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		if(isset($_POST['id'])){
			$id = $_POST['id'];

			$row = $DB->read("SELECT * FROM garbage_address WHERE id=:id",['id'=>$id]);

			echo json_encode($row);
		}
	}


	public function update_table()
	{
		$User = $this->load_model('User');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();

		//get provinces
		$provinces = $this->load_model('Provinces');
		$data['provinces'] = $provinces->get_provinces();


		$trashes = $DB->read("select * from trash_buckets where id_empresa = '$id_empresa' order by id desc");
		$tableRows = '';
		if (is_array($trashes)) {
			foreach ($trashes as $trash) {
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
