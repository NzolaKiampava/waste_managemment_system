<?php 


Class Provinces{

	public function get_provinces(){

		$DB = Database::newInstance();
		$query = "select * from provinces order by province asc";
		$data = $DB->read($query);

		return $data;
	}

	public function get_municipies($province){

		$arr['province'] = addslashes($province);

		$DB = Database::getInstance();
		$query = "select * from provinces where province = :province limit 1";
		
		$verify = $DB->read($query,$arr);
		
		if(is_array($verify)){
			$id = $verify[0]->id;

			$check = "select * from municipies where parent = $id order by municipy asc";
			$data = $DB->read($check);
		}

		return $data;
			
	}


	public function get_province($id){

		$id = (int)$id;
		$DB = Database::newInstance();
		$query = "select * from provinces where id = '$id'";
		$data = $DB->read($query);

		return is_array($data) ? $data[0] : false ;
	}

	public function get_municipy($id){

		$arr['id'] = (int)$id;

		$DB = Database::newInstance();
		$query = "select * from municipies where id = :id ";
		$data = $DB->read($query,$arr);

		return is_array($data) ? $data[0] : false ;
	}

	

	
}