<?php

// use PDO connection
try
{
	//data source name
	$dsn = "mysql:host=localhost;dbname=company";

	$pdo = new PDO($dsn,"root","");

}

catch(PDOException $e)
{
	echo "Error" .$e->getMessage();
		die();

}