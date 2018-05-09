<?php 
	include "dbconfig.php";

	$sql_idx=  mysqli_query($con, 'SELECT MAX(id_puskesmas)+1 AS id_baru FROM tb_puskesmas');
	$br_idx = mysqli_fetch_array($sql_idx);
	$idxssww= $br_idx['id_baru'];

	
	switch ($_GET['action']) {
		case 'insert_jsnPus':
			$data = json_decode(file_get_contents("php://input"));
			echo ''.$data.'';
			break;

		case 'insert_fasili':
			$data = json_decode(file_get_contents("php://input"));
			$sql_id=  mysqli_query($con, 'SELECT MAX(id_det_fasilitas)+1 AS id_det FROM tb_fasilitas_detail');
			$br_det = mysqli_fetch_array($sql_id);
			$id_det = $br_det['id_det'];

			foreach ($data as $key => $v) {
				$query = "INSERT INTO tb_fasilitas_detail(id_det_fasilitas, id_puskesmas, id_fasilitas) 
							VALUES ('".$id_det."','".$idxssww."','".$v->fasilicc."')";
	            mysqli_query($con, $query);
	            $id_det++;
        	};
        	echo ''.$id_det.'';
			break;

		case 'insert_poli':
			$data = json_decode(file_get_contents("php://input"));
			$sql_id=  mysqli_query($con, 'SELECT MAX(id_det_poli)+1 AS id_det_p FROM tb_poli_detail');
			$br_det = mysqli_fetch_array($sql_id);
			$id_det = $br_det['id_det_p'];

			foreach ($data as $key => $v) {
				$query = "INSERT INTO tb_poli_detail(id_det_poli, id_poli, id_puskesmas) 
						VALUES ('".$id_det."','".$v->policc."','".$idxssww."')";
		        mysqli_query($con, $query);
		        $id_det++;
	        };			
			break;
		
		case 'insert':
			$sql_id=  mysqli_query($con, 'SELECT MAX(id_puskesmas)+1 AS id_baru FROM tb_puskesmas');
			$br_id = mysqli_fetch_array($sql_id);
			$idxss= $br_id['id_baru'];

			//file upload.php  

			$fileName = $_FILES['fotoPus']['name'];  
			$fileSize = $_FILES['fotoPus']['size'];  
			$fileError = $_FILES['fotoPus']['error'];

			$namaBaru=$idxss.'foto_'.$_POST['nama_pus'].'_'.$fileName;

			if($fileSize > 0 || $fileError == 0){  
				$move = move_uploaded_file($_FILES['fotoPus']['tmp_name'], 'img/puskesmas/'.$namaBaru);  
			}else{  
			echo "Gagal mengupload file:..... ".$fileError;  
			}  



			$query = "INSERT INTO tb_puskesmas(id_puskesmas, nama_puskesmas,alamat, no_hp, lat, lng, id_jns_puskesmas, deskripsi, img) 
					  VALUES ('".$idxss."','".$_POST['nama_pus']."','".$_POST['alamat_pus']."','".$_POST['telepon_pus']."' , '".$_POST['lat_pus']."','".$_POST['lng_pus']."','".$_POST['jns_puskemass']."','".$_POST['deskrip_pus']."','".$namaBaru."' )";
	        mysqli_query($con, $query);

	        $jnsww=$_POST['jns_puskemass'];
	        if ($jnsww=='2') {
	        	
	        	$q="INSERT INTO tb_puskesmas_pembantu (id_pp, id_puskesmas) VALUES ('".$idxss."', '".$_POST['PuskecN']."')";
	        	mysqli_query($con, $q);
	        	
	        }
	        header('Location:admin_puskesmas_baru.php?jj='.$_POST['nama_pus'].'');
			break;
	};

 ?>