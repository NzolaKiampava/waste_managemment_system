<?php

class Message 
{
    public function insert_message($POST,$FILES,$id)
    {
        $data = array();
		$db = Database::getInstance();

		$data['province'] = trim($POST['province']);
		$data['municipy'] = trim($POST['municipy']);
        $data['address'] = trim($POST['address']);
        $data['message'] = trim($POST['message']);
        $data['date'] = date("Y-m-d H:i:s");
		$data['user_id'] = $id;

        $filename = $FILES['image']['name'];

		$destination = "";
		$folder = "uploads/";

		if (!file_exists($folder)) //if file $folder not exist
		{
			mkdir($folder, 0777, true);  //crete a directory to this $folder
		}

		$destination = $folder . "wastems-".rand(1,999)."-".$FILES['image']['name'];

		if(!empty($filename)){
			move_uploaded_file($FILES['image']['tmp_name'], $destination);	
		}

        $data['image'] = $destination;

        $query = "INSERT INTO messages (user_id,province,municipy,address,message,image,date) values (:user_id,:province,:municipy,:address,:message,:image,:date)";
        
		$result = $db->write($query,$data);

        if($result)
        {
            header("Location: " . ROOT . "home");
            $_SESSION['success'] =  "Mensagem Envida com Sucesso!";
            die;
        }
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
			header("Location: " . ROOT . "admin/messages");
			die;
		}
    }
}
