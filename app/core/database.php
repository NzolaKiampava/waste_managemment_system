<?php 

Class Database
{

	/*
	*
	* THIS IS THE DATABASE CLASS
	*
	*/
	public static $con;                                 //static variable

	public function __construct()
	{
		try{

			$string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
			self::$con = new PDO($string,DB_USER,DB_PASS);

		}catch(PDOException $e){
 
			die($e->getMessage());
		}                  
	}

	public static function getInstance()
	{
		if(self::$con){                                 //accessing the original class

			//return self::$con;
		}

		return $instance = new self();                  //return the instance of all this class
	}

	public static function newInstance()
	{
		return $instance = new self(); 
	}

	/*
	*
	* READ FROM DATABASE
	*
	*/
	public function read($query, $data = array())
	{
		$stm = self::$con->prepare($query);
		$result = $stm->execute($data);

		if($result){
			$data = $stm->fetchAll(PDO::FETCH_OBJ);
			if(is_array($data) && count($data) > 0)
			{
				return $data;
			}
		}

		return false;
	}

	/*
	*
	* WRITE FROM DATABASE
	*
	*/
	public function write($query, $data = array())
	{
	
		$stm = self::$con->prepare($query);
		$result = $stm->execute($data);

		if($result){

			return true;
		}

		return false;
	}
}
/*
$db = Database::getInstance();       //instaciating Database class,loading the getinstance static function
$data = $db->read("describe users");
//show($data);
*/