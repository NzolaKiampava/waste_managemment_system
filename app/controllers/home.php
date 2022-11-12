<?php

Class Home extends Controller
{
		
	public function index()
	{

		/*
		$User = $this->load_model('User');
		$image_class = $this->load_model('Image');
		$user_data = $User->check_login();
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		*/

		$data['page_title'] = "Home";
		$this->view("index", $data);
	}



}