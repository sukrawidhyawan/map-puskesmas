<?php
	session_start();

	$user = $_POST['usrname'];
 	$password = $_POST['psw'];
	include "dbconfig.php";

	$query="SELECT * FROM tb_login WHERE nama_user ='$user' and password='$password '";
	$result=mysqli_query($con, $query);
	$data=mysqli_fetch_array($result);

	if($data["jabatan"]=='admin') {
		
			//$_SESSION['masuk'] = $_POST['user'];
			$_SESSION['valid_login']=1;
			header ('Location: admin_home.php');
			$_SESSION['id_log']=$data["id_login"];
			$_SESSION['user']=$data["username"];

	}elseif ($data["jabatan"]=='puskesmas') {
			header ('Location: pemilik_home.php');
			$_SESSION['valid_login']=1;
			$_SESSION['id_log']=$data["id_login"];
			$_SESSION['user']=$data["username"];

	}else{
			$_SESSION['eror']='eror';
			header ('Location: index.php');		
	}
		
?>