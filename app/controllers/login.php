<?php 

Class Login extends Controller
{
	public function index()
	{
		$data['page_title'] = "Login";
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			//show($_POST);
			$user = $this->load_model("user");
			$user->login($_POST);
		}
		$this->view("login", $data);
	}
}