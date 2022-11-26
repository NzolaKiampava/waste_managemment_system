<?php

Class Ajax_upload_profile_pic extends Controller
{
	public function index()
	{
		$info = (object)[];  

		$data_type = "";
		if (isset($_POST['data_type'])) 
		{
			$data_type = $_POST['data_type'];
		}


		$destination = "";
		if(isset($_FILES['files']) && $_FILES['files']['name'])
		{

			if ($_FILES['files']['error'] == 0) 
			{
				//good to go
				$folder = "uploads/";

				if (!file_exists($folder)) //if file $folder not exist
				{
					mkdir($folder, 0777, true);  //crete a directory to this $folder
				}

				$destination = $folder . "wastems-".rand(1,999)."-".$_FILES['files']['name'];
				move_uploaded_file($_FILES['files']['tmp_name'], $destination);

				$_SESSION['success'] = "Your profile image was uploaded!";
				$info->message = "Your profile image was uploaded!<br>";
				$info->data_type = $data_type;
				echo json_encode($info);
			}
		}


		if ($data_type == "change_profile_image") 
		{

			if ($destination != "") 
			{	
				$DB = Database::newInstance();
				$id = $_SESSION['user_url'];
				$query = "UPDATE users set image = '$destination' where url_address = '$id' limit 1";
				$DB->write($query, []);

			}

		}
	}
}
