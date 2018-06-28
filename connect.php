<?php

    $dbname = "legibrat_alfiempesa";
	$dbhost = "localhost";
	$dbuser = "legibrat_alfred";
	$dbpass = "xvLGd@qJ8&Db";

	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//$connection = mysqli_select_db($conn,$dbname);
    $response = "";
    if ($connection) {
        //$response = "success";
    }else{
        //$response = "db fail";
    }

?>