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

		$sql_id_poli=  mysqli_query($con, 'SELECT MAX(id_poli)+1 AS id_baru FROM tb_poli');
		$br_id_poli = mysqli_fetch_array($sql_id_poli);

		$sql1 = "INSERT INTO tb_poli (id_poli, nama_poli, deskripsi) VALUES ('$br_id_poli[id_baru]', '$_POST[nm_poli]' , '$_POST[poli_desk]')"; 
		mysqli_query($con, $sql1)or die(mysqli_error());
?> 
			<notif_sukses>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  				<?php  echo "Data  <strong> $_POST[nm_poli] </strong> berhasail dibuat !";?> 
					</div>	
			</notif_sukses>

			<script>
				
				$("#tabel_data_poli").load("admin_master_PoliData.php");
			</script>
<?php

	}

	if (isset($_POST['show_new'])) {
	
		echo '	
			<div   id="add_poli_form_container" class="form-group">
		         <label class="control-label"> Nama Poli</label> <label class="control-label" id="add_poliNama_msg"></label>
		        <input type="text" class="form-control" id="nam_poli" required>
		    </div>
		                                   
		    <div  id="add_poliDes_form_container" class="form-group">
		        <label class="control-label">Deskripsi</label> <label class="control-label" id="add_poliDeskrip_msg"></label>
		        <textarea type="text" class="form-control" id="poli_deskrip" ></textarea>
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
                    <button  onclick="PoliBaru(nam_poli.value, poli_deskrip.value)"  type="button" 
                        class="btn btn-info">
                        <i class="glyphicon glyphicon-floppy-disk"></i> <span>Savesss</span>
                     </button>
                </div> 
            </div>
		';
	}

	
if (isset($_POST['id'])) {

	if (isset($_POST['updatex'])) {
    	$result2=mysqli_query($con, 'UPDATE tb_poli SET nama_poli="'.$_POST['poliNama'].'", deskripsi="'.$_POST['poliDeskrip'].'"				
						WHERE id_poli="'.$_POST['id'].'"') or die (mysql_error());

    	$q_dataPoli = mysqli_query($con, 'SELECT * FROM tb_poli WHERE id_poli="'.$_POST['id'].'"');
		$br = mysqli_fetch_array($q_dataPoli);

		?>
		<notif_sukses>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  				<?php  echo "Data  <strong> $br[nama_poli] </strong> berhasail diperbaharui !";?> 
				</div>	
		</notif_sukses>

		<script>
			$("#tabel_data_poli").load("admin_master_PoliData.php");
		</script>

		<?php
    }

	
    if (isset($_POST['header_edit'])) {
    	echo '<h4 class="modal-title">Edit Data Poliklinik</h4>';
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
                    <button  onclick="EditPoli(id_polixx.value, nam_poli.value, poli_deskrip.value )"  type="button" 
                        class="btn btn-info">
                        <i class="glyphicon glyphicon-floppy-disk"></i> <span>Save</span>
                    </button>
                </div> 
            </div>
		';


	}


    if (isset($_POST['show_edit'])) {
    	$q_dataPoli = mysqli_query($con, 'SELECT * FROM tb_poli WHERE id_poli="'.$_POST['id'].'"');
		$br = mysqli_fetch_array($q_dataPoli);

		echo '	
			<input type="hidden" id="id_polixx" value="' . $br['id_poli'] . '">
			<div id="add_poli_form_container" class="form-group">
		       <label class="control-label"> Nama Poliklinik</label> <label class="control-label" id="add_poliNama_msg"></label>
		        <input type="text" class="form-control" id="nam_poli" value="'.$br['nama_poli'].'" >
		    </div>
		                                                
		    <div  id="add_poliDes_form_container" class="form-group">
		         <label class="control-label">Deskripsi</label> <label class="control-label" id="add_poliDeskrip_msg"></label>
		        <textarea type="text" class="form-control" id="poli_deskrip" >'.$br['deskripsi'].'</textarea>
		    </div>
		';

		$_POST['show_edit']= null;
    }

    
	//---------------------------------------------------------HAPUS-----------------
	
	if (isset($_POST['header_hapus'])) {
		echo '<h4 class="modal-title">Hapus Data Poli</h4>';
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
                    <button  onclick="HapusPoli(id_poli_hapus.value)"  type="button" 
                        class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i> <span>Hapus</span>
                    </button>
                </div> 
            </div>
		';
	}

	if (isset($_POST['show_hapus'])) {
		$q_datapoli = mysqli_query($con, 'SELECT * FROM tb_poli WHERE id_poli="'.$_POST['id'].'"');
		$br = mysqli_fetch_array($q_datapoli);
		echo '<h4>Apakah anda yakin menghapus seluruh data <b> '.$br['nama_poli'].' </b>? </h4>';

		echo '<input type="hidden" id="id_poli_hapus" value="' . $_POST['id'] . '">';
	}

	if (isset($_POST['hapus'])) {
			$q_datapus = mysqli_query($con, 'DELETE  FROM tb_poli WHERE id_poli="'. $_POST['id'] .'"');
			echo '
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  				<strong>Data berhasil dihapus!</strong>
				</div>	
			';
?>
			<script>
				$("#tabel_data_poli").load("admin_master_PoliData.php");
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


	if (isset($_GET['id_hapus'])) {
		$id_pusx= $_GET['id_hapus']; 	
    	$q_datapus = mysqli_query($con, 'DELETE  FROM tb_poli WHERE id_poli="'.$id_pusx.'"');
		header('Location:admin_data_master.php');  
	}

 ?>
