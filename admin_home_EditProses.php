<?php 
	include "dbconfig.php";
    switch ($_GET['action']) {
        case 'jsnPus':
            $data = json_decode(file_get_contents("php://input"));
            echo ''.$data.'';
            break;
        case 'get_poli':
        	$q_poli = 'SELECT id_det_poli, id_poli FROM tb_poli_detail where id_puskesmas='.$_GET['idx'].'';
        	$sql_poli  = mysqli_query($con, $q_poli);
        	$num_rows_poli = mysqli_num_rows($sql_poli);

		    $data = array();
		    if ($num_rows_poli==0) {
		    	$data[]=0;
		    }else{
		    	while($row=mysqli_fetch_array($sql_poli)) {
			        $data[] = $row;
			    }
		    } 
		    echo json_encode($data);
        	break;

        case 'get_pusfasili':
        	$query = 'SELECT id_det_fasilitas, id_fasilitas FROM tb_fasilitas_detail where id_puskesmas='.$_GET['idx'].'';
		    $sql  = mysqli_query($con, $query);
		    $nr_poli = mysqli_num_rows($sql);
		    $data = array();

		    if ($nr_poli==0) {
		    	$data[]=0;
		    }else{
		    	while($row=mysqli_fetch_array($sql)) {
			        $data[] = $row;
			    }
		    }

            //$j=0;
           //while ($j < 4) {
             //         $q=mysql_query('UPDATE tb_fasilitas_detail set id_fasilitas='.$data[$j]['id_fasilitas'].' WHERE id_det_fasilitas='.$data[$j]['id_det_fasilitas'].'');
               //        echo ''.$data[$j]['id_fasilitas'].'';
                 //       $j=$j+1;
                   //}
            echo json_encode($data);
            //echo '<br> '.$j.' asasa' ;	
        	break;
        case 'updateFasili':
        		$data = json_decode(file_get_contents("php://input"));
                $jf=$_GET['jumf'];
                $jum=count($data);
                $id=$_GET['id'];
                if ($jf==$jum) {
                    foreach($data as $k => $v){
                        $query = "UPDATE tb_fasilitas_detail set id_fasilitas = '".$v->id_fasilitas."' where id_det_fasilitas = '".$v->id_det_fasilitas."'";
                        mysqli_query($con, $query);
                    }
                }else if($jum>$jf){
                    $j=0;
                    $sql_id=  mysqli_query($con, 'SELECT MAX(id_det_fasilitas)+1 AS id_det FROM tb_fasilitas_detail');
                    $br_det = mysqli_fetch_array($sql_id);
                    $id_det = $br_det['id_det'];

                    foreach($data as $k => $v){
                        if ($j < $jf) {
                            $query = "UPDATE tb_fasilitas_detail set id_fasilitas = '".$v->id_fasilitas."' where id_det_fasilitas = '".$v->id_det_fasilitas."'";
                            mysqli_query($con, $query);
                        }elseif ($j>=$jf) {
                            $query = "INSERT INTO tb_fasilitas_detail(id_det_fasilitas, id_puskesmas, id_fasilitas) 
                                        VALUES ('".$id_det."','".$id."','".$v->id_fasilitas."')";
                            mysqli_query($con, $query);
                            $id_det++;
                        }
                        $j++;                       
                    }
                }elseif ($jum<$jf) {
                    $j=0;
                    $i=0;
                    foreach($data as $k => $v){
                            $query = "UPDATE tb_fasilitas_detail set id_fasilitas = '".$v->id_fasilitas."' where id_det_fasilitas = '".$v->id_det_fasilitas."'";
                            mysqli_query($con, $query);
                        $j++;
                    }

                    $sql_id=  mysqli_query($con, 'SELECT * FROM tb_fasilitas_detail WHERE id_puskesmas='.$id.'');
                    while ( $br_det=mysqli_fetch_array($sql_id)) {
                        if ($i>=$j) {
                            $q_datapus = mysqli_query($con, 'DELETE FROM tb_fasilitas_detail WHERE id_det_fasilitas="'. $br_det['id_det_fasilitas'] .'"');
                        }
                        $i++;
                    }
                }
                echo  ''.$jf.''.$jum.''.$id.'';
        	break;
        case 'updatePoli':
        		$data = json_decode(file_get_contents("php://input"));
                $jp=$_GET['jump'];
                $jum=count($data);
                $id=$_GET['id'];

                if ($jp==$jum) {
                    foreach($data as $k => $v){
                        $query = "UPDATE tb_poli_detail set id_poli = '".$v->id_poli."' where id_det_poli = '".$v->id_det_poli."'";
                        mysqli_query($con, $query);
                    }
                }else if($jum>$jp){
                    $j=0;
                    $sql_id=  mysqli_query($con,'SELECT MAX(id_det_poli)+1 AS id_det FROM tb_poli_detail');
                    $br_det = mysqli_fetch_array($sql_id);
                    $id_det = $br_det['id_det'];

                    foreach($data as $k => $v){
                        if ($j < $jp) {
                            $query = "UPDATE tb_poli_detail set id_poli = '".$v->id_poli."' where id_det_poli = '".$v->id_det_poli."'";
                            mysqli_query($con, $query);
                        }elseif ($j>=$jp) {
                            $query = "INSERT INTO tb_poli_detail(id_det_poli, id_puskesmas, id_poli) 
                                        VALUES ('".$id_det."','".$id."','".$v->id_poli."')";
                            mysqli_query($con, $query);
                            $id_det++;
                        }
                        $j++;                       
                    }
                }elseif ($jum<$jp) {
                    $j=0;
                    $i=0;
                    foreach($data as $k => $v){
                            $query = "UPDATE tb_poli_detail set id_poli = '".$v->id_poli."' where id_det_poli = '".$v->id_det_poli."'";
                            mysqli_query($con, $query);
                        $j++;
                    }

                    $sql_id=  mysqli_query($con, 'SELECT * FROM tb_poli_detail WHERE id_puskesmas='.$id.'');
                    while ( $br_det=mysqli_fetch_array($sql_id)) {
                        if ($i>=$j) {
                            $q_datapus = mysqli_query($con, 'DELETE FROM tb_poli_detail WHERE id_det_poli="'. $br_det['id_det_poli'] .'"');
                        }
                        $i++;
                    }
                }
               echo  ''.$jp.''.$jum.''.$id.'';
        	break;
        case 'updates':
            $filelama='img/puskesmas/17169945.jpg';
            if (file_exists('img/puskesmas/17169945.jpg')) {
               unlink('img/puskesmas/17169945.jpg');
            }


            $fileName = $_FILES['fotoPus']['name'];  
            $fileSize = $_FILES['fotoPus']['size'];  
            $fileError = $_FILES['fotoPus']['error'];

            $namaBaru=$_POST['id_puzz'].'foto_'.$_POST['nama_pus'].'_'.$fileName;

            if($fileSize > 0 || $fileError == 0){ 
                unlink('img/puskesmas/'.$r_qPusDel['img'].'');
                $move = move_uploaded_file($_FILES['fotoPus']['tmp_name'], 'img/puskesmas/'.$namaBaru);  
                $up_img=mysqli_query($con, 'UPDATE tb_puskesmas set img="'.$namaBaru.'" WHERE id_puskesmas="'.$_POST['id_puzz'].'" ') ;
            }else{  
            echo "Gagal mengupload file:..... ".$fileError;  
            }


        	$qu=mysqli_query($con, 'UPDATE tb_puskesmas SET nama_puskesmas="'.$_POST['nama_pus'].'", alamat="'.$_POST['alamat_pus'].'" , no_hp="'.$_POST['telepon_pus'].'", lat="'.$_POST['lat_pus'].'", lng="'.$_POST['lng_pus'].'", id_jns_puskesmas="'.$_POST['jns_puskemass'].'", deskripsi= "'.$_POST['deskrip_pus'].'"
        		WHERE id_puskesmas="'.$_POST['id_puzz'].'" ');


        	 header('Location:admin_home_edit.php?xx='.$_POST['id_puzz'].'&&yes=1');
        	break;
    }
    
 ?>