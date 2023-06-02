<?php

Class Group
{
    private $error = "";

    public function add_group($POST, $id_empresa = [])
    {
        $data = array();
		$db = Database::getInstance();

		$data['group'] = trim($POST['group']);

		//check if group name already exits
		
		$sql = "SELECT * FROM colector_group WHERE group_name = :group limit 1";
		$arr['group'] = $data['group'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
            $_SESSION['error'] = "Nome do grupo já existe!";
			return false;
		}

		//check for url_address
		$arr = false;

		// take the user who is create new group
		if (empty($id_empresa)){
			$session_user = $_SESSION['user_url'];
			$create_check = $db->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");

			if($create_check){
				$data['created_by'] = $create_check[0]->id;
				
				//save
				$data['created_at'] = date("Y-m-d H:i:s");
				//show($data);
				$query = "INSERT INTO colector_group (group_name,created_by,created_at) values (:group,:created_by,:created_at)";
				$result = $db->write($query,$data);
	
				show($result);
				if($result)
				{
					$_SESSION['success'] = "Grupo criado com Sucesso!";
					header("Location: " . ROOT . "admin/groups");
					die;
				}
			}
		}else {
			//save
			$data['created_at'] = date("Y-m-d H:i:s");
			$data['id_empresa'] = $id_empresa;
			//show($data);
			$query = "INSERT INTO colector_group (group_name,created_at,id_empresa) values (:group,:created_at,:id_empresa)";
			$result = $db->write($query,$data);

			//show($result);
			if($result)
			{
				$_SESSION['success'] = "Grupo criado com Sucesso!";
				header("Location: " . ROOT . "empresas/groups");
				die;
			}
		}


		$_SESSION['error'] = "Não foi possivel criar Grupo, verifica se está tudo em ordem!";
		return false;
    }

	public function edit_group($POST, $id_empresa = [])
	{
		$data = array();
		$db = Database::getInstance();
	
		$data['group']  = trim($POST['group']);	
		$data['id']	    = trim($POST['id']);


		//Verify if the group exist
		$arr['group'] = $data['group'];
		$search = "SELECT * FROM colector_group where group_name = :group";
		$verify = $db->read($search,$arr);
		if($verify)
		{
			show($verify);
			$_SESSION['error'] = "Nome do grupo já existe";
			return false;
			die;
		}else{

			//save
			$query = "UPDATE colector_group SET group_name = :group where id = :id";

			$result = $db->write($query,$data);
			if($result)
			{
				if (!empty($id_empresa)){
					$_SESSION['success'] = "Salvo com Sucesso!";
					header("Location: " . ROOT . "empresas/groups");
					die;
				}else {
					$_SESSION['success'] = "Salvo com Sucesso!";
					header("Location: " . ROOT . "admin/groups");
					die;
				}
			}
		}
	
	}

	public function delete_group($POST, $id_empresa = [])
	{
		show($POST);
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from colector_group where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			if (!empty($id_empresa)){
				$_SESSION['success'] = "Grupo deletado com Sucesso!";
				header("Location: " . ROOT . "empresas/groups");
				die;
			}else {
				$_SESSION['success'] = "Grupo deletado com Sucesso!";
				header("Location: " . ROOT . "admin/groups");
				die;
			}
		}
	}
} 

