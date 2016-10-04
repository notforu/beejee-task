<?php

class Validation{
	
	public static function nameIsCorrect($name){
		return strlen($name) > 2;
	}
	
	public static function textIsCorrect($text){
		return strlen($text) > 0;
	}
	
	public static function emailIsCorrect($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
}
