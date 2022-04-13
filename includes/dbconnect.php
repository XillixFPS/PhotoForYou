<?php
include("config.php");
try
		{
	    	$dbh = new PDO($dsn,$username,$password);
		}
		catch (Exception $e)
		{
	     	die('Erreur : ' . $e->getMessage());
		}
