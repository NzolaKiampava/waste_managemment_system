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
		$data['messages'] = $DB->read("select * from messages  order by id desc");



		//municipios de luanda
		$data['belas'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Belas' AND status = 'full'");
		$data['cacuaco'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cacuaco' AND status = 'full'");
		$data['cazenga'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cazenga' AND status = 'full'");
		$data['icolo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Icolo e Bengo' AND status = 'full'");
		$data['quissama'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Quissama' AND status = 'full'");
		$data['viana'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Viana' AND status = 'full'");
		$data['luandam'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Luanda' AND status = 'full'");

		$data['page_title'] = "asasa";
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
			$Group->delete_group($_POST);
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
}
