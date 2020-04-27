<?php


class MySQLDB extends PDO {
	
	public function __construct() {
		try{
			parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME.';charset=utf8', DB_USER, DB_PASS);
			$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// always disable emulated prepared statement when using the MySQL driver
			// $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
    }
}