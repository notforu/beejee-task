<?php

class Comments{
	
	const SHOW_BY_DEFAULT = 6;
	
	public static function getCommentList($sort){
		
		$db = Db::getConnection();
		
		$result = array();
		
		//if user is administrator , show all comments
		//otherwise show only confirmed comments
		$confirmed = Users::isAdmin() ? '' : ' WHERE confirmed = 1';
		$commentList = $db->query('SELECT * FROM Comments'.$confirmed.' ORDER BY '.$sort.' DESC');
		$commentList->setFetchMode(PDO::FETCH_ASSOC);
		
		$i = 0;
		while($row = $commentList->fetch()){
			$result[$i]['id'] = $row['id'];
			$result[$i]['name'] = $row['name'];
			$result[$i]['email'] = $row['email'];
			$result[$i]['text'] = $row['text'];
			$result[$i]['date'] = $row['date'];
			$result[$i]['image'] = $row['image'];
			$result[$i]['was_edited'] = $row['was_edited'];
			$result[$i]['edit_date'] = $row['edit_date'];
			$result[$i]['confirmed'] = $row['confirmed'];

			$i++;
		}
		
		return $result;
	}
	
	public static function getCommentById($id){
		$id = intval($id);
		
		if ($id){
			$db = Db::getConnection();

			$result = $db->query('SELECT * from Comments WHERE id = ' . $id);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			
			return $result->fetch();
		}
	}
	
	public static function add($name, $email, $commentText, $image){
		$db = DB::getConnection();
		
		$query = 'INSERT INTO Comments (name, email, text, image, date) VALUES (:name, :email, :text, :image, :date)';
		$result = $db->prepare($query);
		
		
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':text', $commentText, PDO::PARAM_STR);
		$result->bindParam(':image', $image, PDO::PARAM_LOB);
		$date = date('Y-m-d H:i:s');
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		
		return $result->execute();
	}
	
	public static function edit($id, $text){
		$db = Db::getConnection();
		
		$query = 'UPDATE Comments SET text = :text, was_edited = :was_edited, edit_date = :edit_date  WHERE id = :id';
		
		$result = $db->prepare($query);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':text', $text, PDO::PARAM_STR);
		$was_edited = true;
		$result->bindParam(':was_edited', $was_edited, PDO::PARAM_BOOL);
		$date = date('Y-m-d H:i:s');
		$result->bindParam(':edit_date', $date, PDO::PARAM_STR);
		return $result->execute();
	}

	public static function changeCommentConfirmation($id){
		$db = Db::getConnection();
		
		$query = 'UPDATE Comments SET confirmed = NOT confirmed WHERE id = :id';
		
		$result = $db->prepare($query);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->execute();
		
		$result = $db->query("SELECT confirmed FROM Comments WHERE id=".$id);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();
		return $row['confirmed'];
	}
	
}
