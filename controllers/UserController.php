<?php

class UserController{
	
	private static function redirectToRoot(){
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/");
	}
	
	public function actionLogin(){
		$login = '';
		$password = '';
		
		if (isset($_POST['submit'])){
			$login = $_POST['login'];
			$password = $_POST['password'];
			
			$errors = false;
			
			$userData = Users::checkUserData($login, $password);
			
			if ($userData == false){
				$errors[] = "Can't find such user";
			}
			else{
				print_r($userData);
				Users::auth($userData);
				self::redirectToRoot();
			}
		}
		
		require_once(ROOT . '/views/user/login.php');
		return true;
	}
	
	public function actionLogout(){
		unset($_SESSION['user']);
		unset($_SESSION['is_admin']);
		self::redirectToRoot();
		return true;
	}
	
}
