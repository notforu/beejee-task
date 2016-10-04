<?php

class CommentsController{
	
	private static function redirectToRoot(){
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/");
	}
	
	private static function imgTypeToFormat($imgType){
		$arr = array (
			IMAGETYPE_GIF => '.gif',
			IMAGETYPE_JPEG => '.jpeg',
			IMAGETYPE_PNG => '.png',
		);
		return $arr[$imgType];
	}
	
	private static function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function actionIndex($sort = 'date'){
		
		$comments = array();
		$comments = Comments::getCommentList($sort);
		$result = false;
		$name = '';
		$email = '';
		$commentText = '';
		$image = '';
		$uploadfile ='';
		
		if (isset($_POST['submit'])){
			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$commentText = $_POST['text'];
			
			$errors = false;
			
			if (!Validation::emailIsCorrect($email)){
				$errors[] = 'Incorrect email address!';
			}
			
			if (!Validation::nameIsCorrect($name)){
				$errors[] = 'Name must contain more than 5 characters!';
			}
			
			if (!Validation::textIsCorrect($commentText)){
				$errors[] = 'Your comment is empty!';
			}
			$filename = '';
			//checking info about emage
			if( !empty( $_FILES['image']['name'] ) ) {
				
				$filetype = exif_imagetype($_FILES['image']['tmp_name']);
				//if unpermited format
				if ( !in_array($filetype, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG)) ){
					$errors[] = 'Availible image formats: PNG, JPEG, GIF';
				}
				
				//creating path to image
				$uploaddir = ROOT . '/uploads/';
				$filename = self::generateRandomString(12) . self::imgTypeToFormat($filetype);
				$uploadfile = $uploaddir . $filename; 
			}
			
			if ($errors == false){
				//uploading an image to server and resize it
				if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
				    $image = '/uploads/'.$filename;
					ImageManager::resize(ROOT . $image);
				}
				//adding a comment ($image field contains an url)
				$result = Comments::add($name, $email, $commentText, $image);
				self::redirectToRoot();
			}
		}
		
		require_once(ROOT . '/views/comments/index.php');
		
		return true;
	}

	public function actionEdit($commentId){
		
		$comment = Comments::getCommentById($commentId);
		
		$text = $comment['text'];
		$result = false;
		
		if (isset($_POST['submit'])){
			$text = $_POST['text'];
			
			$errors = false;
			
			if (!Validation::textIsCorrect($text)){
				$errors[] = 'Comment is empty';
			}

			if ($errors == false){
				$result = Comments::edit($commentId, $text);
				self::redirectToRoot();
			}
		}
		require_once(ROOT . '/views/comments/edit.php');
		
		return true;
	}
	
	public function actionChangeConfirmation($id){
		
		echo Comments::changeCommentConfirmation($id);
		return true;
		
	}
	
	public function actionValidatePreview(){
		
		$name = '';
		$email = '';
		$text = '';
		
		if (isset($_POST['name'])){
			$name = $_POST['name'];
		}
		
		if (isset($_POST['text'])){
			$text = $_POST['text'];
		}
		
		if (isset($_POST['email'])){
			$email = $_POST['email'];
		}

		
		$errors = false;
		
		if (!Validation::emailIsCorrect($email)){
			$errors[] = 'Incorrect email address!';
		}
		
		if (!Validation::nameIsCorrect($name)){
			$errors[] = 'Name must contain more than 5 characters!';
		}
		
		if (!Validation::textIsCorrect($text)){
			$errors[] = 'Your comment is empty!';
		}
		
		if ($errors == false){
			echo json_encode(array('validated' => 1));
		}
		else{
			print json_encode(array('validated' => 0, 'errors' => $errors));
		}

		return true;		
	}
	
}