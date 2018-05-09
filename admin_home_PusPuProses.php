<?php 
	include "dbconfig.php";

	if (isset($_POST['id'])) {

		if (isset($_POST['header_DetPu'])) {
			echo '<h4 class="modal-title">Detail Puskesmas Pembantu</h4>';
		}

		if (isset($_POST['body_DetPu'])) {
			$q_dataPus=mysqli_query($con, 'SELECT 
                        			tb_puskesmas.id_puskesmas, 
                        			tb_puskesmas.nama_puskesmas,
                       				tb_puskesmas.alamat, 
                        			tb_puskesmas.no_hp,
                        			tb_puskesmas.lng,
                        			tb_puskesmas.lat,
                        			tb_puskesmas.deskripsi,
                        			tb_puskesmas.img
                    			FROM tb_puskesmas_pembantu
                   				INNER JOIN tb_puskesmas 
                    			ON tb_puskesmas_pembantu.id_pp = tb_puskesmas.id_puskesmas
                    			WHERE tb_puskesmas_pembantu.`id_pp`= '.$_POST['id'].'') or die (mysqli_error());
			$br_dataPus=mysqli_fetch_array($q_dataPus);

			$q_pusKec=mysqli_query($con, 'SELECT * FROM tb_puskesmas_pembantu
										INNER JOIN tb_puskesmas ON tb_puskesmas_pembantu.`id_puskesmas`=tb_puskesmas.`id_puskesmas` 
										WHERE tb_puskesmas_pembantu.`id_pp`= '.$_POST['id'].'');
			$br_pusKec=mysqli_fetch_array($q_pusKec);

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
	                                    <td>Puskemas Kecamatan</td>
	                                    <td>: '.$br_pusKec['nama_puskesmas'].'</td>     
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


		if (isset($_POST['footer_DetPu'])) {
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

		if (isset($_POST['header_HapusPu'])) {
			echo '<h4 class="modal-title">Haspus Data Puskesmas Pembantu</h4>';
		}

		if (isset($_POST['body_ShowHapusPu'])) {
			$q_hapus=mysqli_query($con, 'SELECT * FROM tb_puskesmas WHERE id_puskesmas='.$_POST['id'].'');
			$br_hapus = mysqli_fetch_array($q_hapus);
			echo '<h4>Apakah anda yakin menghapus seluruh data <b> '.$br_hapus['nama_puskesmas'].' </b>? </h4>';

			echo '<input type="hidden" id="id_pus_hapus" value="' . $_POST['id'] . '">';
		}


		if (isset($_POST['body_HapusPu'])) {

			$q_datapus = mysqli_query($con, 'DELETE FROM tb_puskesmas WHERE id_puskesmas="'. $_POST['id'] .'"');
			$q_dataPoli= mysqli_query($con, 'DELETE FROM tb_poli_detail WHERE id_puskesmas="'. $_POST['id'] .'"');
			$q_dataFasili= mysqli_query($con, 'DELETE FROM tb_fasilitas_detail WHERE id_puskesmas="'. $_POST['id'] .'"');
			$q_dataAgenda=mysqli_query($con, 'DELETE FROM tb_agenda_kegiatan WHERE id_puskesmas="'. $_POST['id'] .'"');
			$q_pembantu=mysqli_query($con, 'DELETE FROM tb_puskesmas_pembantu WHERE id_pp="'. $_POST['id'] .'"');
			echo '
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  				<strong>Data berhasil dihapus!</strong>
				</div>	
			';

			?>
				<script>
					$("#pus_pembantu").load("admin_home_PusPuData.php");
				</script>
			<?php
		}

		if (isset($_POST['footer_ShowHapusPu'])) {
			echo '
				<div class="row">
	                <div class="col-md-6">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> 
	                        <i class="glyphicon glyphicon-remove"></i> <span>Close</span>
	                    </button> 
	                </div>

	                <div class="col-md-6">
	                    <button  onclick="HapusPu(id_pus_hapus.value)"  type="button" 
	                        class="btn btn-danger">
	                        <i class="glyphicon glyphicon-trash"></i> <span>Hapus</span>
	                    </button>
	                </div> 
	            </div>
			';
		}

		if (isset($_POST['footer_HapusPu'])) {
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