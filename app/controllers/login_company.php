<?php 

Class Login_company extends Controller
{
	public function index()
	{
		$data['page_title'] = "Login_company";
		if(isset($_POST['login_company']))
		{
			$infoempresa = $this->load_model("infoempresa");
			$infoempresa->login_company($_POST);
		}
		
		$this->view("login_company", $data);
	}
}