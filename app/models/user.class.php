<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

Class User 
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

		if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9\\_\\-\\.]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Porfavor entra com email valido <br>";
		}

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Porfavor entra com um nome valido <br>";
		}	

		if($data['password'] !== $password2)
		{
			$this->error .= "Password não coincidem <br>";
		}

		if(strlen($data['password']) < 4)
		{
			$this->error .= "Password deve conter pelomenos 4 caracteres <br>";
		}

		//check if email already exits
		$sql = "SELECT * FROM users WHERE email = :email limit 1";
		$arr['email'] = $data['email'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			$this->error .= "Este email já está em uso <br>";
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
			$data['rank'] = "Normal";
			$data['date'] = date("Y-m-d H:i:s");
			$data['login_at'] = date("Y-m-d H:i:s");
			$data['logout_at'] = date("Y-m-d H:i:s");
			$data['password'] = hash('sha1', $data['password']);

			$query = "INSERT INTO users (url_address,name,email,password,date,rank,login_at,logout_at) values (:url_address,:name,:email,:password,:date,:rank,:login_at,:logout_at)";

			$result = $db->write($query,$data);

			if($result)
			{
				header("Location: " . ROOT . "register");
				die;
			}
		}

		$_SESSION['error'] = $this->error;
	}

	public function login($POST)
	{
		$data = array();
		$db = Database::getInstance();

		$data['name']     = trim($POST['name']);		
		$data['password']  = trim($POST['password']);		

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Porfavor entra com nome valido <br>";
		}


		if(strlen($data['password']) < 4)
		{
			$this->error .= "Password deve conter pelomenos 4 caracteres <br>";
		}		

		if($this->error == ""){
			//comfirm

			$data['password'] = hash('sha1', $data['password']);
			$sql = "SELECT * FROM users WHERE name = :name and password = :password limit 1";

			$result = $db->read($sql,$data);

			if(is_array($result))
			{
				$id = $result[0]->id;
				$login_at = date("Y-m-d H:i:s");
				$db->write("UPDATE users SET login_at = :login_at, online = '1' where id = :id",['login_at'=>$login_at, 'id'=>$id]);
				$_SESSION['success'] =  "Bem Vindo(a) ".$result[0]->name."!";
				$_SESSION['user_url'] = $result[0]->url_address;
				header("Location: " . ROOT . "home");
				die;
			}

			$this->error .= "Nome do Usuário ou Password errado <br>";
		}

		$_SESSION['error'] = $this->error;
	}

	public function recover_password($POST)
	{
		$DB = Database::newInstance();
		$email = trim($POST['email']);
		$query = $DB->read("SELECT * FROM users WHERE email = :email limit 1", ['email'=>$email]);

		if($query)
		{
		    $recover_password = $this->get_random_string_max(20);
		    $rec_password = $recover_password;
		    $password = hash('sha1', $recover_password);

		    $recipient = $query[0]->email;
		    $subject = "Recover Your Password🔐";
		    $message = "Olá ".$query[0]->name."😁, esta é a sua nova palavra-passe: ".$rec_password.". Já podes fazer Login!";

		    $send_mail = $this->send_mail($recipient,$subject,$message);
		    if($send_mail)
		    {
		    	$result = $DB->write("UPDATE users SET password = :password where email = :email",['password'=>$password, 'email'=>$email]);
				if($result)
				{
					$_SESSION['sucess_recover_password'] = "Porfavor verifica o seu Email";
					header("Location: " . ROOT . "register");
					die;
				}
		    }
			
		}

	}

	function send_mail($recipient,$subject,$message)
	{
	  
	  $mail = new PHPMailer();
	  $mail->CharSet = 'utf-8';
	  $mail->IsSMTP();

	  $mail->SMTPDebug  = 0;  
	  $mail->SMTPAuth   = TRUE;
	  $mail->SMTPSecure = "tls";
	  $mail->Port       = 587;
	  $mail->Host       = "smtp.gmail.com";
	  //$mail->Host       = "smtp.mail.yahoo.com";
	  $mail->Username   = "nzolakiampava@gmail.com";
	  $mail->Password   = "kxzlxsyuayfdlrcj";

	  $mail->IsHTML(true);
	  $mail->AddAddress($recipient, "recipient-name");
	  $mail->SetFrom("nzolakiampava@gmail.com", "SmartWASTE");
	  // $mail->SetFrom("nzolakiampava@gmail.com", "your-sender-name");
	  //$mail->AddReplyTo("reply-to-email", "reply-to-name");
	  //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
	  $mail->Subject = $subject;
	  $content = $message;

	  $mail->MsgHTML($content); 
	  if(!$mail->Send()) {
	    echo "Error while sending Email.";
	    //var_dump($mail);
	    return false;
	  } else {
	    echo "Email sent successfully";
	    return true;
	  }

	}

	public function add_user($POST)
	{
		//show($POST);
		
		$data = array();
		$db = Database::getInstance();

		$data['name']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);	
		$data['rank']      = trim($POST['rank']);	
		$data['password']  = "12345678";	

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

		// take the user who is create new users
		$session_user = $_SESSION['user_url'];
		$create_check = $db->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");
		$data['created_by'] = $create_check[0]->id;

		$sql = "SELECT * FROM users WHERE url_address = :url_address limit 1";
		$arr['url_address'] = $data['url_address'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			$data['url_address'] = $this->get_random_string_max(30);
		}

		//save
		
		$data['date'] = date("Y-m-d H:i:s");
		$data['password'] = hash('sha1', $data['password']);

		$query = "INSERT INTO users (url_address,name,email,password,date,rank,created_by) values (:url_address,:name,:email,:password,:date,:rank,:created_by)";

		$result = $db->write($query,$data);

		if($result)
		{
			$_SESSION['success'] = "Usuario criado com Sucesso!";
			header("Location: " . ROOT . "admin/users");
			die;
		}
		
		$_SESSION['error'] = "Não foi possivel criar Usuário, verifica se está tudo em ordem!";
		return false;
	}

	public function update_admin_profile($POST, $id)
	{

		$data = array();
		$db = Database::getInstance();

		$data['name']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);		
		$datap['password']  = trim($POST['new_password']);
		$data['rank']      = trim($POST['rank']);	
		$data['id']	       = (int)$id;
		$current_password  = trim($POST['current_password']);


		if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9\\_\\-\\.]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Please enter a valid email <br>";
		}

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Please enter a valid name <br>";
		}	


		//check the current password
		$sql = "SELECT * FROM users WHERE id = :id limit 1";
		$arr['id'] = (int)$id;
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			
			$current_password = hash('sha1', $current_password);

			if(!empty($datap['password']) && !empty($current_password)){
				if($current_password == $check[0]->password)
				{
					if(strlen($datap['password']) < 4)
					{
						$this->error .= "Password must be at least 4 characters long <br>";
					}
					if($this->error == ""){

						//save
						$data['password'] = hash('sha1', $datap['password']);

						$query = "UPDATE users SET name = :name ,email = :email,password = :password, rank = :rank where id = :id";

						$result = $db->write($query,$data);

						if($result)
						{
							$_SESSION['success'] = "Salvo com Sucesso!";
							header("Location: " . ROOT . "admin/profile");
							die;
						}
					}
				}
				else
				{
					$this->error = "The current password is wrong <br/>";
				}
			}
			else{
				if($this->error == ""){
					//save
					$query = "UPDATE users SET name = :name ,email = :email, rank = :rank where id = :id";

					$result = $db->write($query,$data);
					if($result)
					{
						$_SESSION['success'] = "Salvo com Sucesso!";
						header("Location: " . ROOT . "admin/profile");
						die;
					}
				}
			}
		}

		$_SESSION['error'] = $this->error;
	}

	public function update_user_profile($POST, $FILES = "", $id)
	{

		$data = array();
		$db = Database::getInstance();

		$data['name']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);		
		$data['id']	       = (int)$id;


		$filename = $FILES['image']['name'];
		$destination = "";
		$folder = "uploads/";

		if (!file_exists($folder)) //if file $folder not exist
		{
			mkdir($folder, 0777, true);  //crete a directory to this $folder
		}


		if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9\\_\\-\\.]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Please enter a valid email <br>";
		}

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Please enter a valid name <br>";
		}	

		if($this->error == ""){
			//save
			if(!empty($filename)){
				$destination = $folder . "wastems-".rand(1,999)."-".$FILES['image']['name'];
				move_uploaded_file($FILES['image']['tmp_name'], $destination);
				$data['image'] = $destination;
				$query = "UPDATE users SET name = :name ,email = :email, image = :image where id = :id";

			}else {
				$query = "UPDATE users SET name = :name ,email = :email where id = :id";
			}

			$result = $db->write($query,$data);
			if($result)
			{
				$_SESSION['success'] = "Salvo com Sucesso!";
				header("Location: " . ROOT . "dashboard_userprofile");
				die;
			}
		}

		$_SESSION['error'] = $this->error;
	}

	public function update_user_password($POST, $id)
	{

		$data = array();
		$db = Database::getInstance();
		
		$datap['password']  = trim($POST['new_password']);
		$data['id']	       = (int)$id;
		$current_password  = trim($POST['current_password']);
	
		//check the current password
		$sql = "SELECT * FROM users WHERE id = :id limit 1";
		$arr['id'] = (int)$id;
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			
			$current_password = hash('sha1', $current_password);

			if(!empty($datap['password']) && !empty($current_password)){
				if($current_password == $check[0]->password)
				{
					if(strlen($datap['password']) < 4)
					{
						$this->error .= "Password must be at least 4 characters long <br>";
					}
					if($this->error == ""){

						//save
						$data['password'] = hash('sha1', $datap['password']);

						$query = "UPDATE users SET password = :password where id = :id";

						$result = $db->write($query,$data);

						if($result)
						{
							$_SESSION['success'] = "Salvo com Sucesso!";
							header("Location: " . ROOT . "dashboard_userchangepassword");
							die;
						}
					}
				}
				else
				{
					$this->error = "The current password is wrong <br/>";
				}
			}
			
		}

		$_SESSION['error'] = $this->error;
	}

	public function edit_user($POST)
	{

		$data = array();
		$db = Database::getInstance();

		$data['name']      = trim($POST['name']);		
		$data['email']     = trim($POST['email']);		
		$data['rank']      = trim($POST['rank']);	
		$data['id']	       = trim($POST['id']);


		if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9\\_\\-\\.]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']))
		{
			$this->error .= "Please enter a valid email <br>";
		}

		if(empty($data['name']) || !preg_match("/^[a-zA-Z ]+$/", $data['name']))
		{
			$this->error .= "Please enter a valid name <br>";
		}

		if($this->error == ""){
			//save
			$query = "UPDATE users SET name = :name ,email = :email, rank = :rank where id = :id";

			$result = $db->write($query,$data);
			if($result)
			{
				$_SESSION['success'] = "Salvo com Sucesso!";
				header("Location: " . ROOT . "admin/users");
				die;
			}
		}
			
		$_SESSION['error'] = $this->error;
	}

	public function upload_photo($POST)
	{
		$data = array();
		$db = Database::getInstance();

		$id = trim($POST['id']);
		$filename = $_FILES['photo']['name'];
		$destination = "";
		$folder = "uploads/";

		if (!file_exists($folder)) //if file $folder not exist
		{
			mkdir($folder, 0777, true);  //crete a directory to this $folder
		}

		$destination = $folder . "wastems-".rand(1,999)."-".$_FILES['photo']['name'];

		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], $destination);	
		}

		$result = $db->write("UPDATE users set image=:image where id=:id",['image'=>$destination, 'id'=>$id]);
		if($result)
		{
			$_SESSION['success'] = "Imagem foi salvo com sucesso!";
			header("Location: " . ROOT . "admin/users");
			die;
		}
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

	public function get_customers()
	{
		$db = Database::newInstance();
		$arr = false;

		$arr['rank'] = "customer";
		$query = "SELECT * FROM users WHERE rank = :rank";

		$result = $db->read($query,$arr);
		if(is_array($result))
		{	
			return $result;
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


	public function get_random_string_max($length)
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
			$DB = Database::newInstance();
			$url_address = $_SESSION['user_url'];
			$logout_at = date("Y-m-d H:i:s");
			$DB->write("UPDATE users SET logout_at = :logout_at, online = '0' where url_address = :url_address",['logout_at'=>$logout_at, 'url_address'=>$url_address]);
			unset($_SESSION['user_url']);
		}

		header("Location: " . ROOT . "register");
		die;
	}

	public function delete_user($POST)
	{
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from users where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			$_SESSION['success'] = "Usuário deletado com Sucesso!";
			header("Location: " . ROOT . "admin/users");
			die;
		}
	}

	public function delete_array($ids)
	{
		$ids = implode("','", $ids);
		$DB = Database::newInstance();
		$query = "DELETE from users where id in ('". $ids ."')";
		$DB->write($query);
	}
}