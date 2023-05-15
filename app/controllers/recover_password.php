<?php 

Class Recover_password extends Controller
{
	public function index()
	{
		$data['page_title'] = "Login";
		if(isset($_POST['recover_password']))
		{
			//show($_POST);
			$user = $this->load_model("user");
			$user->recover_password($_POST);
		}
		$this->view("recover_password", $data);
	}
}