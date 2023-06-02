<?php 

Class Empresa extends User
{
    private $error = "";

    public function add_empresa($POST)
    {
        $data = array();
		$db = Database::getInstance();

		$data['empresa'] = trim($POST['empresa']);
		$data['email'] = trim($POST['email']);
		$data['province'] = trim($POST['province']);
		$data['municipy'] = trim($POST['municipy']);
        $data['nif'] = trim($POST['nif']);
        $data['telefone'] = trim($POST['telefone']);
        $data['status'] = trim($POST['status']);

		
		$data['password'] = $this->get_random_string_max(9);
		$recipient = $data['email'];
		$subject = 'Cadastro da Empresa';
		$message = 'SmartWaste! A empresa '.$data['empresa'].' foi cadastrado com sucesso, A empresa está com estado '.$data['status']. '. A senha de acesso é '.$data['password'].' .        
		Clica no link abaixo para entrar na conta empresa e criar usuários para acesso!

		http://localhost/waste_ms2/public/login_company';

		$data['password'] = hash('sha1', $data['password']);

		//check if group name already exits
		
		$sql = "SELECT * FROM empresas WHERE email = :email limit 1";
		$arr['email'] = $data['email'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
            $_SESSION['error'] = "Nome da Empresa já existe!";
			return false;
		}

		//check for url_address
		$arr = false;

		$data['url_address'] = $this->get_random_string_max(30);

		// take the user who is create new group
		$session_user = $_SESSION['empresa_url'];
		$create_check = $db->read("SELECT * FROM users WHERE url_address = '$session_user' limit 1");
                 
		if($create_check){
			$data['created_by'] = $create_check[0]->id;
			
			//save
			$data['created_at'] = date("Y-m-d H:i:s");
			show($data);
			$query = "INSERT INTO empresas(url_address,empresa,email,province,municipy,nif,telefone,status,password,created_by,created_at) values(:url_address,:empresa,:email,:province,:municipy,:nif,:telefone,:status,:password,:created_by,:created_at)";
			$result = $db->write($query,$data);

			show($result);
			if($result)
			{
				$this->send_mail($recipient,$subject,$message);
				$_SESSION['success'] = "Empresa criado com Sucesso!";
				header("Location: " . ROOT . "admin/empresa");
				die;
			}
		}
		
		$_SESSION['error'] = "Não foi possivel criar empresa, verifica se está tudo em ordem!";
		return false;
    }

	public function edit_empresa($POST)
	{
		$data = array();
		$db = Database::getInstance();
	
		$data['id']	    = trim($POST['id']);
		$data['province'] = trim($POST['province']);
		$data['municipy'] = trim($POST['municipy']);
        $data['empresa'] = trim($POST['empresa']);
        $data['email'] = trim($POST['email']);
        $data['nif'] = trim($POST['nif']);
        $data['telefone'] = trim($POST['telefone']);
        $data['status'] = trim($POST['status']);


		if(empty($data['empresa']) || !preg_match("/^[a-zA-Z ]+$/", $data['empresa']))
		{
			$this->error .= "Porfavor Entra com nome da empresa valida <br>";
		}

		if($this->error == ""){
			//save
			$query = "UPDATE empresas SET email = :email, empresa = :empresa, province = :province, municipy = :municipy, nif = :nif, telefone = :telefone, status = :status where id = :id";

			$result = $db->write($query,$data);
			if($result)
			{
				$_SESSION['success'] = "Salvo com Sucesso!";
				header("Location: " . ROOT . "admin/empresa");
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
		$filename = $_FILES['logo']['name'];
		$destination = "";
		$folder = "uploads/";

		if (!file_exists($folder)) //if file $folder not exist
		{
			mkdir($folder, 0777, true);  //crete a directory to this $folder
		}

		$destination = $folder . "wastems-".rand(1,999)."-".$_FILES['logo']['name'];

		if(!empty($filename)){
			move_uploaded_file($_FILES['logo']['tmp_name'], $destination);	
		}

		$result = $db->write("UPDATE empresas set logo=:image where id=:id",['image'=>$destination, 'id'=>$id]);
		if($result)
		{
			$_SESSION['success'] = "Logo foi salvo com sucesso!";
			header("Location: " . ROOT . "admin/empresa");
			die;
		}
	}

	public function delete_empresa($POST)
	{
		//show($POST);
		$DB = Database::newInstance();
		$id = trim($POST['id']);
		$query = "delete from empresas where id = '$id' limit 1";
		$result = $DB->write($query);
		if($result)
		{
			$_SESSION['success'] = "Empresa deletado com Sucesso!";
			header("Location: " . ROOT . "admin/empresa");
			die;
		}
	}
	
}
