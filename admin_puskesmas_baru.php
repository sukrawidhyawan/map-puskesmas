<?php 
    include 'dbconfig.php';
 ?>
<?php 
    $sql_id=  mysqli_query($con, 'SELECT MAX(id_puskesmas)+1 AS id_baru FROM tb_puskesmas');
    $br_id = mysqli_fetch_array($sql_id);
    $idxss= $br_id['id_baru'];
?>
<!DOCTYPE html>
<html data-ng-app="ng_js02">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PUS BARU</title>

        <!-- Bootstrap Styles-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FontAwesome Styles-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <!-- Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!--File Upload CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-fileupload.min.css">
        <style>
          #map_puskesmas img{max-width:none!important;background:none!important}
        </style>
        <script src="./assets/angular/angular.js"></script>
    </head>
    <body ng-controller="MainController">
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
                            <a href="admin_home.php" ><i class="fa fa-stethoscope"></i> Data Puskesmas</a>
                        </li>
                        <li>
                            <a href="admin_agenda.php"> <i class="fa fa-calendar"></i> Agenda Kegiatan</a>
                        </li>
                        <li>
                            <a href="admin_data_master.php"> <i class="fa fa-file-text-o"></i> Data Master</a>
                        </li>
                        <li>
                            <a href="admin_puskesmas_baru.php" class="active-menu"><i class="fa fa-plus-square"></i> Puskemas Baru</a>
                        </li>
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" style="padding-left: 0px; padding-right: 0px; padding-top: 0px; margin-left: 260px;">
                <div id="page-inner">
                    <div class="col-md-12">
                        <h1 class="page-header" style="margin-bottom: 10px;">
                            <small>Puskesmas Baru</small>
                        </h1>
                    </div>

                    <div class="row" style="margin-left: 0px; padding-left: 0px; padding-right: 0px; margin-right: 0px;" >
                        <div class="col-md-12">
                            <div class=" panel panel-body">
                                <?php 
                                    if (isset($_GET['jj'])) {
                                       echo '
                                            <notif_sukses>
                                                <div class="alert alert-success">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <h4>Data  <strong> '.$_GET['jj'].' </strong> berhasil di Simpan! </h4>
                                                </div>
                                            </notif_sukses>
                                           
                                       ';

                                       echo '
                                            <a href="admin_home.php">
                                                <button class="btn btn-danger" style="margin-bottom: 15px;  margin-left: 15px;" >
                                                    <i class="glyphicon glyphicon-chevron-left"></i> Back 
                                                </button>
                                            </a>
                                       ';
                                    }
                                ?>         

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2 class='text-center'>Data Puskesmas Baru </h2>
                                    </div>

                                    <div class="panel-body">
                                        <div class="col-lg-4">
                                            <form role="form" action="admin_puskesmas_baru_proses.php?action=insert&&idx=<?php echo"$idxss"; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="form-group" data-ng-repeat="key in data_pus" id="lat_form_container">
                                                   <label class="control-label">Latitude</label>
                                                    <label class="control-label" id="add_lat_msg"></label>
                                                    <input class="form-control" placeholder="Example: -8.82909891537723"  name="lat_pus" id="tx_lat_pus" data-ng-model="data_pus[$index].lat" required>
                                                </div>

                                                <div class="form-group" data-ng-repeat="key in data_pus" id="lng_form_container">
                                                    <label class="control-label">Longitude</label>
                                                    <label class="control-label" id="add_lng_msg"></label>
                                                    <input  class="form-control" placeholder="Example: 115.17029464244843" name="lng_pus" id="tx_lng_pus" data-ng-model="data_pus[$index].lng" required>
                                                </div>

                                                <div class="form-group" data-ng-repeat="key in data_pus" id="nama_form_container">
                                                    <label class="control-label">Nama Puskesmas</label>
                                                    <label class="control-label" id="add_Nama_msg"></label>
                                                    <input class="form-control"  id="namPus" placeholder="Enter text" name="nama_pus" data-ng-model="data_pus[$index].nama" required> 
                                                </div>

                                                <div class="form-group" >
                                                    <label>Jenis Puskesmas</label>
                                                    <select class=" form-control" name= " jns_puskemass" data-ng-model="data_jnsPus"  data-ng-init="1" required>
                                                         <?php 
                                                            $jns_pus=mysqli_query($con, 'SELECT * FROM  tb_puskesmas_jns') ;
                                                            $k=0;
                                                            while ($br_jnsPus=mysqli_fetch_array($jns_pus)) {
                                                                echo'<option value='.$br_jnsPus['id_jns_puskesmas'].'>'.$br_jnsPus['nama_jenis'].'</option> ';
                                                                $k++;                                          
                                                            }
                                                         ?>
                                                    </select>
                                                </div>
                              
                                                <div class="form-group">
                                                    <label data-ng-show="data_jnsPus==2">Puskemas Kecamatan</label>
                                                    <select class=" form-control" id="PuskeC" name="PuskecN" data-ng-model="data_pusKec" data-ng-show="data_jnsPus==2">
                                                         <?php 
                                                            $Pus_kec=mysqli_query($con, 'SELECT * FROM  tb_puskesmas where id_jns_puskesmas=1');
                                                            $k=0;
                                                            while ($br_PusKec=mysqli_fetch_array($Pus_kec)) {
                                                                echo'<option value='.$br_PusKec['id_puskesmas'].'>'.$br_PusKec['nama_puskesmas'].'</option> ';
                                                                $k++;                                          
                                                            }
                                                         ?>
                                                    </select>
                                                </div>
                                                <div class="form-group" data-ng-repeat="key in data_pus" id="almt_form_container">
                                                    <label class="control-label">Alamat</label>
                                                    <label class="control-label" id="add_almt_msg"></label>
                                                    <input class="form-control" id="tx_alamat" name="alamat_pus" data-ng-model="data_pus[$index].alamat" required>
                                                </div>

                                                <div class="form-group" data-ng-repeat="key in data_pus" id="tlp_form_container">
                                                    <label  class="control-label" >Telepon</label>
                                                    <label class="control-label" id="add_tlp_msg"></label>
                                                    <input class="form-control" id="tx_telepon" name="telepon_pus" data-ng-model="data_pus[$index].tlp" required>
                                                </div>

                                                <label class="control-label input-group" data-ng-show="data_jnsPus==1">Poliklinik</label>
                                                <div data-ng-repeat="key in data_poli" class="form-group  input-group" data-ng-show="data_jnsPus==1">
                                                    <span class="input-group-addon" >{{$index +1 }}</span> 
                                                   
                                                    <select class=" form-control" data-ng-model="data_poli[$index].policc"  >
                                                        <?php 
                                                            $polix=mysqli_query($con, 'SELECT * FROM  tb_poli');
                                                            $k=0;
                                                            while ($br_poli=mysqli_fetch_array($polix)) {
                                                                echo'<option value='.$br_poli['id_poli'].'>'.$br_poli['nama_poli'].'</option> ';
                                                                $k++;                                          
                                                            }
                                                         ?>
                                                    </select>
                                                  
                                                </div>
                             
                                                <button class="btn btn-primary btn-sm" data-ng-click="tambah_poli()" data-ng-show="data_jnsPus==1" <?php echo 'data-ng-hide=" data_jnsPus==2 ||data_jnsPus==null || data_poli.length>='.$k.' "'; ?> type="button" >
                                                    <i class='glyphicon glyphicon-plus'></i> More
                                                </button>
                                                
                                                <button class="btn btn-warning btn-sm" data-ng-click="cancel_poli()" data-ng-show="data_poli.length>1" data-ng-hide="data_jnsPus==null || data_jnsPus==2 || data_poli.length==1" type="button"> 
                                                    <i class='glyphicon glyphicon-minus'></i> Less
                                                </button> 
                                                <br data-ng-show="data_jnsPus==1"> <br data-ng-show="data_jnsPus==1">

                                                

                                                <label class="control-label input-group" >Fasilitas</label>
                                                <div data-ng-repeat="key in data_fasili" class="form-group  input-group">
                                                    <span class="input-group-addon" >{{$index +1 }}</span> 
                                                    <select class=" form-control" data-ng-model="data_fasili[$index].fasilicc" required>
                                                        <?php 
                                                            $fasilix=mysqli_query($con, 'SELECT * FROM  tb_fasilitas');
                                                            $k=0;
                                                            while ($br_fasili=mysqli_fetch_array($fasilix)) {
                                                                echo'<option value='.$br_fasili['id_fasilitas'].'>'.$br_fasili['nama_fasilitas'].'</option> ';
                                                                $k++;                                          
                                                            }
                                                         ?>
                                                    </select>  
                                                </div>
                                                <button class="btn btn-primary btn-sm" data-ng-click="tambah_fasili()" <?php echo 'data-ng-hide="data_fasili.length>='.$k.'"'; ?> type="button">
                                                    <i class='glyphicon glyphicon-plus'></i> More
                                                </button>
                                                <button class="btn btn-warning btn-sm" data-ng-click="cancel_fasili()" data-ng-show="data_fasili.length>1" type="button"> 
                                                    <i class='glyphicon glyphicon-minus'></i> Less
                                                </button> 
                                                <br> <br>

                                               

                                                <div class="" id="label_foto">
                                                    <label class="control-label" >Foto Puskesmas</label>
                                                    <label class="control-label " id="add_img_msg"></label>
                                                </div>
                                                
                                                <div class="form-group fileupload fileupload-new " data-provides="fileupload" id="img_form_container" >    
                                                    <div class="fileupload-new thumbnail" style="width: 300px; height: 150px;"><img src="" alt="" /></div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 450px; max-height: 150px; line-height: 20px;"></div>
                                                    <div>
                                                        <span class="btn btn-file btn-primary">
                                                            <span class="fileupload-new">Upload Foto Puskesmas</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input class="form-control" type="file" name="fotoPus" required id="img_Pus"/>
                                                        </span>
                                                        
                                                    </div>
                                                </div>

                                                 <div class="form-group" data-ng-repeat="key in data_pus" id="deskr_form_container">
                                                    <label class="control-label">Deskripsi</label>
                                                    <label class="control-label" id="add_deskr_msg"></label>
                                                    <textarea class="form-control"  id="deskr" name="deskrip_pus" data-ng-model="data_pus[$index].deskrip" required> </textarea > 
                                                </div>
                                                
                                                <button type="submit" data-ng-click="simpan()" class="btn btn-info" >Submit Button</button>
                                                <button type="button" data-ng-click="reset_input()"  class="btn btn-info">Reset</button>
                                               
                                            </form>
                                        </div>

                                        <div class="col-lg-8">
                                            <div id='map_puskesmas' style='height:800px;width:100%;'></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- JS Scripts-->
        <!-- jQuery Js -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        
        <!-- Metis Menu Js -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- Morris Chart Js -->
        <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
        <script src="assets/js/morris/morris.js"></script>
        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>
         <!-- Bootstrap Js -->
        <script src="assets/js/bootstrap.min.js"></script>
         <!--file upload js-->
        <script src="assets/js/bootstrap-fileupload.js"></script>

        <script >
            var map;
            function init_map(){
                var posisi_marker = {lat:  -8.792457604520289, lng: 115.18432796001434};

                var myOptions = {
                   
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map_puskesmas'), myOptions);
                var infoWindow = new google.maps.InfoWindow;      
                var bounds = new google.maps.LatLngBounds();

                //---------------------------------------------------------------------
                function bindInfoWindow(marker, map, infoWindow, html) {
                  google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                  });
                }

                //---------------------------------------------------------------------
                function addMarker(lat, lng, info) {
                    var pt = new google.maps.LatLng(lat, lng);
                    bounds.extend(pt);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: pt,
                        icon: "img/marker/marker4.png"
                    });       
                    map.fitBounds(bounds);
                    bindInfoWindow(marker, map, infoWindow, info);
                   
                }


                var id=1;
                var id2;
                var markers = {};
                var marker2=null;
                

                function get_lokasi_input (map){
                  
                    document.getElementById('tx_lat_pus').addEventListener('change', onChangeHandler);
                    document.getElementById('tx_lng_pus').addEventListener('change', onChangeHandler);
                    var position = new google.maps.LatLng(parseFloat(latt), parseFloat(lngg));

                    var latt = document.getElementById("tx_lat_pus").value;
                    var lngg = document.getElementById("tx_lng_pus").value;


                 
                        var pt2 = new google.maps.LatLng(latt, lngg);

                        if (marker2!=null) {
                             marker2.setPosition( new google.maps.LatLng( latt, lngg ) );
                             
                        }else{
                            marker2 = new google.maps.Marker({
                                map: map,
                                position: pt2
                            });
                            
                        } 

                    
                    
                }

                function get_lokasi_klik (map){
                    google.maps.event.addListener(map,'rightclick',function(event){
                        
                        var latt = event.latLng.lat();
                        var lngg = event.latLng.lng();
                        document.getElementById("tx_lat_pus").value = latt;
                        document.getElementById("tx_lng_pus").value = lngg;

                        var pt2 = new google.maps.LatLng(latt, lngg);

                        var geocoder = geocoder = new google.maps.Geocoder();
                        geocoder.geocode({ 'latLng': pt2 }, function (results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                     $("#tx_alamat").val(results[0].formatted_address);
                                }
                            }
                        });

                        if (marker2!=null) {
                             marker2.setPosition( new google.maps.LatLng( latt, lngg ) );
                             map.panTo(pt2);
                        }else{
                            marker2 = new google.maps.Marker({
                                map: map,
                                position: pt2
                            });
                            map.panTo(pt2);
                        } 
                        
                     });
                }


                <?php
                    $query = mysqli_query($con, "SELECT * FROM tb_puskesmas");
                  while ($data = mysqli_fetch_array($query)) {
                    $lat = $data['lat'];
                    $lon = $data['lng'];
                    $nama = $data['nama_puskesmas'];
                    echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                        
                  }
                ?>

                get_lokasi_klik(map);
                get_lokasi_input (map); 
            }

            function doCenterMap() {
                    $('#map_puskesmas').show();
                    map.setCenter(new google.maps.LatLng(-8.7039, 115.21));
            }
            google.maps.event.addDomListener(window, 'load', init_map);
        </script>
        
            <script async defer 
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj3E3rS61aQhX4jnblfe0l7Y7qx_s8lX4&callback=init_map">
            </script>

    </body>
</html>

<script>
     angular.module('ng_js02', [])

    .controller('MainController',function($scope,$http){
        //set type data 'data' dengan object
        $scope.data_pus = [{lat  : '',lng : '', nama: '', alamat: '', deskrip: '' , tlp:''} ];

        $scope.data_fasili = [{fasilicc  : '1'} ];
        $scope.data_poli = [{policc  : '1'} ];
        
        $scope.data_jnsPus=1;
        $scope.data_pusKec=1;

        $scope.tambah_fasili = function(){
            $scope.data_fasili.push({fasilicc  : $scope.data_fasili.length+1});
        };

        $scope.tambah_poli = function(){
            $scope.data_poli.push({policc  : $scope.data_poli.length+1});
        };

        //fungsi kurangi inputan fasilitas
        $scope.cancel_fasili = function(){
            $scope.data_fasili.splice($scope.data_fasili.length-1);
        };

        //fungsi kurangi inputan
        $scope.cancel_poli = function(){
            $scope.data_poli.splice($scope.data_poli.length-1);
        };

        $scope.reset_input =function(){
            $scope.data_jnsPus = 1;
            $scope.data_fasili = [{fasilicc  : '1'}];
            $scope.data_poli = [{policc  : '1'} ];
            $scope.data_pus = [{lat  : '',lng : '', nama: '', alamat: '', deskrip: '',tlp:'' } ];
        };

        //fungsi simpan
        $scope.simpan = function(){
            var cekNama= false;
            var cekLat=false; 
            var cekLng=false;
            var cekAlamt=false;
            var cekTlp=false;
            var cekDesk=false;
            var CekImg=false;

            if ($('#tx_lat_pus').val() == "" ) {
                $("notif_sukses").hide();
                $('#lat_form_container').addClass('has-error');
                $('#add_lat_msg').html("tidak boleh kosong!");
                cekLat= false;
            }else if ($('#tx_lat_pus').val() != "" ){
                $('#lat_form_container').removeClass('has-error');
                $('#add_lat_msg').html(null);
                cekLat=true;
            }

            if ($('#tx_lng_pus').val() == "" ) {
                $("notif_sukses").hide();
                $('#lng_form_container').addClass('has-error');
                $('#add_lng_msg').html("tidak boleh kosong!");
                cekLng= false;
            }else if ($('#tx_lng_pus').val() != "" ){
                $('#lng_form_container').removeClass('has-error');
                $('#add_lng_msg').html(null);
                cekLng=true;
            }

            if ($('#namPus').val() == "" ) {
                $("notif_sukses").hide();
                $('#nama_form_container').addClass('has-error');
                $('#add_Nama_msg').html("tidak boleh kosong!");
                cekNama= false;
            }else if ($('#namPus').val() != "" ){
                $('#nama_form_container').removeClass('has-error');
                $('#add_Nama_msg').html(null);
                cekNama=true;
            }

            if ($('#tx_alamat').val() == "" ) {
                $("notif_sukses").hide();
                $('#almt_form_container').addClass('has-error');
                $('#add_almt_msg').html("tidak boleh kosong!");
                cekAlamt= false;
            }else if ($('#tx_alamat').val() != "" ){
                $('#almt_form_container').removeClass('has-error');
                $('#add_almt_msg').html(null);
                cekAlamt=true;
            }

            if ($('#tx_telepon').val() == "" ) {
                $("notif_sukses").hide();
                $('#tlp_form_container').addClass('has-error');
                $('#add_tlp_msg').html("tidak boleh kosong!");
                cekTlp= false;
            }else if ($('#tx_telepon').val() != "" ){
                $('#tlp_form_container').removeClass('has-error');
                $('#add_tlp_msg').html(null);
                cekTlp=true;
            }

            if ($('#deskr').val() == "" ) {
                $("notif_sukses").hide();
                $('#deskr_form_container').addClass('has-error');
                $('#add_deskr_msg').html("tidak boleh kosong!");
                cekDesk= false;
            }else if ($('#deskr').val() != "" ){
                $('#deskr_form_container').removeClass('has-error');
                $('#add_deskr_msg').html(null);
                cekDesk=true;
            }
           
            if ($('#img_Pus')[0].files.length == 0) {
                $("notif_sukses").hide();
                $('#img_form_container').addClass('has-error');
                $('#label_foto').addClass('has-error');
                $('#add_img_msg').html("tidak boleh kosong!");
                CekImg= false;
            }else if ($('#img_Pus')[0].files.length != 0){
                $('#img_form_container').removeClass('has-error');
                $('#label_foto').removeClass('has-error');
                $('#add_img_msg').html(null);
                CekImg=true;
            }
            
            if (cekLat&&cekLng&&cekNama&&cekAlamt&&cekTlp&&cekDesk&&CekImg) {
                $http.post('http://localhost/puskesmas02/admin_puskesmas_baru_proses.php?action=insert_jsnPus',$scope.data_jnsPus).success(function(response){
                    $scope.jnsjns=response;
                    if($scope.jnsjns==1){
                         $http.post('http://localhost/puskesmas02/admin_puskesmas_baru_proses.php?action=insert_poli&&idx=<?php echo "$idxss"; ?>&&jnsPus=$scope.data_jnsPus',$scope.data_poli);
                    }
                });

                $http.post('http://localhost/puskesmas02/admin_puskesmas_baru_proses.php?action=insert_fasili',$scope.data_fasili);
            }
            
            
        }
    })
</script>