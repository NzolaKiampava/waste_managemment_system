<?php 

Class Register extends Controller
{
	public function index()
	{
		$data['page_title'] = "Login";
		if(isset($_POST['login']))
		{
			$user = $this->load_model("user");
			$user->login($_POST);
		}
		if(isset($_POST['recover_password']))
		{
			$user = $this->load_model("user");
			$user->recover_password($_POST);
		}
		if(isset($_POST['signup']))
		{
			//show($_POST);
			$user = $this->load_model("user");
			$user->signup($_POST);
		}
		$this->view("register", $data);
	}
}