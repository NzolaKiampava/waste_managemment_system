<?php

Class App
{
	protected $controller = "home";
	protected $method = "index";
	protected $params;

	public function __construct()
	{

		$url = $this->parseURL();
		$url[0] = str_replace("-", "_", $url[0]);
		//show($url);

		//verifyiing if file controller exists
		if (file_exists("../app/controllers/" . strtolower($url[0]). ".php")) 
		{
			$this->controller = strtolower($url[0]);
			unset($url[0]);                                                 //we dont need anymore $url 
		}

		require "../app/controllers/" . $this->controller . ".php";
		$this->controller = new $this->controller;

		if(isset($url[1]))                                                  //if exists url[1]
		{ 
			$url[1] = strtolower($url[1]);
			if(method_exists($this->controller, $url[1]))                   //if exists this method on url[1]
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = (count($url) > 0) ? $url : ["home"];
		//show("");
		call_user_func_array([$this->controller,$this->method], $this->params);           //call and run the function and method on the home.php
		//show(array_values($url));                    //start counting from 0

	}

	private function parseURL()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : "home";
		return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));             //explode(): take all string in the url in form of array - convert the string into array, trim(): will clean all blank space, but if we put trim($url, "/") it going look for especific character to clean
	}
}

