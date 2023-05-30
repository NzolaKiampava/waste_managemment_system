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
		$address = $this->load_model('Address');
		$Empresa = $this->load_model('Infoempresa');
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

		$data['count_trash'] = $DB->read("SELECT * FROM trash_buckets where id_empresa = '$id_empresa'");
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full' and id_empresa = '$id_empresa'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty' and id_empresa = '$id_empresa'");

		$data['users'] = $DB->read("select * from users where id_empresa = '$id_empresa' order by id desc");
		$data['messages'] = $DB->read("select * from messages where id_empresa = '$id_empresa' order by id desc");
		$data['address'] = $DB->read("select * from garbage_address order by id desc");
		$data['page_title'] = "Address";
		$this->view("empresas/address", $data);
	}
	

	// JAVASCRIPT OBJECTS

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
