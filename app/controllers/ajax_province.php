<?php 

Class Ajax_province extends Controller
{

	public function index($data_type = '',$id = '')
	{
		$info = file_get_contents("php://input");
		$info = json_decode($info);

		$id = $info->data->id;
 
		$provinces = $this->load_model('Provinces');
		$data = $provinces->get_municipies($id);

		$info = (object)[];
		$info->data = $data;
		$info->data_type = "get_municipies";
		
		echo json_encode($info);

	}

}