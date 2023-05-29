<?php 

class Trash
{
    private $error = "";

    public function add_trash($POST, $id_empresa = [])
    {
        $data = array();
		$db = Database::getInstance();

		$data['name'] = trim($POST['name']);
		$data['province'] = trim($POST['province']);
		$data['municipy'] = trim($POST['municipy']);
        $data['address_id'] = trim($POST['address_id']);
        $data['status'] = trim($POST['status']);
		$data['lat'] = trim($POST['lat']);
		$data['lng'] = trim($POST['lng']);

		//check if group name already exits
		
		$sql = "SELECT * FROM trash_buckets WHERE name = :name limit 1";
		$arr['name'] = $data['name'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
            $_SESSION['error'] = "Nome do balde já existe!";
			return false;
		}

		//check for url_address
		$arr = false;
		
		$data['created_at'] = date("Y-m-d H:i:s");
		if(empty($id_empresa)){
			// take the user who is create new group
			$session_user = $_SESSION['user_url'];
			$create_check = $db->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");

			if($create_check){
				$data['created_by'] = $create_check[0]->id;
				
				//save
				//show($data);
				$query = "INSERT INTO trash_buckets(name,province,municipy,address_id,lat,lng,created_by,created_at,status) values(:name,:province,:municipy,:address_id,:lat,:lng,:created_by,:created_at,:status)";
				$result = $db->write($query,$data);

				//show($result);
				if($result)
				{
					$_SESSION['success'] = "Balde criado com Sucesso!";
					header("Location: " . ROOT . "admin/trash");
					die;
				}
			}
		} else {
			//save
			//show($data);
			$data['id_empresa'] = $id_empresa;
			$query = "INSERT INTO trash_buckets(name,province,municipy,address_id,lat,lng,id_empresa,created_at,status) values(:name,:province,:municipy,:address_id,:lat,:lng,:id_empresa,:created_at,:status)";
			$result = $db->write($query,$data);

			//show($result);
			if($result)
			{
				$_SESSION['success'] = "Balde criado com Sucesso!";
				header("Location: " . ROOT . "empresas/trash");
				die;
			}
		}
		
		
		$_SESSION['error'] = "Não foi possivel criar balde, verifica se está tudo em ordem!";
		return false;
    }

	public function edit_trash($POST, $id_empresa = [])
	{
		$data = array();
		$db = Database::getInstance();
	
		$data['id']	    = trim($POST['id']);
		$data['province'] = trim($POST['province']);
		$data['municipy'] = trim($POST['municipy']);
        $data['name'] = trim($POST['name']);
        $data['address_id'] = trim($POST['address_id']);
        $data['status'] = trim($POST['status']);
		$data['lat'] = trim($POST['lat']);
		$data['lng'] = trim($POST['lng']);

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Please enter a valid trash <br>";
		}

		$up['trashbucket_id'] = $data['id'];
		$up['status'] = $data['status'];
		$up['status_date'] = date("Y-m-d H:i:s");

		if($this->error == ""){
			//save

			$query = "UPDATE trash_buckets SET name = :name, province = :province, municipy = :municipy, address_id = :address_id, lat = :lat, lng = :lng, status = :status where id = :id";

			$result = $db->write($query,$data);
			if($result)
			{
				$db->write("INSERT INTO history_trashbucket (trashbucket_id, status, status_date) values(:trashbucket_id, :status, :status_date)",$up);

				$_SESSION['success'] = "Salvo com Sucesso!";
				if(empty($id_empresa)){
					header("Location: " . ROOT . "admin/trash");
					die;
				} else {
					header("Location: " . ROOT . "empresas/trash");
					die;
				}
				
			}
		}
			
		$_SESSION['error'] = $this->error;
	}

	public function delete_trash($POST, $id_empresa = [])
	{
		show($POST);
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from trash_buckets where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			$_SESSION['success'] = "Balde deletado com Sucesso!";
			if(empty($id_empresa)){
				header("Location: " . ROOT . "admin/trash");
				die;
			} else {
				header("Location: " . ROOT . "empresas/trash");
				die;
			}
		}
	}

}
