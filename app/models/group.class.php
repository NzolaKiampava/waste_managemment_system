<?php

Class Group
{
    private $error = "";

    public function add_group($POST)
    {
        $data = array();
		$db = Database::getInstance();

		$data['group'] = trim($POST['group']);

		//check if group name already exits
		
		$sql = "SELECT * FROM groups WHERE group = :group limit 1";
		$arr['group'] = $data['group'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
            $_SESSION['error'] = "Nome do grupo já existe!";
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
		
			//$data['created_at'] = date("Y-m-d H:i:s");
			//show($data);
			$query = "INSERT INTO groups (group,created_by) values (:group,:created_by)";
			$result = $db->write($query,$data);

			show($result);
			if($result)
			{
				$_SESSION['success'] = "Grupo criado com Sucesso!";
				header("Location: " . ROOT . "admin/groups");
				die;
			}
		}
		
		$_SESSION['error'] = "Não foi possivel criar Grupo, verifica se está tudo em ordem!";
		return false;
    }

	public function edit_group($POST)
	{
		$data = array();
		$db = Database::getInstance();
	
		$data['group']  = trim($POST['group']);	
		$data['id']	    = trim($POST['id']);


		if(empty($data['group']) || !preg_match("/^[a-zA-Z ]+$/", $data['group']))
		{
			$this->error .= "Please enter a valid group <br>";
		}

		if($this->error == ""){
			//save
			$query = "UPDATE groups SET group = :group where id = :id";

			$result = $db->write($query,$data);
			if($result)
			{
				$_SESSION['success'] = "Salvo com Sucesso!";
				header("Location: " . ROOT . "admin/groups");
				die;
			}
		}
			
		$_SESSION['error'] = $this->error;
	}

	public function delete_group($POST)
	{
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from groups where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			$_SESSION['success'] = "Grupo deletado com Sucesso!";
			header("Location: " . ROOT . "admin/group");
			die;
		}
	}
} 

