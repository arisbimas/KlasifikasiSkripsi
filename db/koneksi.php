<?php 
	
	$db_host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_name = "bagas_db";

	$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);

	if (!$link) {
		die(" gagal terkoneksi ".mysqli_connect_errorno(). " - ".
			mysqli_connect_error() );
		exit();
	} 

 ?>