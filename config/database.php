<?php
//Database Class
class Database extends PDO
{
	function __construct()
	{
		require 'db_info.php';
		parent:: __construct($dbtype.":host=".$host.";dbname=".$dbname, $dbuser, $dbpassword);
	}
}
