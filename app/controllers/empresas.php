<?php

Class Empresas extends Controller
{
	public function index()
	{
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
		}
		$DB = Database::newInstance();
		$data['users'] = $DB->read("select * from users");
		$data['groups'] = $DB->read("SELECT * FROM colector_group");
		$data['limit_users'] = $DB->read("select * from users order by id desc limit 8");

		$data['count_trash'] = $DB->read('SELECT * FROM trash_buckets');
		$data['count_trash_full'] = $DB->read("SELECT * FROM trash_buckets where status = 'full'");
		$data['count_trash_empty'] = $DB->read("SELECT * FROM trash_buckets where status = 'empty'");

		$data['count_address'] = $DB->read("SELECT * FROM garbage_address");	
		$data['count_car'] = $DB->read("select * from garbage_cars");
		$data['messages'] = $DB->read("select * from messages order by id desc");
		
		$data['luanda'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' AND status = 'full'");
		$data['uige'] = $DB->read("SELECT * FROM trash_buckets where province = 'Uige' AND status = 'full'");
		$data['huambo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huambo' AND status = 'full'");
		$data['benguela'] = $DB->read("SELECT * FROM trash_buckets where province = 'Benguela' AND status = 'full'");
		$data['zaire'] = $DB->read("SELECT * FROM trash_buckets where province = 'Zaire' AND status = 'full'");
		$data['namibe'] = $DB->read("SELECT * FROM trash_buckets where province = 'Namibe' AND status = 'full'");
		$data['moxico'] = $DB->read("SELECT * FROM trash_buckets where province = 'Moxico' AND status = 'full'");
		$data['cabinda'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cabinda' AND status = 'full'");
		$data['malanje'] = $DB->read("SELECT * FROM trash_buckets where province = 'Malanje' AND status = 'full'");
		$data['lunda_norte'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Norte' AND status = 'full'");
		$data['lunda_sul'] = $DB->read("SELECT * FROM trash_buckets where province = 'Lunda-Sul' AND status = 'full'");
		$data['cunene'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cunene' AND status = 'full'");
		$data['huila'] = $DB->read("SELECT * FROM trash_buckets where province = 'Huila' AND status = 'full'");
		$data['kwanza_norte'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Norte' AND status = 'full'");
		$data['kwanza_sul'] = $DB->read("SELECT * FROM trash_buckets where province = 'Kwanza-Sul' AND status = 'full'");
		$data['bie'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bie' AND status = 'full'");
		$data['bengo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Bengo' AND status = 'full'");
		$data['cuando_cubango'] = $DB->read("SELECT * FROM trash_buckets where province = 'Cuando-Cubango' AND status = 'full'");


		//municipios de luanda
		$data['belas'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Belas' AND status = 'full'");
		$data['cacuaco'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cacuaco' AND status = 'full'");
		$data['cazenga'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Cazenga' AND status = 'full'");
		$data['icolo'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Icolo e Bengo' AND status = 'full'");
		$data['quissama'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Quissama' AND status = 'full'");
		$data['viana'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Viana' AND status = 'full'");
		$data['luandam'] = $DB->read("SELECT * FROM trash_buckets where province = 'Luanda' and municipy = 'Luanda' AND status = 'full'");

		$data['page_title'] = "asasa";
		$this->view("empresas/index", $data);
	}
}