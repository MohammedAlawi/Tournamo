<?php
ob_start();

require_once 'config.php';
require_once 'library/db.php';
require_once 'library/email.php';
require_once 'library/Time.php';
require_once 'library/functions.php';

require_once 'library/posts.php';
require_once 'library/gets.php';



ob_end_flush();