<?php 
	include "dbconfig.php";

  error_reporting(E_ERROR|E_PARSE);
    session_start();
    if(!$_SESSION[valid_login]==1){
        header('Location:index.php');
    }

	if (isset($_POST['id'])) {

		if (isset($_POST['header_Detkec'])) {
			echo '<h4 class="modal-title">Detail Puskesmas Kecamatan</h4>';
			unset($_POST['header_new']);
		}


		if (isset($_POST['body_Detkec'])) {
			$q_dataPus=mysqli_query($con, 'SELECT * FROM tb_puskesmas WHERE id_puskesmas='.$_POST['id'].'');
			$br_dataPus=mysqli_fetch_array($q_dataPus);

			//--------------------------POLIKLINIK-----------------------------
			$q_poli=mysqli_query($con, 'SELECT * FROM tb_poli_detail 
										INNER JOIN tb_poli ON tb_poli_detail.`id_poli`=tb_poli.`id_poli` 
										WHERE tb_poli_detail.`id_puskesmas`= '.$_POST['id'].'');

			
			if (isset($tot_polix)){
                unset($tot_polix);
            }

			$k=1;
			while ( $br_poli=mysqli_fetch_array($q_poli)) {
				 $polixx[$k]=$br_poli['nama_poli'];

				if (isset($tot_polix)) {
                        $tot_polix = "$tot_polix <br> <font color='#ffffff'>: </font> $k. $polixx[$k]";
                } else {
                    $tot_polix=" $k. $polixx[$k]";
                }
                           
                $k++;
			};	


			//------------------------FASILITAS--------------------------------	
			$q_fasili=mysqli_query($con, 'SELECT * FROM tb_fasilitas_detail 
										INNER JOIN tb_fasilitas ON tb_fasilitas_detail.`id_fasilitas`=tb_fasilitas.`id_fasilitas` 
										WHERE tb_fasilitas_detail.`id_puskesmas`= '.$_POST['id'].'');

			if (isset($tot_fasilix)){
                unset($tot_fasilix);
            }
            
            $num_rows_fasili = mysqli_num_rows($q_fasili);
            
            if ($num_rows_fasili==0) {
                $tot_fasilix="-";
            }else{
                $k=1;
                while ( $br_fasili=mysqli_fetch_array($q_fasili)) {
                	$fasilixx[$k]=$br_fasili['nama_fasilitas'];
                	if (isset($tot_fasilix)) {
                        $tot_fasilix = "$tot_fasilix <br> <font color='#ffffff'>: </font> $k. $fasilixx[$k]";
                    } else {
                        $tot_fasilix=" $k. $fasilixx[$k]";
                    }                                     
                    $k++;
                }
            }

            

			//------------------------AGENDA--------------------------------	
			$q_agenda=mysqli_query($con, 'SELECT DATE_FORMAT(tb_agenda_kegiatan.`tgl_agenda`, "%d %M %Y") AS tgl_kegiatan, nama_agenda FROM tb_agenda_kegiatan WHERE tb_agenda_kegiatan.`id_puskesmas`= '.$_POST['id'].'');

			if (isset($tot_agendax)){
                unset($tot_agendax);
            }

            $num_rows_agenda = mysqli_num_rows($q_agenda);
            
            if ($num_rows_agenda==0) {
                $tot_agendax="-";
            }else{
                $k=1;
	            while ($br_agenda=mysqli_fetch_array($q_agenda)) {
					$agendaxx[$k]=$br_agenda['nama_agenda'];
					$tgl_agendaxx[$k]=$br_agenda['tgl_kegiatan'];

					if (isset($tot_agendax)) {
		                $tot_agendax = " $tot_agendax <br> <font color='#ffffff'>: </font> $k. $agendaxx[$k] ";
		            } else {
		                $tot_agendax=" $k. $agendaxx[$k]";
		            }		                           
		            $k++;
				}
            }
			
			echo '
				<div class="text-center" ><h3><b>'.$br_dataPus['nama_puskesmas'].'  </b></h3></div><br>
				<h2  class="text-center"><img src="img/puskesmas/'.$br_dataPus['img'].'" width="450" height="200"></h2><br>
				<div class="table-responsive">
	                  	<table class="table table-hover">
	                        <tbody>
	                               	<tr>
	                                 	<td>Alamat</td>
	                                    <td>: '.$br_dataPus['alamat'].'</td>  
	                                </tr>
	                                <tr>
	                                    <td>Latitude, Longitude</td>
	                                    <td>: '.$br_dataPus['lat'].', '.$br_dataPus['lng'].'</td>       
	                                </tr>
									<tr>
	                                    <td>Telepon</td>
	                                    <td>: '.$br_dataPus['no_hp'].'</td>     
	                                </tr>
	                                <tr>
	                                    <td>Poliklinik</td>
	                                    <td>: '.$tot_polix.'</td>     
	                                </tr>
	                                <tr>
	                                    <td>Fasilitas</td>
	                                    <td>: '.$tot_fasilix.'</td>     
	                                </tr>
	                                <tr>
	                                    <td>Agenda</td>
	                                    <td>: <b> '.$tot_agendax.'</b> 	</td>     
	                                </tr>
	                                <tr>
	                                    <td>Tenaga Medis</td>
	                                    <td>: '.$tot_agendax.'</td>     
	                                </tr>
	                        </tbody>
	                   	</table>
	           	</div>
			';
		}


		if (isset($_POST['footer_Detkec'])) {
			echo '
				 <div class="row">
	                <div class="col-md-12">
	                    <button type="button" class="btn btn-info " data-dismiss="modal">
	                        <i class="glyphicon glyphicon-thumbs-up"></i> <span>Ok</span>
	                    </button>
	                </div> 
	            </div>
			';
		}


		//-----------------------------HAPUS KECAMATAN---------------------------
		if (isset($_POST['header_HapusKec'])) {
			echo '<h4 class="modal-title">Haspus Data Puskesmas Kecamatan</h4>';
		}

		if (isset($_POST['body_ShowHapusKec'])) {
			$q_hapus=mysqli_query($con, 'SELECT * FROM tb_puskesmas WHERE id_puskesmas='.$_POST['id'].'');
			$br_hapus = mysqli_fetch_array($q_hapus);
			echo '<h4>Apakah anda yakin menghapus seluruh data <b> '.$br_hapus['nama_puskesmas'].' </b>? </h4>';

			echo '<input type="hidden" id="id_pus_hapus" value="' . $_POST['id'] . '">';
		}

		if (isset($_POST['body_HapusKec'])) {

			$qPusDel=mysqli_query($con, 'SELECT * FROM tb_puskesmas where id_puskesmas="'. $_POST['id'] .'"');
			$r_qPusDel=mysqli_fetch_array($qPusDel);
			//$filename = '/img/puskesmas/'.$r_qPusDel['img'].'';
			unlink('img/puskesmas/'.$r_qPusDel['img'].'');
			//unlink('img/puskesmas/10450037_1021528167871517_3611875738695631920_o.jpg');

			$q_datapus = mysqli_query($con, 'DELETE FROM tb_puskesmas WHERE id_puskesmas="'. $_POST['id'] .'"');
			$q_dataPoli= mysqli_query($con, 'DELETE FROM tb_poli_detail WHERE id_puskesmas="'. $_POST['id'] .'"');
			$q_dataFasili= mysqli_query($con, 'DELETE FROM tb_fasilitas_detail WHERE id_puskesmas="'. $_POST['id'] .'"');
			$q_dataAgenda=mysqli_query($con, 'DELETE FROM tb_agenda_kegiatan WHERE id_puskesmas="'. $_POST['id'] .'"');


			
			

			echo '
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  				<strong>Data berhasil dihapus!</strong>
				</div>	
			';
?>
			<script>
				$("#pus_kecamatan").load("admin_home_PusKecData.php");
			</script>
<?php
		}


		if (isset($_POST['footer_ShowHapusKec'])) {
			echo '
				<div class="row">
	                <div class="col-md-6">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> 
	                        <i class="glyphicon glyphicon-remove"></i> <span>Close</span>
	                    </button> 
	                </div>

	                <div class="col-md-6">
	                    <button  onclick="HapusKec(id_pus_hapus.value)"  type="button" 
	                        class="btn btn-danger">
	                        <i class="glyphicon glyphicon-trash"></i> <span>Hapus</span>
	                    </button>
	                </div> 
	            </div>
			';
		}

		if (isset($_POST['footer_HapusKec'])) {
			echo '
				<div class="row">
	                <div class="col-md-6">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> 
	                        <i class="glyphicon glyphicon-remove"></i> <span>Close</span>
	                    </button> 
	                </div>
	            </div>
			';
		}

	}


 ?>