<?php 

/*Class User 
{
	private $error = "";

	public function signup($POST)
	{
			
		$data = array();
		$db = Database::getInstance();

		$data['name']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);		
		$data['password']  = trim($POST['password']);		
		$password2         = trim($POST['password2']);

		if(empty($data['email']) || !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Please enter a valid email <br>";
		}

		if(empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name']))
		{
			$this->error .= "Please enter a valid name <br>";
		}	

		if($data['password'] !== $password2)
		{
			$this->error .= "password do not match <br>";
		}

		if(strlen($data['password']) < 4)
		{
			$this->error .= "Password must be at least 4 characters long <br>";
		}

		//check if email already exits
		$sql = "SELECT * FROM users WHERE email = :email limit 1";
		$arr['email'] = $data['email'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			$this->error .= "That email is already in use <br>";
		}

		$data['url_address'] = $this->get_random_string_max(30);
		
		//check for url_address
		$arr = false;

		$sql = "SELECT * FROM users WHERE url_address = :url_address limit 1";
		$arr['url_address'] = $data['url_address'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			$data['url_address'] = $this->get_random_string_max(30);
		}


		if($this->error == ""){
			//save
			$data['rank'] = "customer";
			$data['date'] = date("Y-m-d H:i:s");
			$data['password'] = hash('sha1', $data['password']);

			$query = "INSERT INTO users (url_address,name,email,password,date,rank) values (:url_address,:name,:email,:password,:date,:rank)";

			$result = $db->write($query,$data);

			if($result)
			{
				header("Location: " . ROOT . "login");
				die;
			}
		}

		$_SESSION['error'] = $this->error;
	}

	public function login($POST)
	{
		$data = array();
		$db = Database::getInstance();

		$data['email']     = trim($POST['email']);		
		$data['password']  = trim($POST['password']);		

		if(empty($data['email']) || !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Please enter a valid email <br>";
		}


		if(strlen($data['password']) < 4)
		{
			$this->error .= "Password must be at least 4 characters long <br>";
		}		

		if($this->error == ""){
			//comfirm

			$data['password'] = hash('sha1', $data['password']);
			$sql = "SELECT * FROM users WHERE email = :email and password = :password limit 1";

			$result = $db->read($sql,$data);

			if(is_array($result))
			{
				$_SESSION['user_url'] = $result[0]->url_address;
				header("Location: " . ROOT . "home");
				die;
			}

			$this->error .= "Wrong email or password <br>";
		}

		$_SESSION['error'] = $this->error;
	}

	public function add_user($POST)
	{
		show($POST);
		
		$data = array();
		$db = Database::getInstance();

		$data['name']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);	
		$data['rank']      = trim($POST['rank']);	
		$data['password']  = "kiampava";	

		if($data['rank'] == "admin"){
			$type = "admins";
		}else{
			$type = "customers";
		}	

		//check if email already exits
		
		$sql = "SELECT * FROM users WHERE email = :email limit 1";
		$arr['email'] = $data['email'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			return false;
		}
		

		$data['url_address'] = $this->get_random_string_max(30);
		
		//check for url_address
		$arr = false;

		$sql = "SELECT * FROM users WHERE url_address = :url_address limit 1";
		$arr['url_address'] = $data['url_address'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			$data['url_address'] = $this->get_random_string_max(30);
		}

		//save
		
		$data['date'] = date("Y-m-d H:i:s");
		$data['password'] = hash('sha1', $data['password']);

		$query = "INSERT INTO users (url_address,name,email,password,date,rank) values (:url_address,:name,:email,:password,:date,:rank)";

		$result = $db->write($query,$data);

		if($result)
		{

			header("Location: " . ROOT . "admin/users/$type");
			die;
		}
		
		return false;
	}

	public function update_admin_profile($POST, $id)
	{

		$data = array();
		$db = Database::getInstance();

		$data['name']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);		
		$data['password']  = trim($POST['new_password']);
		$data['rank']      = trim($POST['rank']);;	
		$data['id']	       = (int)$id;
		$current_password  = trim($POST['current_password']);

		if(empty($data['email']) || !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Please enter a valid email <br>";
		}

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Please enter a valid name <br>";
		}	


		if(strlen($data['password']) < 4)
		{
			$this->error .= "Password must be at least 4 characters long <br>";
		}

		//check the current password
		$sql = "SELECT * FROM users WHERE id = :id limit 1";
		$arr['id'] = (int)$id;
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			
			$current_password = hash('sha1', $current_password);

			if($current_password == $check[0]->password)
			{
				if($this->error == ""){

					
					//save
					$data['password'] = hash('sha1', $data['password']);

					$query = "UPDATE users SET name = :name ,email = :email,password = :password, rank = :rank where id = :id";

					$result = $db->write($query,$data);

					if($result)
					{
						header("Location: " . ROOT . "admin/admin_profile");
						die;
					}
				}
			}
			else
			{
				$this->error = "The current password is wrong <br/>";
			}
		}

		$_SESSION['error'] = $this->error;
	}

	public function get_user($url)
	{
		$db = Database::newInstance();
		$arr = false;

		$arr['url'] = addslashes($url);
		$query = "SELECT * FROM users WHERE url_address = :url limit 1";

		$result = $db->read($query,$arr);
		if(is_array($result))
		{	
			return $result[0];
		}

		return false;
	}


	public function get_admins()
	{
		$db = Database::newInstance();
		$arr = false;

		$arr['rank'] = "admin";
		$query = "SELECT * FROM users WHERE rank = :rank";

		$result = $db->read($query,$arr);
		if(is_array($result))
		{	
			return $result;
		}

		return false;
	}


	private function get_random_string_max($length)
	{
		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

		$text = "";
		$length = rand(4,$length);   //$length acumula valores aleeatorios de 4 ate o valor da var length

		for ($i=0; $i < $length; $i++) { 
			
			$random = rand(0,30);
			
			$text .= $array[$random];
		}

		return $text;
	}

	public function check_login($redirect = false, $allowed = array())
	{
		$db = Database::getInstance();
		if (count($allowed) > 0) {

			$arr['url'] = $_SESSION['user_url'];
			$query = "SELECT * FROM users WHERE url_address = :url limit 1";
			$result = $db->read($query, $arr);

			if(is_array($result)){

				$result = $result[0];
				if (in_array($result->rank, $allowed)) {
					return $result;
				}
			}

			header("Location: " . ROOT . "login");
			die;
				
		}else{
				
			if(isset($_SESSION['user_url']))
			{
				$arr = false;

				$arr['url'] = $_SESSION['user_url'];
				$query = "SELECT * FROM users WHERE url_address = :url limit 1";

				$result = $db->read($query,$arr);
				if(is_array($result))
				{	
					return $result[0];
				}
			}

			if ($redirect) {
				header("Location: " . ROOT . "login");
				die;
			}
		}

		return false;
	}

	public function logout()
	{
		if(isset($_SESSION['user_url']))
		{
			unset($_SESSION['user_url']);
		}

		header("Location: " . ROOT . "home");
		die;
	}

	public function delete($id)
	{
		$DB = Database::newInstance();
		$id = (int)$id;
		$query = "delete from users where id = '$id' limit 1";
		$DB->write($query);
	}

	public function delete_array($ids)
	{
		$ids = implode("','", $ids);
		$DB = Database::newInstance();
		$query = "DELETE from users where id in ('". $ids ."')";
		$DB->write($query);
	}
}