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
			$this->error .= "Password deve conter pelomenos 4 caracteres <br>";
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