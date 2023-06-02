<?php 

class Truck
{
    private $error = "";

    public function add_truck($POST, $id_empresa = [])
    {
        $data = array();
		$db = Database::getInstance();

		$data['name'] = trim($POST['name']);
		$data['registration'] = trim($POST['registration']);
        $data['group_id'] = trim($POST['group_id']);
        $data['address_id_1'] = trim($POST['address_id_1']);
        $data['address_id_2'] = trim($POST['address_id_2']);
        $data['address_id_3'] = trim($POST['address_id_3']);

		//check if group name already exits
		
		$sql = "SELECT * FROM garbage_cars WHERE registration = :registration limit 1";
		$arr['registration'] = $data['registration'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
            $_SESSION['error'] = "A matrícula já existe!";
			return false;
            die;
		}

		//check for url_address
		$arr = false;

		// take the user who is create new group
		
		$data['created_at'] = date("Y-m-d H:i:s");
		if(empty($id_empresa)){
			$session_user = $_SESSION['user_url'];
			$create_check = $db->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");

			if($create_check){
				$data['created_by'] = $create_check[0]->id;
				
				//save
				show($data);
				$query = "INSERT INTO garbage_cars(name,registration,group_id,address_id_1,address_id_2,address_id_3,created_by,created_at) values(:name,:registration,:group_id,:address_id_1,:address_id_2,:address_id_3,:created_by,:created_at)";
				$result = $db->write($query,$data);

				if($result)
				{
					$_SESSION['success'] = "Caminhão criado com Sucesso!";
					header("Location: " . ROOT . "admin/trucks");
					die;
				}
			}
		}else {
			$data['id_empresa'] = $id_empresa;
			$query = "INSERT INTO garbage_cars(id_empresa,name,registration,group_id,address_id_1,address_id_2,address_id_3,created_at) values(:id_empresa,:name,:registration,:group_id,:address_id_1,:address_id_2,:address_id_3,:created_at)";
			$result = $db->write($query,$data);

			if($result)
			{
				$_SESSION['success'] = "Caminhão criado com Sucesso!";
				header("Location: " . ROOT . "empresas/trucks");
				die;
			}
		}
		
		$_SESSION['error'] = "Não foi possivel criar caminhão, verifica se está tudo em ordem!";
		return false;
    }

	public function edit_truck($POST, $id_empresa = [])
	{
		$data = array();
		$db = Database::getInstance();
	
		$data['id'] = trim($POST['id']);
		$data['name'] = trim($POST['name']);
		$data['registration'] = trim($POST['registration']);
        $data['group_id'] = trim($POST['group_id']);
        $data['address_id_1'] = trim($POST['address_id_1']);
        $data['address_id_2'] = trim($POST['address_id_2']);
        $data['address_id_3'] = trim($POST['address_id_3']);

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Porfavor entra com um nome valido <br>";
		}

		if($this->error == ""){
			//save
			$query = "UPDATE garbage_cars SET name = :name, registration = :registration, group_id = :group_id, address_id_1 = :address_id_1, address_id_2 = :address_id_2, address_id_3 = :address_id_3   where id = :id";

			$result = $db->write($query,$data);
			if($result)
			{
				$_SESSION['success'] = "Salvo com Sucesso!";
				if(empty($id_empresa)){
					header("Location: " . ROOT . "admin/trucks");
					die;	
				}else {
					header("Location: " . ROOT . "empresas/trucks");
					die;	
				}
			}
		}
			
		$_SESSION['error'] = $this->error;
	}

	public function delete_truck($POST, $id_empresa = [])
	{
		//show($POST);
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from garbage_cars where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			$_SESSION['success'] = "Caminhão deletado com Sucesso!";
			if(empty($id_empresa)){
				header("Location: " . ROOT . "admin/trucks");
				die;	
			}else {
				header("Location: " . ROOT . "empresas/trucks");
				die;	
			}
		}
	}

}
