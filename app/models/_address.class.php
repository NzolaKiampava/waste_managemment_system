<?php

Class Address
{
    private $error = "";

    public function add_address($POST)
    {
        $data = array();
		$db = Database::getInstance();

		$data['address'] = trim($POST['address']);

		//check if group name already exits
		
		$sql = "SELECT * FROM garbage_address WHERE address = :address limit 1";
		$arr['address'] = $data['address'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
            $_SESSION['error'] = "O endereço já existe!";
			return false;
		}

		//check for url_address
		$arr = false;

		// take the user who is create new group
		$session_user = $_SESSION['user_url'];
		$create_check = $db->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");

		if($create_check){
			$data['created_by'] = $create_check[0]->id;
			
			//save
			$data['created_at'] = date("Y-m-d H:i:s");
			//show($data);
			$query = "INSERT INTO garbage_address (address,created_by,created_at) values (:address,:created_by,:created_at)";
			$result = $db->write($query,$data);

			//show($result);
			if($result)
			{
				$_SESSION['success'] = "Endereço criado com Sucesso!";
				header("Location: " . ROOT . "admin/address");
				die;
			}
		}
		
		$_SESSION['error'] = "Não foi possivel criar Endereço, verifica se está tudo em ordem!";
		return false;
    }

	public function edit_address($POST)
	{
		$data = array();
		$db = Database::getInstance();
	
		$data['address']  = trim($POST['address']);	
		$data['id']	    = trim($POST['id']);

        //save
        $query = "UPDATE garbage_address SET address = :address where id = :id";

        $result = $db->write($query,$data);
        if($result)
        {
            $_SESSION['success'] = "Salvo com Sucesso!";
            header("Location: " . ROOT . "admin/address");
            die;
        }	

	}

	public function delete_address($POST)
	{
		//show($POST);
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from garbage_address where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			$_SESSION['success'] = "Grupo deletado com Sucesso!";
			header("Location: " . ROOT . "admin/address");
			die;
		}
	}
} 

