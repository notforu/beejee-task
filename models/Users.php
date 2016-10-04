<?php

class Users{
	
	//проверяет, есть ли пользователь с заданными данными
	//возвращает юзер айди при удаче, и false при неудаче
	public static function checkUserData($login, $password){
		$db = Db::getConnection();
		$query = 'SELECT * FROM Users WHERE login = :login AND password = :password';
		
		$result = $db->prepare($query);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();
		$user = $result->fetch();
		return $user ? array('id' => $user['id'] , 'is_admin' => $user['is_admin']) : false;
	}
	
	//запоминает сессию пользователя
	public static function auth($userData){
		$_SESSION['user'] = $userData['id'];
		$_SESSION['is_admin'] = $userData['is_admin']; 
	}

	//проверяет наличие сессии. возвращает bool значение
	public static function isGuest(){
		return !isset($_SESSION['user']);
	}
	
	public static function isAdmin(){
		return isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
	}
}
	