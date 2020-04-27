<?php


if($_SERVER['REQUEST_METHOD'] === 'GET'){
	
	if(count($_GET) == 0 AND $_GET['site'] == null)
		header('location: ?site=Home');
	
	if(isset($_GET['site'])) {
		$site = @$_GET['site'];
		
		if(isset($site)) {
			if (file_exists("viewer/$site.php")) {
				if(strtolower($site) == 'login'){
					include_once "viewer/$site.php";
				} else {
					include_once 'viewer/header.php';
					include_once "viewer/$site.php";
					include_once 'viewer/footer.php';
				}
			} else {
				if($_SESSION['login'] == true){
					include_once 'viewer/header.php';
					include_once 'viewer/404Login.php';
					include_once 'viewer/footer.php';
				} else {
					include_once 'viewer/404.php';
				}
			}
		} else {
			include_once 'viewer/header.php';
			include_once 'viewer/home.php';
			include_once 'viewer/footer.php';
		}
		exit();
	}
	
	if(isset($_GET['ajax'])) {
		$db = new MySQLDB();
		$sql  = "SELECT * FROM `task` WHERE `user_id` = '".$_SESSION['loginData']['id']."' AND `id` = '".$_GET['id']."'";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$dataTask = $stmt->fetch();
		
		$sql  = "SELECT * FROM `users` WHERE id = '".$dataTask['from_id']."';";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$dataUser = $stmt->fetch();
		
		// print_r($dataTask);
		// print_r($dataUser);
		
		echo json_encode([
			'title' 	=> $dataTask['title'],
			'from' 		=> $dataUser['name'],
			'desc' 		=> $dataTask['description'],
			'time' 		=> date('Y-m-d H:i', $dataTask['time']),
		]);
	}
	
	if(isset($_GET['download'])) {
		
		// print_r($_SERVER);
		// echo urldecode($_GET['download']);
		downloadFile(urldecode($_GET['download']), $_GET['dName']);
	}
}