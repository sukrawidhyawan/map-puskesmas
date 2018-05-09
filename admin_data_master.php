<?php
  include "dbconfig.php";

  error_reporting(E_ERROR|E_PARSE);
    session_start();
    if(!$_SESSION[valid_login]==1){
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Dream</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    
</head>
<body>
    <div id="wrapper">
         <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin_home.php"> <i class="fa fa-medkit"></i> Puskesmas</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                
                <li >
                    <a href="logout.php" aria-expanded="false">
                       <i class="fa fa-sign-out fa-fw"></i> Logout 
                    </a>
                    
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="admin_home.php"> <i class="fa fa-stethoscope"></i> Data Puskesmas</a>
                    </li>
                    <li>
                        <a href="admin_agenda.php"> <i class="fa fa-calendar"></i> Agenda Kegiatan</a>
                    </li>
                    <li>
                        <a href="admin_data_master.php" class="active-menu"> <i class="fa fa-file-text-o"></i> Data Master</a>
                    </li>
                    <li>
                        <a href="admin_puskesmas_baru.php"><i class="fa fa-plus-square"></i> Puskemas Baru</a>
                    </li>
            
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header" style="margin-bottom: 10px;">
                            <small>Data Master Poliklinik dan Fasilitas</small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
                                 
           
            <div class="row" >
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#data_poli" data-toggle="tab">Poliklinik</a>
                                </li>
                                <li class=""><a href="#data_fasilitas" data-toggle="tab">Fasilitas Puskesmas</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="data_poli">
                                    
                                       <button type='submit' class='btn btn-info btn-md' style="margin-bottom: 15px; margin-top: 15px;" 
                                        data-toggle='modal' 
                                        onclick='showPoliBaru()'
                                    >
                                        <i class='glyphicon glyphicon-plus-sign'></i> Poliklinik Baru 
                                    </button>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="data-poli">
                                            <thead>
                                                <tr>                                                
                                                    <th class='text-center'>No</th>
                                                    <th class='text-center'>Nama Polikilinik </th>
                                                    <th class='text-center' > Action </th>                                                       
                                                </tr>
                                            </thead>
                                            
                                            <tbody id= "tabel_data_poli">                                                    
                                                <?php include"admin_master_PoliData.php" ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="data_fasilitas">    

                                    <button type='submit' class='btn btn-info btn-md' style="margin-bottom: 15px; margin-top: 15px;" 
                                        data-toggle='modal' 
                                        onclick='showFasiliBaru()'
                                    >
                                        <i class='glyphicon glyphicon-plus-sign'></i> Fasilitas Baru 
                                    </button>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>                                                
                                                    <th class='text-center'>No</th>
                                                    <th class='text-center'>Nama Fasilitas </th>
                                                    <th class='text-center' > Action </th>                                                       
                                                </tr>
                                            </thead>
                                            
                                            <tbody id= "tabel_data_fasilitas">                                                    
                                                <?php include"admin_master_FasilitasData.php" ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
				<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
					</div>


            <!--/. Modal   -->
            <div class="modal fade" id="modal" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="ModalHeader"class="modal-header">
                        </div>
                                            
                        <div id= "ModalBody" class="modal-body">
                        </div>
                        
                       <div id="MOdalFootter"class="modal-footer">
                        </div>

                    </div>
                </div>
            </div>
            <!--/. END Modal poli  -->


			 <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#data-poli').dataTable();
            });
    </script>
    
   <script >
        var cek_nama;
        var cek_deskrip;
    

        //------------------------------POLIKLINIK---------------------------
        function showPoliBaru(){

            $('#ModalHeader').load('admin_master_PoliProses.php', {header_new: '1'});
            $('#ModalBody').load('admin_master_PoliProses.php', {show_new: '1'});
            $('#MOdalFootter').load('admin_master_PoliProses.php', {footer_new: '1'});
            $('#modal').modal('show');
        }


        function PoliBaru(nama_poli, deskrip){
            cek_nama= false;
            cek_polideskrip= false;

            if ($('#nam_poli').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_poli_form_container').addClass('has-error');
                $('#add_poliNama_msg').html("tidak boleh kosong!");
                cek_nama= false;
            }else if ($('#nam_poli').val() != "" ){
                $('#add_poli_form_container').removeClass('has-error');
                $('#add_poliNama_msg').html(null);
                cek_nama=true;
            }

            if ($('#poli_deskrip').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_poliDes_form_container').addClass('has-error');
                $('#add_poliDeskrip_msg').html("tidak boleh kosong!");
                cek_deskrip = false;
            }else if ($('#poli_deskrip').val() != "" ){
                $('#add_poliDes_form_container').removeClass('has-error');
                $('#add_poliDeskrip_msg').html(null);
                cek_deskrip=true;
            }

            if (cek_nama && cek_deskrip) {
                $('#ModalHeaderi').load('admin_master_PoliProses.php', {header_new: '1'});
                $('#ModalBody').load('admin_master_PoliProses.php', {nm_poli: nama_poli, poli_desk: deskrip,  new: '1', show_new: '1'});  
            }


        }

       function showEditPoli(id){
            $('#ModalHeader').load('admin_master_PoliProses.php', {id: id, header_edit: '1'});
            $('#ModalBody').load('admin_master_PoliProses.php', {id: id, show_edit: '1'});
            $('#MOdalFootter').load('admin_master_PoliProses.php', {id: id, footer_edit: '1'});
            $('#modal').modal('show');

        }

        function EditPoli(id, poli_nama, poli_deskp){
            cek_nama= false;
            cek_deskrip= false;
            
            if ($('#nam_poli').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_poli_form_container').addClass('has-error');
                $('#add_poliNama_msg').html("tidak boleh kosong!");
                cek_nama= false;
            }else if ($('#nam_poli').val() != "" ){
                $('#add_poli_form_container').removeClass('has-error');
                $('#add_poliNama_msg').html(null);
                cek_nama=true;
            }

            if ($('#poli_deskrip').val() == "" ) {
                 $("notif_sukses").hide();
                $('#add_poliDes_form_container').addClass('has-error');
                $('#add_poliDeskrip_msg').html("tidak boleh kosong!");
                cek_deskrip = false;
            }else if ($('#poli_deskrip').val() != "" ){
                $('#add_poliDes_form_container').removeClass('has-error');
                $('#add_poliDeskrip_msg').html(null);
                cek_deskrip=true;
            }

            if (cek_nama && cek_deskrip) {
                $('#ModalBody').load('admin_master_PoliProses.php', {id: id, poliNama: poli_nama, poliDeskrip: poli_deskp, updatex: '1', show_edit: '1'});
            }
             
        }


        function showHapusPoli (id){
            $('#ModalHeader').load('admin_master_PoliProses.php', { id: id, header_hapus: '1'});
            $('#ModalBody').load('admin_master_PoliProses.php', {id: id, show_hapus: '1'});
            $('#MOdalFootter').load('admin_master_PoliProses.php', {id: id, footer_hapus: '1'});
            $('#modal').modal('show');

        }

        function HapusPoli(id){
            $('#ModalHeader').load('admin_master_PoliProses.php', { id: id, header_hapus: '1'});
            $('#ModalBody').load('admin_master_PoliProses.php', {id: id, hapus: '1'});
            $('#MOdalFootter').load('admin_master_PoliProses.php', {id: id, footer_hapusSukses: '1'});
        }


        //------------------------------FASILITAS---------------------------

        function showFasiliBaru (){
            $('#ModalHeader').load('admin_master_FasilitasProses.php', { header_new: '1'});
            $('#ModalBody').load('admin_master_FasilitasProses.php', { show_new: '1'});
            $('#MOdalFootter').load('admin_master_FasilitasProses.php', { footer_new: '1'});
            $('#modal').modal('show');
        }

        function FasiliBaru(nama_fasili, deskrip){
            
            cek_nama= false;
            cek_polideskrip= false;

            if ($('#nam_fasili').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_fasili_form_container').addClass('has-error');
                $('#add_fasiliNama_msg').html("tidak boleh kosong!");
                cek_fasilix= false;
            }else if ($('#nam_fasili').val() != "" ){
                $('#add_fasili_form_container').removeClass('has-error');
                $('#add_fasiliNama_msg').html(null);
                cek_fasilix=true;
            }

            if ($('#fasili_deskrip').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_fasiliDes_form_container').addClass('has-error');
                $('#add_fasiliDeskrip_msg').html("tidak boleh kosong!");
                cek_polideskrip = false;
            }else if ($('#fasili_deskrip').val() != "" ){
                $('#add_fasiliDes_form_container').removeClass('has-error');
                $('#add_fasiliDeskrip_msg').html(null);
                cek_fasilideskrip=true;
            }

            if (cek_fasilix && cek_fasilideskrip) {

                $('#ModalHeader').load('admin_master_FasilitasProses.php', {header_new: '1'});
                   
                $('#ModalBody').load('admin_master_FasilitasProses.php', {nm_fasili: nama_fasili, fasili_desk: deskrip,  new_fasili: '1', show_new: '1'});
               
            }
        }

        function showEditFasili(id){
            $('#ModalHeader').load('admin_master_FasilitasProses.php', {id: id, header_edit: '1'});
            $('#ModalBody').load('admin_master_FasilitasProses.php', {id: id, show_edit: '1'});
            $('#MOdalFootter').load('admin_master_FasilitasProses.php', {id: id, footer_edit: '1'});
            $('#modal').modal('show');
        }

        function EditFasili(id, fasili_nama, fasili_deskp){
            cek_nama= false;
            cek_deskrip= false;
            
             if ($('#nam_fasili').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_fasili_form_container').addClass('has-error');
                $('#add_fasiliNama_msg').html("tidak boleh kosong!");
                cek_nama= false;
            }else if ($('#nam_fasili').val() != "" ){
                $('#add_fasili_form_container').removeClass('has-error');
                $('#add_fasiliNama_msg').html(null);
                cek_nama=true;
            }

            if ($('#fasili_deskrip').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_fasiliDes_form_container').addClass('has-error');
                $('#add_fasiliDeskrip_msg').html("tidak boleh kosong!");
                cek_deskrip = false;
            }else if ($('#fasili_deskrip').val() != "" ){
                $('#add_fasiliDes_form_container').removeClass('has-error');
                $('#add_fasiliDeskrip_msg').html(null);
                cek_deskrip=true;
            }


            if (cek_nama && cek_deskrip) {
                $('#ModalBody').load('admin_master_FasilitasProses.php', {id: id, fasiliNama: fasili_nama, fasiliDeskrip: fasili_deskp, updatex: '1', show_edit: '1'});
            }
             
        }


        function showHapusFasili (id){
            $('#ModalHeader').load('admin_master_FasilitasProses.php', { id: id, header_hapus: '1'});
            $('#ModalBody').load('admin_master_FasilitasProses.php', {id: id, show_hapus: '1'});
            $('#MOdalFootter').load('admin_master_FasilitasProses.php', {id: id, footer_hapus: '1'});
            $('#modal').modal('show');
        }

        function HapusFasili(id){
            $('#ModalHeader').load('admin_master_FasilitasProses.php', { id: id, header_hapus: '1'});
            $('#ModalBody').load('admin_master_FasilitasProses.php', {id: id, hapus: '1'});
            $('#MOdalFootter').load('admin_master_FasilitasProses.php', {id: id, footer_hapusSukses: '1'});
        }


   </script>
</body>
</html>
