<?php

class User{
	// Constantes
	const USER = 'admin';
	const FILE = '9a4fda645d1c0ec686e2bb8f6b843e8f.user';
	const FILEGOOGLE = '4d576e9893e22ef962c9d95c13c521f7.google';

	private $user;
	private $pass;

	// SETERS e GETERS
	public function setUser($user){
		$this->user = $user;
	}
	public function setPass($pass){
		$this->pass = $pass;
	}
	public function getUser(){
		return $this->user;
	}
	public function getPass(){
		return $this->pass;
	}

	// Função de login
	public function login(){
		$handle = fopen(self::FILE, 'rb') or die('Cannot open file');
		$data = fread($handle,filesize(self::FILE));
		fclose($handle);

		if ($this->getUser() == self::USER && md5($this->getPass()) == $data) :
			$_SESSION['user'] = $this->getUser();
			$_SESSION['login'] = true;
			return true;
		else:
			return false;
		endif;
	}

	public static function logout() {
		if(isset($_SESSION['login'])):
			unset($_SESSION['login']);
			session_destroy();
		endif;
		header("Location: index.html");		
	}

	// public function first(){
	// 	$handle = fopen(self::FILE, 'wb') or die('Cannot open file');
	// 	fwrite($handle, md5('flausino'));
	// 	fclose($handle);
	// }

	public function writePass($dataOld, $dataNew){
		$handle = fopen(self::FILE, 'rb') or die('Cannot open file');
		$data = fread($handle,filesize(self::FILE));
		fclose($handle);

		if(md5($dataOld) === $data):
			$handle = fopen(self::FILE, 'wb') or die('Cannot open file');
			fwrite($handle, md5($dataNew));
			fclose($handle);
			return true;
		else:
			return false;
		endif;
	}

	public function writeGoogle($data){
		if($data):
			$handle = fopen(self::FILEGOOGLE, 'wb') or die('Cannot open file');
			fwrite($handle, $data);
			fclose($handle);
			return true;
		else:
			return false;
		endif;
	}
}

?>
