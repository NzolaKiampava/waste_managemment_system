<?php

require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;


class Message extends User
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

		$provincia = $data['province'];
		$municipio = $data['municipy'];
		$mensagem = $data['message'];
		$endereco = $data['address'];

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

		$search_empresa = $db->read("SELECT * FROM empresas WHERE province = '$provincia' and municipy = '$municipio'");

		if($search_empresa){
			$id_empresa = $search_empresa[0]->id;
			$data['id_empresa'] = $id_empresa;
			$query = "INSERT INTO messages (user_id,id_empresa,province,municipy,address,message,image,date) values (:user_id,:id_empresa,:province,:municipy,:address,:message,:image,:date)";
		}else {
			$query = "INSERT INTO messages (user_id,province,municipy,address,message,image,date) values (:user_id,:province,:municipy,:address,:message,:image,:date)";
		}
       
        
		$result = $db->write($query,$data);

        if($result)
        {
			$sid = 'ACa7d5c66e7a1916cd8799019cdea71add';
			$token = '0fed6684e6d2fa33285fff6c0a7935de';

			// A Twilio number you own with SMS capabilities
			$twilio_number = "+12707704194";

			if($search_empresa){
				$empresa = $search_empresa[0]->empresa;
				$recipient = $search_empresa[0]->email;;
				$subject = 'Mensagem de Colecta';
				$message = "<?=$empresa?>! Uma nova mensagem de colecta foi enviada ao sistema, na província de '.$provincia.', municipio de '.$municipio.', no endereço '.$endereco.', com a seguinte mensagem: '.$mensagem.'.           
				
				https://smartwaste.com";
			}else{
				$recipient = 'delcioferreira57@gmail.com';
				$subject = 'Mensagem de Colecta';
				$message = 'SmartWaste! Uma nova mensagem de colecta foi enviada ao sistema, na província de '.$provincia.', municipio de '.$municipio.', no endereço '.$endereco.', com a seguinte mensagem: '.$mensagem.'.           
				
				https://smartwaste.com';
			}

			$client = new Client($sid, $token);
			$message = $client->messages->create(
				// Where to send a text message (your cell phone?)
				'+244924947415',
				array(
					'from' => $twilio_number,
					'body' => $message
				)
			);

			$this->send_mail($recipient,$subject,$message);

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
