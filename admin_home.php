<?php
  include "dbconfig.php";

  error_reporting(E_ERROR|E_PARSE);
    session_start();
    if(!$_SESSION[valid_login]==1){
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html data-ng-app="pus_baru" id="page_home">
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
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <style>
        #map_puskesmas img{max-width:none!important;background:none!important}
    </style>

    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&callback=init_map'> </script>
    <script src="./assets/angular/angular.js"></script>
</head>
<body ng-controller="control_pusBaru">
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
                <li>
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
                        <a href="admin_home.php" class="active-menu"><i class="fa fa-stethoscope"></i> Data Puskesmas</a>
                    </li>
                    <li>
                        <a href="admin_agenda.php"> <i class="fa fa-calendar"></i> Agenda Kegiatan</a>
                    </li>
                    <li>
                        <a href="admin_data_master.php"> <i class="fa fa-file-text-o"></i> Data Master</a>
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
                            <small>Data Puskesmas</small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
                 
                
            <div class="row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pus_kecamatan" data-toggle="tab">Puskesmas Kecamatan</a>
                                </li>
                                <li class=""><a href="#pus_pembantu" data-toggle="tab">Puskesmas Pembantu</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="pus_kecamatan">
                                    <?php include "admin_home_PusKecData.php"; ?>
                                </div>

                                <div class="tab-pane fade" id="pus_pembantu">    
                                    <?php include"admin_home_PuspuData.php"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="modal fade" id="modal_AdminHome" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="ModalHeader_AdminHome"class="modal-header">
                        </div>
                                            
                        <div id= "ModalBody_AdminHome" class="modal-body">
                        </div>
                        
                       <div id="MOdalFootter_AdminHome"class="modal-footer">
                        </div>

                    </div>
                </div>
            </div>
            <!--/. END Modal FASILITAS  -->

            </div>
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
    

    <script >
        var cek_nama;
        var cek_deskrip;
    
        //------------------------------PUSKESMAS KECAMATAN---------------------------

        function showDetkec (id){
            $('#ModalHeader_AdminHome').load('admin_home_PusKecProses.php', { id: id, header_Detkec: '1'});
            $('#ModalBody_AdminHome').load('admin_home_PusKecProses.php', { id: id, body_Detkec: '1'});
            $('#MOdalFootter_AdminHome').load('admin_home_PusKecProses.php', {id: id, footer_Detkec: '1'});
            $('#modal_AdminHome').modal('show');
        }

        function showHapusKec (id){
            $('#ModalHeader_AdminHome').load('admin_home_PusKecProses.php', { id: id, header_HapusKec: '1'});
            $('#ModalBody_AdminHome').load('admin_home_PusKecProses.php', { id: id, body_ShowHapusKec: '1'});
            $('#MOdalFootter_AdminHome').load('admin_home_PusKecProses.php', {id: id, footer_ShowHapusKec: '1'});
            $('#modal_AdminHome').modal('show');
        }

        function HapusKec(id){
            $('#ModalHeader_AdminHome').load('admin_home_PusKecProses.php', { id: id, header_HapusKec: '1'});
            $('#ModalBody_AdminHome').load('admin_home_PusKecProses.php', { id: id, body_HapusKec: '1'});
            $('#MOdalFootter_AdminHome').load('admin_home_PusKecProses.php', {id: id, footer_HapusKec: '1'});
        }


        function showEditpusKec (id){
            $('#page_home').load('admin_edit.php', { id: id, header_HapusKec: '1'});
            
        }

        function showBarupusKec (){
             $('#pus_kecamatan').load('admin_home_PusKecBaru.php', { header_HapusKec: '1'});
        }

        
        //------------------------------PUSKESMAS PEMBANTU---------------------------
        function showDetPusPu (id){
            $('#ModalHeader_AdminHome').load('admin_home_PusPuProses.php', { id: id, header_DetPu: '1'});
            $('#ModalBody_AdminHome').load('admin_home_PusPuProses.php', { id: id, body_DetPu: '1'});
            $('#MOdalFootter_AdminHome').load('admin_home_PusPuProses.php', {id: id, footer_DetPu: '1'});
            $('#modal_AdminHome').modal('show');
        }

        function showHapusPu (id){
            $('#ModalHeader_AdminHome').load('admin_home_PusPuProses.php', { id: id, header_HapusPu: '1'});
            $('#ModalBody_AdminHome').load('admin_home_PusPuProses.php', { id: id, body_ShowHapusPu: '1'});
            $('#MOdalFootter_AdminHome').load('admin_home_PusPuProses.php', {id: id, footer_ShowHapusPu: '1'});
            $('#modal_AdminHome').modal('show');
        }

        function HapusPu(id){
            $('#ModalHeader_AdminHome').load('admin_home_PusPuProses.php', { id: id, header_HapusPu: '1'});
            $('#ModalBody_AdminHome').load('admin_home_PusPuProses.php', { id: id, body_HapusPu: '1'});
            $('#MOdalFootter_AdminHome').load('admin_home_PusPuProses.php', {id: id, footer_HapusPu: '1'});
        }

   </script>
    
</body>
</html>