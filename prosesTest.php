<?php 
	include "dbconfig.php";


	error_reporting(E_ERROR|E_PARSE);
	session_start();
	if(!$_SESSION[valid_login]==1){
	    header('Location:index.php');
	}

	if (isset($_POST['header_new'])) {
		echo '<h4 class="modal-title">Data Fasilitas Baru</h4>';
		unset($_POST['header_new']);
	}

	
 ?>