<?php

Class Infoempresa 
{
    private $error = "";
    public function login_company($POST)
	{

		$data = array();
		$db = Database::getInstance();

		$data['nif']     = trim($POST['nif']);		
		$data['password']  = trim($POST['password']);		

		if(strlen($data['password']) < 4)
		{
			$this->error .= "Palavra-passe deve conter pelomenos 4 caracteres <br>";
		}		

		if($this->error == ""){
			//comfirm

			$data['password'] = hash('sha1', $data['password']);
			$sql = "SELECT * FROM empresas WHERE nif = :nif and password = :password limit 1";

			$result = $db->read($sql,$data);

			if(is_array($result))
			{
				$id = $result[0]->id;
				$_SESSION['success'] =  "Bem Vindo(a) ".$result[0]->name."!";
				$_SESSION['empresa_url'] = $result[0]->url_address;
				header("Location: " . ROOT . "empresas");
				die;
			}

			$this->error .= "NIF da empresa ou Password errado <br>";
		}

		$_SESSION['error'] = $this->error;

	}

	public function check_login($redirect = false, $allowed = array())
	{
		$db = Database::getInstance();
		if (count($allowed) > 0) {

			$arr['url'] = $_SESSION['empresa_url'];
			$query = "SELECT * FROM empresas WHERE url_address = :url limit 1";
			$result = $db->read($query, $arr);

			if(is_array($result)){

				$result = $result[0];
				return $result;
			}

			header("Location: " . ROOT . "login_company");
			die;
				
		}else{
				
			if(isset($_SESSION['empresa_url']))
			{
				$arr = false;

				$arr['url'] = $_SESSION['empresa_url'];
				$query = "SELECT * FROM empresas WHERE url_address = :url limit 1";

				$result = $db->read($query,$arr);
				if(is_array($result))
				{	
					return $result[0];
				}
			}

			if ($redirect) {
				header("Location: " . ROOT . "login_company");
				die;
			}
		}

		return false;
	}

	public function update_empresa_profile($POST, $id)
	{


		$data = array();
		$db = Database::getInstance();

		$data['empresa']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);		
		$data['nif']     = trim($POST['nif']);	
		$data['telefone']     = trim($POST['telefone']);		
		$datap['password']  = trim($POST['new_password']);
		$data['id']	       = (int)$id;
		$current_password  = trim($POST['current_password']);


		if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9\\_\\-\\.]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Porfavor entra com um email valido <br>";
		}

		if(empty($data['empresa']) || !preg_match("/^[a-zA-Z ]+$/", $data['empresa']))
		{
			$this->error .= "Porfavor entra com um nome valido <br>";
		}	


		//check the current password
		$sql = "SELECT * FROM empresas WHERE id = :id limit 1";
		$arr['id'] = (int)$id;
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			
			$current_password = hash('sha1', $current_password);

			if(!empty($datap['password']) && !empty($current_password)){
				if($current_password == $check[0]->password)
				{
					if(strlen($datap['password']) < 4)
					{
						$this->error .= "Palavra-passe deve conter pelomenos 4 caracteres <br>";
					}
					if($this->error == ""){

						//save
						$data['password'] = hash('sha1', $datap['password']);

						$query = "UPDATE empresas SET empresa = :empresa ,email = :email, nif = :nif, telefone = :telefone,password = :password where id = :id";

						$result = $db->write($query,$data);

						if($result)
						{
							$_SESSION['success'] = "Salvo com Sucesso!";
							header("Location: " . ROOT . "empresas/profile");
							die;
						}
					}
				}
				else
				{
					$this->error = "A palavra-passe actual está errada <br/>";
				}
			}
			else{
				if($this->error == ""){
					//save
					$query = "UPDATE empresas SET empresa = :empresa ,email = :email, nif = :nif, telefone = :telefone where id = :id";

					$result = $db->write($query,$data);
					if($result)
					{
						$_SESSION['success'] = "Salvo com Sucesso!";
						header("Location: " . ROOT . "empresas/profile");
						die;
					}
				}
			}
		}

		$_SESSION['error'] = $this->error;
	}

	public function delete_message($POST)
    {
        //show($POST);
		
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from messages where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			$_SESSION['success'] = "Mensagem deletada com Sucesso!";
			header("Location: " . ROOT . "empresas/messages");
			die;
		}
    }

	public function logout()
	{
		if(isset($_SESSION['empresa_url']))
		{
			unset($_SESSION['empresa_url']);
		}

		header("Location: " . ROOT . "login_company");
		die;
	}
}
