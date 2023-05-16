<?php 

Class Login_company extends Controller
{
	public function index()
	{
		$data['page_title'] = "Login_company";
		if(isset($_POST['login_company']))
		{
            show($_POST);
            die;
			$empresa = $this->load_model("empresa");
			$empresa->login_company($_POST);
		}
		
		$this->view("login_company", $data);
	}
}