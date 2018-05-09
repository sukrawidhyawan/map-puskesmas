<?php 
	include "dbconfig.php";

error_reporting(E_ERROR|E_PARSE);
session_start();
if(!$_SESSION[valid_login]==1){
    header('Location:index.php');
}

	if (isset($_POST['header_new'])) {
		echo '<h4 class="modal-title">Data Poliklinik Baru</h4>';
		unset($_POST['header_new']);
	}

	if (isset($_POST['new'])) { 
		$q_agenda=  mysqli_query($con, 'SELECT MAX(id_agenda)+1 AS id_baru FROM tb_agenda_kegiatan');
		$br_id_agenda = mysqli_fetch_array($q_agenda);

		$sql1 = "INSERT INTO tb_agenda_kegiatan (id_agenda, nama_agenda, id_puskesmas, tgl_agenda, status_agenda) VALUES ('$br_id_agenda[id_baru]', '$_POST[namaAgenda]' , '$_POST[idPUs]', '$_POST[tglAgenda]', 1)"; 
		mysqli_query($con, $sql1)or die(mysqli_error());
?> 
			
			<script>
				$("#tabel_data_agenda").load("admin_agenda_data.php");
			</script>

<?php
	
	}

	if (isset($_POST['show_new'])) {
		if(isset($_POST['new'])){
			echo '<notif_sukses>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  				Data  <strong> '.$_POST['namaAgenda'].' </strong> berhasail di simpan !"
					</div>	
			</notif_sukses>';
		}
		echo '	
			<div   id="add_namAgenda_form_container" class="form-group">
		         <label class="control-label"> Nama Agenda</label> <label class="control-label" id="add_Labelagenda_msg"></label>
		        <input type="text" class="form-control" id="nam_agenda" required>
		    </div>
		                                   
		    <div  id="add_tglAgenda_form_container" class="form-group">
		        <label class="control-label">Tanggal Adenda</label> <label class="control-label" id="add_tglAgenda_msg"></label>
		        <input type="text" class="form-control" id="tgl_agenda"  placeholder="YYYY-MM-DD">
		    </div>

		    <div class="form-group">
		        <label class="control-label">Nama Puskesmas</label>
		        <select class="form-control" id="pusAgenda" name="nama_pusnya" >';

		        $pusxx=mysqli_query($con, "SELECT * FROM tb_puskesmas ") or die (mysqli_error()); 
                $yy=0;
                while ($row_pusx = mysqli_fetch_assoc($pusxx)) { 
                    $id_pus=$row_pusx['id_puskesmas'];
                    $nama_pus=$row_pusx['nama_puskesmas'];
                    echo "<option value = $id_pus> $nama_pus </option>"; 
                    $yy++; 
                }
		        
		    echo'</div>';
		unset($_POST['show_new']);
		unset($_POST['new']);
	}


	
	if (isset($_POST['footer_new'])) {
		echo '
			<div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> 
                        <i class="glyphicon glyphicon-remove"></i> <span>Close</span>
                    </button> 
                </div>

                <div class="col-md-6">
                    <button  onclick="AgendaBaru(nam_agenda.value, tgl_agenda.value, pusAgenda.value)"  type="button" 
                        class="btn btn-info">
                        <i class="glyphicon glyphicon-floppy-disk"></i> <span>Save</span>
                     </button>
                </div> 
            </div>
		';
	}


	if (isset($_POST['id'])) {

		if (isset($_POST['updatex'])) {
	    	$result2=mysqli_query($con, 'UPDATE tb_agenda_kegiatan SET nama_agenda="'.$_POST['namaAgenda'].'", id_puskesmas="'.$_POST['id_PUs'].'"	, tgl_agenda="'.$_POST['tgl_agenda'].'"	WHERE id_agenda="'.$_POST['id'].'"') or die (mysqli_error());

	    	$q_dataPoli = mysqli_query($con, 'SELECT * FROM tb_agenda_kegiatan WHERE id_agenda="'.$_POST['id'].'"');
			$br = mysqli_fetch_array($q_dataPoli);

			?>
			<notif_sukses>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  				<?php  echo "Data  <strong> $br[nama_agenda] </strong> berhasail diperbaharui !";?> 
					</div>	
			</notif_sukses>

			<script>
				$("#tabel_data_agenda").load("admin_agenda_data.php");
			</script>

			<?php
	    }

		if (isset($_POST['header_edit'])) {
	    	echo '<h4 class="modal-title">Edit Data Agenda</h4>';
	    	unset($_POST['header']);
	    }


	    if (isset($_POST['footer_edit'])) {
			echo '
				<div class="row">
	                <div class="col-md-6">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> 
	                        <i class="glyphicon glyphicon-remove"></i> <span>Close</span>
	                    </button> 
	                </div>

	                <div class="col-md-6">
	                    <button  onclick="EditAgenda(id_agendaxx.value, nam_agenda.value, tgl_agenda.value, pusAgenda.value )"  type="button" 
	                        class="btn btn-info">
	                        <i class="glyphicon glyphicon-floppy-disk"></i> <span>Save</span>
	                    </button>
	                </div> 
	            </div>
			';
		}


		 if (isset($_POST['show_edit'])) {
	    	$q_dataAgenda = mysqli_query($con, 'SELECT * FROM tb_agenda_kegiatan WHERE id_agenda="'.$_POST['id'].'"');
			$br = mysqli_fetch_array($q_dataAgenda);

			echo '
				<input type="hidden" id="id_agendaxx" value="' . $br['id_agenda'] . '">	
				<div   id="add_namAgenda_form_container" class="form-group">
			         <label class="control-label"> Nama Agenda</label> <label class="control-label" id="add_Labelagenda_msg"></label>
			        <input type="text" class="form-control" id="nam_agenda" value ='.$br['nama_agenda'].' required>
			    </div>
			                                   
			    <div  id="add_tglAgenda_form_container" class="form-group">
			        <label class="control-label">Tanggal Adenda</label> <label class="control-label" id="add_tglAgenda_msg"></label>
			        <input type="text" class="form-control" id="tgl_agenda" value ='.$br['tgl_agenda'].' required>
			    </div>

			    <div class="form-group">
			        <label class="control-label">Nama Puskesmas</label>
			        <select class="form-control" id="pusAgenda" name="nama_pusnya">';

			        $pusxx=mysqli_query($con, "SELECT * FROM tb_puskesmas ") or die (mysqli_error()); 
	                $yy=0;
	                while ($row_pusx = mysqli_fetch_assoc($pusxx)) { 
	                    $id_pus=$row_pusx['id_puskesmas'];
	                    $nama_pus=$row_pusx['nama_puskesmas'];
	                    echo "<option value = $id_pus> $nama_pus </option>"; 
	                    $yy++; 
	                }

	            echo'</div>';
			unset($_POST['show_edit']);
	    }


	    //---------------------------------------------------------HAPUS-----------------
	
		if (isset($_POST['header_hapus'])) {
			echo '<h4 class="modal-title">Hapus Data Agenda</h4>';
		}


		if (isset($_POST['footer_hapus'])) {
			echo '
				<div class="row">
	                <div class="col-md-6">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> 
	                        <i class="glyphicon glyphicon-remove"></i> <span>Close</span>
	                    </button> 
	                </div>

	                <div class="col-md-6">
	                    <button  onclick="Hapusagenda(id_agendaxx.value)"  type="button" 
	                        class="btn btn-danger">
	                        <i class="glyphicon glyphicon-trash"></i> <span>Hapus</span>
	                    </button>
	                </div> 
	            </div>
			';
		}

		if (isset($_POST['show_hapus'])) {
			$q_datapoli = mysqli_query($con, 'SELECT * FROM tb_agenda_kegiatan WHERE id_agenda="'.$_POST['id'].'"');
			$br = mysqli_fetch_array($q_datapoli);
			echo '<h4>Apakah anda yakin menghapus seluruh data <b> '.$br['nama_agenda'].' </b>? </h4>';

			echo '<input type="hidden" id="id_agendaxx" value="' . $_POST['id'] . '">';
		}

		if (isset($_POST['hapus'])) {
				$q_datapus = mysqli_query($con, 'DELETE  FROM tb_agenda_kegiatan WHERE id_agenda="'. $_POST['id'] .'"');
				echo '
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  				<strong>Data berhasil dihapus!</strong>
					</div>	
				';
	?>
				<script>
					$("#tabel_data_agenda").load("admin_agenda_data.php");
				</script>
	<?php
			}

			if (isset($_POST['footer_hapusSukses'])) {
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

