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
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>


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
                        <a href="admin_agenda.php" class="active-menu"> <i class="fa fa-calendar"></i> Agenda Kegiatan</a>
                    </li>
                    <li>
                        <a href="admin_data_master.php" > <i class="fa fa-file-text-o"></i> Data Master</a>
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
                            

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="data_poli">
                                    
                                       <button type='submit' class='btn btn-info btn-md' style="margin-bottom: 15px; margin-top: 15px;" 
                                        data-toggle='modal' 
                                        onclick='ShowAgendaBaru()'
                                    >
                                        <i class='glyphicon glyphicon-plus-sign'></i> Agenda Baru 
                                    </button>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="data-poli">
                                            <thead>
                                                <tr>                                                
                                                    <th class='text-center'>No</th>
                                                    <th class='text-center'>Nama Agenda  </th>
                                                    <th class='text-center'>Tanggal Agenda </th>
                                                    <th class='text-center'>Nama Puskesmas </th>
                                                    <th class='text-center' > Action </th>                                                       
                                                </tr>
                                            </thead>
                                            
                                            <tbody id= "tabel_data_agenda">                                                    
                                                <?php include"admin_agenda_data.php" ?>
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


            <!--/. Modal poli  -->
            <div class="modal fade" id="modal_Agenda" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="ModalHeader_Agenda"class="modal-header">
                        </div>
                                            
                        <div id= "ModalBody_Agenda" class="modal-body">
                        </div>
                        
                       <div id="MOdalFootter_Agenda"class="modal-footer">
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
   
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      
        <script>
           $('#tgl_agenda').datepicker ();
    </script>
    
   <script >
        var cek_nama;
        var cek_deskrip;
    
        function ShowAgendaBaru(){
            $('#ModalHeader_Agenda').load('admin_agenda_proses.php', {header_new: '1'});
            $('#ModalBody_Agenda').load('admin_agenda_proses.php', {show_new: '1'});
            $('#MOdalFootter_Agenda').load('admin_agenda_proses.php', {footer_new: '1'});
            $('#modal_Agenda').modal('show');
        }


        function AgendaBaru(namaAgenda, tglAgenda, idPUs){
            cek_nama= false;
            cek_polideskrip= false;

            if ($('#nam_agenda').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_namAgenda_form_container').addClass('has-error');
                $('#add_Labelagenda_msg').html("tidak boleh kosong!");
                cek_nama= false;
            }else if ($('#nam_agenda').val() != "" ){
                $('#add_namAgenda_form_container').removeClass('has-error');
                $('#add_Labelagenda_msg').html(null);
                cek_nama=true;
            }

            if ($('#tgl_agenda').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_tglAgenda_form_container').addClass('has-error');
                $('#add_tglAgenda_msg').html("tidak boleh kosong!");
                cek_deskrip = false;
            }else if ($('#tgl_agenda').val() != "" ){
                $('#add_tglAgenda_form_container').removeClass('has-error');
                $('#add_tglAgenda_msg').html(null);
                cek_deskrip=true;
            }

            if (cek_nama && cek_deskrip) {
                $('#ModalHeader_Agenda').load('admin_agenda_proses.php', {header_new: '1'});
                $('#ModalBody_Agenda').load('admin_agenda_proses.php', {namaAgenda: namaAgenda, tglAgenda: tglAgenda, idPUs:idPUs,  new: '1', show_new: '1'});  
            }


        }

       function showEditAgenda(id){
            $('#ModalHeader_Agenda').load('admin_agenda_proses.php', {id: id, header_edit: '1'});
            $('#ModalBody_Agenda').load('admin_agenda_proses.php', {id: id, show_edit: '1'});
            $('#MOdalFootter_Agenda').load('admin_agenda_proses.php', {id: id, footer_edit: '1'});
            $('#modal_Agenda').modal('show');
        }

        function EditAgenda(id, namaAgenda, tgl_agenda, id_PUs){
            cek_nama= false;
            cek_deskrip= false;
            
            if ($('#nam_agenda').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_namAgenda_form_container').addClass('has-error');
                $('#add_Labelagenda_msg').html("tidak boleh kosong!");
                cek_nama= false;
            }else if ($('#nam_agenda').val() != "" ){
                $('#add_namAgenda_form_container').removeClass('has-error');
                $('#add_Labelagenda_msg').html(null);
                cek_nama=true;
            }

            if ($('#tgl_agenda').val() == "" ) {
                $("notif_sukses").hide();
                $('#add_tglAgenda_form_container').addClass('has-error');
                $('#add_tglAgenda_msg').html("tidak boleh kosong!");
                cek_deskrip = false;
            }else if ($('#tgl_agenda').val() != "" ){
                $('#add_tglAgenda_form_container').removeClass('has-error');
                $('#add_tglAgenda_msg').html(null);
                cek_deskrip=true;
            }

            if (cek_nama && cek_deskrip) {
                $('#ModalBody_Agenda').load('admin_agenda_proses.php', {id: id, namaAgenda: namaAgenda, tgl_agenda: tgl_agenda, id_PUs: id_PUs, updatex: '1', show_edit: '1'});
            }
             
        }


        function showHapusAgenda (id){
            $('#ModalHeader_Agenda').load('admin_agenda_proses.php', { id: id, header_hapus: '1'});
            $('#ModalBody_Agenda').load('admin_agenda_proses.php', {id: id, show_hapus: '1'});
            $('#MOdalFootter_Agenda').load('admin_agenda_proses.php', {id: id, footer_hapus: '1'});
            $('#modal_Agenda').modal('show');
        }

        function Hapusagenda(id){
            $('#ModalHeader_Agenda').load('admin_agenda_proses.php', { id: id, header_hapus: '1'});
            $('#ModalBody_Agenda').load('admin_agenda_proses.php', {id: id, hapus: '1'});
            $('#MOdalFootter_Agenda').load('admin_agenda_proses.php', {id: id, footer_hapusSukses: '1'});
        }


   </script>
</body>
</html>
