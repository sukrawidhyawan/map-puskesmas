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


	if (isset($_POST['new_fasili'])) { 
		$sql_id_fasili=  mysqli_query($con, 'SELECT MAX(id_fasilitas)+1 AS id_baru FROM tb_fasilitas');
		$br_fasili = mysqli_fetch_array($sql_id_fasili);

		$sql1 = "INSERT INTO tb_fasilitas (id_fasilitas, nama_fasilitas, deskripsi) VALUES ('$br_fasili[id_baru]', '$_POST[nm_fasili]' , '$_POST[fasili_desk]')"; 
		mysqli_query($con, $sql1);
?> 
		<notif_sukses>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  			<?php  echo "Data  <strong> $_POST[nm_fasili] </strong> berhasail dibuat !";?>
			</div>	
		</notif_sukses>

		<script>
			$("#tabel_data_fasilitas").load("admin_master_FasilitasData.php");
		</script>
<?php
	}

	if (isset($_POST['show_new'])) {
		echo '	
			<div   id="add_fasili_form_container" class="form-group">
		         <label class="control-label"> Nama Fasilitas</label> <label class="control-label" id="add_fasiliNama_msg"></label>
		        <input type="text" class="form-control" id="nam_fasili" required>
		    </div>
		                                   
		    <div  id="add_fasiliDes_form_container" class="form-group">
		        <label class="control-label">Deskripsi</label> <label class="control-label" id="add_fasiliDeskrip_msg"></label>
		        <textarea type="text" class="form-control" id="fasili_deskrip" ></textarea>
		    </div>
		';
		unset($_POST['show_new']);
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
                    <button  onclick="FasiliBaru(nam_fasili.value, fasili_deskrip.value)"  type="button" 
                        class="btn btn-info">
                        <i class="glyphicon glyphicon-floppy-disk"></i> <span>Save</span>
                    </button>
                </div> 
            </div>
		';
	}

	if (isset($_POST['id'])) {

		if (isset($_POST['updatex'])) {
	    	$result2=mysqli_query($con, 'UPDATE tb_fasilitas SET nama_fasilitas="'.$_POST['fasiliNama'].'", deskripsi="'.$_POST['fasiliDeskrip'].'"				
							WHERE id_fasilitas="'.$_POST['id'].'"') ;

	    	$q_dataFasili = mysqli_query($con, 'SELECT * FROM tb_fasilitas WHERE id_fasilitas="'.$_POST['id'].'"');
			$br = mysqli_fetch_array($q_dataFasili);

			?>
			<notif_sukses>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  				<?php  echo "Data  <strong> $br[nama_fasilitas] </strong> berhasail diperbaharui !";?> 
					</div>	
			</notif_sukses>

			<script>
				$("#tabel_data_fasilitas").load("admin_master_FasilitasData.php");
			</script>

			<?php
	    }


	    if (isset($_POST['header_edit'])) {
    	echo '<h4 class="modal-title">Edit Data Fasilitas</h4>';
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
                    <button  onclick="EditFasili(id_fasilixx.value, nam_fasili.value, fasili_deskrip.value )"  type="button" 
                        class="btn btn-info">
                        <i class="glyphicon glyphicon-floppy-disk"></i> <span>Save</span>
                    </button>
                </div> 
            </div>
		';
	}


    if (isset($_POST['show_edit'])) {
    	$q_dataPoli = mysqli_query($con, 'SELECT * FROM tb_fasilitas WHERE id_fasilitas="'.$_POST['id'].'"');
		$br = mysqli_fetch_array($q_dataPoli);

		echo '	
			<input type="hidden" id="id_fasilixx" value="' . $br['id_fasilitas'] . '">
			<div id="add_fasili_form_container" class="form-group">
		       <label class="control-label"> Nama Fasilitas</label> <label class="control-label" id="add_fasiliNama_msg"></label>
		        <input type="text" class="form-control" id="nam_fasili" value="'.$br['nama_fasilitas'].'" >
		    </div>
		                                                
		    <div  id="add_fasiliDes_form_container" class="form-group">
		         <label class="control-label">Deskripsi</label> <label class="control-label" id="add_fasiliDeskrip_msg"></label>
		        <textarea type="text" class="form-control" id="fasili_deskrip" >'.$br['deskripsi'].'</textarea>
		    </div>
		';
    }



    //---------------------------------------------------------HAPUS-----------------
		if (isset($_POST['header_hapus'])) {
			echo '<h4 class="modal-title">Hapus Data Failitas</h4>';
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
	                    <button  onclick="HapusFasili(id_poli_hapus.value)"  type="button" 
	                        class="btn btn-danger">
	                        <i class="glyphicon glyphicon-trash"></i> <span>Hapus</span>
	                    </button>
	                </div> 
	            </div>
			';
		}

		if (isset($_POST['show_hapus'])) {
			$q_datapoli = mysqli_query($con, 'SELECT * FROM tb_fasilitas WHERE id_fasilitas="'.$_POST['id'].'"');
			$br = mysqli_fetch_array($q_datapoli);
			echo '<h4>Apakah anda yakin menghapus seluruh data <b> '.$br['nama_fasilitas'].' </b>? </h4>';

			echo '<input type="hidden" id="id_poli_hapus" value="' . $_POST['id'] . '">';
		}

		if (isset($_POST['hapus'])) {

			$q_datapus = mysqli_query($con, 'DELETE  FROM tb_fasilitas WHERE id_fasilitas="'. $_POST['id'] .'"');

			echo '
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  				<strong>Data berhasil dihapus!</strong>
				</div>	
			';
?>
			<script>
				$("#tabel_data_fasilitas").load("admin_master_FasilitasData.php");
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