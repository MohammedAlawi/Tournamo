<?php


if($_SERVER['REQUEST_METHOD'] === 'POST'){
	
	try{
		switch($_POST['type']){
			
			case 'login':
				
				$email = $_POST['email'];
				$pass = md5($_POST['password']);
				
				$db = new MySQLDB();
				$sql  = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'";
				$stmt = $db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->execute();
				$data = $stmt->fetchAll();
				if(count($data) > 0){
					$msg['success'] = 'You are successfully logged in';
					$_SESSION['login'] = true;
					$_SESSION['loginData'] = $data[0];
				} else {
					$msg['error'] = 'Email or Password is wrong!';
				}
					
				break;
			
			case 'updateTaskStatus':
				$task_id = $_POST['task_id'];
				$status = $_POST['status'];
				
				$db = new MySQLDB();
				$sql  = "UPDATE `task` SET done = $status WHERE id = $task_id";
				$stmt = $db->prepare($sql);
				if($stmt->execute())
					echo json_encode(['success' => true, 'msg' => 'The update was successful']);
				else
					echo json_encode(['failed' => true, 'msg' => 'Something went wrong .. Please contact technical support']);
				break;
			
			case 'uploadFile':
				$arr_file_types = [
					'text/plain', 
					'image/png', 
					'image/gif', 
					'image/jpg', 
					'image/jpeg',
					'application/vnd.ms-powerpoint',
					'application/vnd.openxmlformats-officedocument.presentationml.presentation',
					'application/msword',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					'application/vnd.ms-excel',
					'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					'application/pdf',
				];
				if($_FILES != null AND $_FILES['file'] != NULL) {
					if ((in_array($_FILES['file']['type'], $arr_file_types))) {
						$oldFileName = $_FILES['file']['name'];
						$newFileName = md5(time()*rand(111111,999999)).'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
						
						if(move_uploaded_file($_FILES['file']['tmp_name'], PATH_UPLOAD.$newFileName )){
							$db = new MySQLDB();
							$sql  = "INSERT INTO `files`(`user_id`, `file_upload`, `file_name`, `type`) VALUES ('".$_SESSION['loginData']['id']."', '".$oldFileName."', '".$newFileName."', 'upload')";
							$stmt = $db->prepare($sql);
							if($stmt->execute())
								$msg['success'] = 'True';
						}
					} else {
						$msg['error'] = "false type!";
					}
				} else {
					$msg['error'] = "Must Select Files!";
				}
				
				break;
			
			default: break;
			
		}
	} catch(PDOException $e) {
		$msg['error'] = "Error is: " . $e->getMessage();
	}
	if(isset($msg['success']))
		echo $msg['success'];
	
	if(isset($msg['error']))
		echo $msg['error'];
	exit();
}