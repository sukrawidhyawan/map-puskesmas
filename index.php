<?php
  include 'dbconfig.php';
?>
<!DOCTYPE html>
<html >

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Puskesmas</title>
   <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   
 
    
    <style>
        #map_puskesmas img{max-height:none!important;max-width:none!important;background:none!important}
    </style>
    
</head>

<body>
    <div id="wrapper">
        <nav class="navbar top-navbar" role="navigation" style="margin-right: 20px;" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><i class="fa fa-medkit"></i> PUSKESMAS</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
             

                <li>
                    <a aria-expanded="false" data-toggle="modal" data-target="#myModal1">
                        Login
                    </a>
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        
        <div id="page-wrapper" style="padding-left: 0px; padding-right: 0px; padding-top: 0px; margin-left: 0px;">
            <div id="page-inner">
                <div class="row">
                   <div class="col-md-12">
                        <div class="panel panel-default panel-body">

                            <ul class="nav nav-tabs">
                                <li class="active" ><button class="btn btn-warning btn-lg" id="btn_emergen"style="margin-bottom: 0px; margin-right: 10px; margin-top: 10px;" >Emergency</button></li>
                                <li class="" ><a href="#pus_search" data-toggle="tab"><h4><i class="fa fa-search fa-1x"></i></h4></a>
                                </li>
                                <li class=""><a href="#pus_route" data-toggle="tab"><h4><b>Route</b></h4></a>
                                </li>
                                <li class=""><a href="#pus_filter" data-toggle="tab"><h4><b>Show Only</b></h4></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="pus_search">
                                    <div class="col-md-5" style=" margin-top: 15px;">
                                        <label class="control-label">Search</label>
                                        <div class="form-group input-group">
                                            <input class="form-control" placeholder=" Ketik nama Puskesmas.. alamat.. poliklinik.. atau fasilitas" id="inputSerach" onkeyup="SearchPus(this.value)">
                                            <span class="input-group-addon">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>

                                        <div>
                                            <div class="col-md-12" id="searchPusResult"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pus_route">   
                                    <div class="col-md-8">
                                        <div class="col-lg-6" style=" margin-top: 15px;">
                                            <label class="control-label">From</label>
                                            <div class="form-group input-group">
                                                <input class="form-control" placeholder="click GPS button...right click on map.. or type the address then Enter" name="my_lokasi" id="tx_my_lokasi">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" id="mylokasi" onclick="my_location_tttt(map)"><i class="fa fa-crosshairs"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 text-center" style="padding-top: 40px; padding-left: 0px; padding-right: 0px;">
                                            <i class="  fa fa-arrow-right fa-2x" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-lg-5" style="margin-top: 15px;">
                                            <div class="form-group">
                                                <label class="control-label">Destination</label>
                                                <select class="form-control" id="pus_tujuan" name="nama_pusnya" >
                                                    <?php 
                                                        $qq1= 'SELECT* FROM tb_puskesmas';
                                                        $jnsx=mysqli_query($con,$qq1); 
                                                        $yy=0;
                                                        $posisi=[];
                                                        while ($row_pusx = mysqli_fetch_array($jnsx)) { 
                                                            $id_pus=$row_pusx['id_puskesmas'];
                                                            $nama_pus=$row_pusx['nama_puskesmas'];
                                                            $latxx=$row_pusx['lat'];
                                                            $lngxx=$row_pusx['lng'];
                                                            $posisi[$yy]=''.$latxx.','.$lngxx.'';
                                                            echo "<option value = $posisi[$yy]> $nama_pus </option>"; 
                                                            $yy++; 
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div  class="col-md-1">
                                        <button class="btn btn-primary" id="getRoute" style="margin-bottom: 0px; margin-right: 10px; margin-top: 38px;" >Find.. <i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                
                                </div>

                                <div class="tab-pane fade" id="pus_filter">
                                    
                                    <div class="col-lg-2" style="margin-top: 15px; margin-right: 0px; margin-left: 0px">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Puskesmas</label>
                                            <select class="form-control" id="FilterJnsPus" >
                                                <option value = 0> All </option>
                                                <?php 
                                                    $qq2="SELECT * FROM tb_puskesmas_jns ";
                                                    $jnsPus=mysqli_query( $con,$qq2); 
                                                    $yy=1;
                                                    while ($row_jnsPus = mysqli_fetch_array($jnsPus)) { 
                                                        echo '<option value= '.$row_jnsPus['id_jns_puskesmas'].'> '.$row_jnsPus['nama_jenis'].' </option>'; 
                                                        $yy++; 
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2" style="margin-top: 15px;">
                                        <div class="form-group">
                                            <label class="control-label">Fasilitas</label>
                                            <select class="form-control" id="FilterFasilitas">
                                                <option value = 0> All </option>
                                                <?php 
                                                    $qq3="SELECT * FROM tb_fasilitas ";
                                                    $fasiliww=mysqli_query($con, $qq3); 
                                                    $yy=1;
                                                    while ($rowFasili = mysqli_fetch_assoc($fasiliww)) { 
                                                        
                                                        echo '<option value = '.$rowFasili['id_fasilitas'].'> '.$rowFasili['nama_fasilitas'].' </option>'; 
                                                        $yy++; 
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2" style="margin-top: 15px;">
                                        <div class="form-group">
                                            <label class="control-label">Poliklinik</label>
                                            <select class="form-control" id="filterPoli">
                                                <option value = 0> All </option>
                                                <?php 
                                                    $qq4="SELECT * FROM tb_poli ";
                                                     $poliww=mysqli_query($con, $qq4); 
                                                     while ($rPoliww= mysqli_fetch_assoc($poliww)) {
                                                         echo '<option value = '.$rPoliww['id_poli'].'> '.$rPoliww['nama_poli'].' </option>'; 
                                                     }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2" style="margin-top: 15px; margin-right: 0px; margin-left: 0px">
                                        <button class="btn btn-primary" id="filterShow" style="margin-bottom: 0px; margin-right: 0px; margin-top: 24px;" >Show</i></button>
                                    </div>

                                    <div ></div>
                                    <div  class="col-lg-4">
                                        <button class="btn btn-primary btn-lg  pull-right" id="filterShowAll" style="margin-bottom: 0px; margin-right: 0px; margin-top: 24px;" >Show All</i></button>
                                    </div>
                                </div>
                            </div>

                            <div id='map_puskesmas' style='height:850px;width:100%;' ></div>
                        </div>           
                    </div>
                </div>
            </div>
            <!--/. Modal Login  -->
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Login</h4>
                    </div>
                                        
                    <div class="modal-body">
                        <form role="form" method="post" action="login_validasi.php">
                            <div class="form-group">
                                <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
                                <input type="text" class="form-control" name="usrname" id="usrname" placeholder="Enter Username">
                            </div>
                                                
                            <div class="form-group">
                                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                <input type="password" class="form-control" name="psw" id="psw" placeholder="Enter password">
                            </div>
                                                
                            <button type="submit" class="btn btn-primary btn-block">
                                <span class="glyphicon glyphicon-off"></span> 
                                Login
                            </button>
                        </form>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> 
                    </div>
                </div>
            </div>
            <!--/. END Modal Login  -->
            
        </div>
         <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <?php
                $qq5="SELECT * FROM tb_puskesmas";
                $query = mysqli_query($con, $qq5);
                $tt=0;
                $arrayid=[];
                $arrayNama=[];
                $arrayLat=[];
                $arrayLng=[];
                $arrayInfo= [];
                $arrayPosisi=[];
                $arrayFasiliPus=[];
                $arrayPoliPus=[];
                $arrayJnsPus=[];
                while ($data = mysqli_fetch_array($query)) {
                    $id_pus = $data['id_puskesmas'];
                    $lat = $data['lat'];
                    $lng = $data['lng'];
                    $nama_pus = $data['nama_puskesmas'];
                    $alamatx = $data ['alamat'];
                    $telepon = $data['no_hp'];
                    $jnsPus =$data['id_jns_puskesmas'];
                    $imgPus=$data['img'];
                    //------------------------FASILITAS-------------------------------- 
                    $qq6='SELECT * FROM tb_fasilitas_detail 
                                        INNER JOIN tb_fasilitas ON tb_fasilitas_detail.`id_fasilitas`=tb_fasilitas.`id_fasilitas` 
                                        WHERE tb_fasilitas_detail.`id_puskesmas`= '.$id_pus.'';
                    $q_fasili=mysqli_query($con, $qq6);
                    $num_rows_fasili = mysqli_num_rows($q_fasili);
                        
                    if (isset($tot_fasilitas)){
                        unset($tot_fasilitas);
                    }

                    $arrayListFasili=[];
                    if ($num_rows_fasili==0) {
                        $tot_fasilitas="-";
                         $arrayListFasili[0]=-1;
                    }else{
                        $k=0;
                        $no=1;
                        while ($data2 = mysqli_fetch_array($q_fasili)) {
                            $fasilitasx[$k]=$data2['nama_fasilitas'];
                            $id_fasilitasx=$data2['id_fasilitas'];
                            if (isset($tot_fasilitas)) {
                                $tot_fasilitas = ''.$tot_fasilitas.' <br> '.$no.'. '.$fasilitasx[$k].'';
                            } else {
                                $tot_fasilitas=''.$no.'. '.$fasilitasx[$k].'';
                            }
                            $arrayListFasili[$k]=$id_fasilitasx;
                            $k++; $no++;
                        }
                    }
                    //------------------------AGENDA--------------------------------    
                    $q_agenda=mysqli_query($con, 'SELECT DATE_FORMAT(tb_agenda_kegiatan.`tgl_agenda`, "%d %M %Y") AS tgl_kegiatan, nama_agenda FROM tb_agenda_kegiatan WHERE tb_agenda_kegiatan.`id_puskesmas`= '.$id_pus.'');

                    if (isset($tot_agendax)){
                        unset($tot_agendax);
                    }

                    $num_rows_agenda = mysqli_num_rows($q_agenda);
                    
                    if ($num_rows_agenda==0) {
                        $tot_agendax=" Belum Ada";
                    }else{
                        $k=1;
                        while ($br_agenda=mysqli_fetch_array($q_agenda)) {
                            $agendaxx[$k]=$br_agenda['nama_agenda'];
                            $tgl_agendaxx[$k]=$br_agenda['tgl_kegiatan'];

                            if (isset($tot_agendax)) {
                                $tot_agendax = " $tot_agendax <br> <font color='#ffffff'>: </font> $k. $agendaxx[$k] ($tgl_agendaxx[$k]) ";
                            } else {
                                $tot_agendax=" $k. $agendaxx[$k] ($tgl_agendaxx[$k])";
                            }                                  
                            $k++;
                        }
                    }


                    //Puskesmas Kecamatan---------------------------------------------
                    $arrayListpoli=[];
                    if ($data['id_jns_puskesmas']==1) {

                         //--------------------------POLIKLINIK-----------------------------
                        $q_poli=mysqli_query($con, 'SELECT * FROM tb_poli_detail 
                                        INNER JOIN tb_poli ON tb_poli_detail.`id_poli`=tb_poli.`id_poli` 
                                        WHERE tb_poli_detail.`id_puskesmas`= '.$id_pus.'');
                        $num_rows_poli = mysqli_num_rows($q_poli);

                        if (isset($tot_polix)){
                            unset($tot_polix);
                        }

                        if ($num_rows_poli==0) {
                            $tot_polix="-";
                            $arrayListpoli[0]=-1;
                        }else{
                            $k=0;
                            $no=1;
                            while ( $br_poli=mysqli_fetch_array($q_poli)) {
                                $polixx[$k]=$br_poli['nama_poli'];
                                $idPolixx=$br_poli['id_poli'];

                                if (isset($tot_polix)) {
                                    $tot_polix = "$tot_polix <br> $no. $polixx[$k]";
                                } else {
                                        $tot_polix=" $no. $polixx[$k]";
                                }
                                $arrayListpoli[$k]=$idPolixx;
                                $k++;
                                $no++;
                            }; 
                        }

                        $infox =    '<div class="panel panel-heading" style="padding: 0px 0px 5px; border-left-width: 0px;">'.
                                        '<h2 class="text-center"> <img class="pull-left" src="img/logo/logo0.8.png">'.$nama_pus.' </h2>'.
                                    '</div>'.
                                    ' <h2  class="text-center"><img src="img/puskesmas/'.$imgPus.'" width="450" height="200"></h2><br>'.
                                    '<div class="panel table-responsive">'.
                                        '<table class="table table-hover">'.
                                            '<tbody>'.
                                                '<tr>'.
                                                    '<td><b>Alamat</td>'.
                                                    '<td> <b>'.$alamatx.'</td>' . 
                                                ' </tr>'.
                                                '<tr>'.
                                                    '<td> <b> Latitude, Longitude</td>'.
                                                    '<td> <b>'.$lat.', '.$lng.'</td>'.       
                                                '</tr>'.
                                                '<tr>'.
                                                    '<td><b>Telepon</td>'.
                                                    '<td> <b>'.$telepon.'</td>'   .  
                                                '</tr>'.
                                                '<tr>'.
                                                    '<td><b>Poliklinik</td>'.
                                                    '<td><b>'.$tot_polix.'</td>'.  
                                                '</tr>'.
                                                '<tr>'.
                                                    '<td><b>Fasilitas</td>'.
                                                    '<td><b>'.$tot_fasilitas.'</td>'.  
                                                '</tr>'.

                                                '<tr class="alert alert-success">'.
                                                    '<td><b>Agenda Kegiatan</td>'.
                                                    '<td><b>'.$tot_agendax.'</td>'.  
                                                '</tr>'.
                                            '</tbody>'.
                                        '</table>'.
                                    '</div>'.
                                    '<button type="button" class="btn btn-primary pull-left" onclick="directFromPus(map, '.$lat.', '.$lng.')">'.
                                        '<i class="fa fa-map-marker"></i>  <span>Direct to My Location</span>'.
                                    '</button>'; 

                    }else if ($data['id_jns_puskesmas']==2){
                        $arrayListpoli[0]=-1;
                        $infox =    '<div class="panel panel-heading" style="padding: 0px 0px 5px; border-left-width: 0px;">'.
                                        '<h2 class="text-center"> <img class="pull-left" src="img/logo/logo0.8.png"> '.'<font color="#ffffff">: </font>'.$nama_pus.' </h2>'.
                                    '</div>'.
                                   ' <h2  class="text-center"><img src="img/puskesmas/'.$imgPus.'" width="450" height="200"></h2><br>'.
                                    '<div class="panel table-responsive">'.
                                        '<table class="table table-hover">'.
                                            '<tbody>'.
                                                '<tr>'.
                                                    '<td><b>Alamat</td>'.
                                                    '<td> <b>'.$alamatx.'</td>' . 
                                                ' </tr>'.
                                                '<tr>'.
                                                    '<td> <b> Latitude, Longitude</td>'.
                                                    '<td> <b>'.$lat.', '.$lng.'</td>'.       
                                                '</tr>'.
                                                '<tr>'.
                                                    '<td><b>Telepon</td>'.
                                                    '<td> <b>'.$telepon.'</td>'   .  
                                                '</tr>'.
                                                '<tr>'.
                                                    '<td><b>Fasilitas</td>'.
                                                    '<td><b>'.$tot_fasilitas.'</td>'.  
                                                '</tr>'.

                                                '<tr class="alert alert-success">'.
                                                    '<td><b>Agenda Kegiatan</td>'.
                                                    '<td><b>'.$tot_agendax.'</td>'.  
                                                '</tr>'.
                                            '</tbody>'.
                                        '</table>'.
                                    '</div>'.
                                    '<button type="button" class="btn btn-primary pull-left" onclick="directFromPus(map, '.$lat.', '.$lng.')" >'.
                                        '<i class="fa fa-map-marker"></i>  <span>Direct to My Location</span>'.
                                    '</button>'; 
                    }
                    //echo ("showMarker(bounds,map,  $lat, $lng, '$infox', $tt);\n");                    
                   //echo ("addMarker(bounds,map,  $lat, $lng, '$infox');\n");

                    $arrayid[$tt]=$id_pus;
                    $arrayNama[$tt]=$nama_pus;
                    $arrayLat[$tt]=$lat;
                    $arrayLng[$tt]=$lng;
                    $arrayInfo[$tt]=$infox;
                    $arrayPosisi[$tt]=$posisi[$tt];
                    $arrayFasiliPus[$tt]=$arrayListFasili;
                    $arrayPoliPus[$tt]=$arrayListpoli;
                    $arrayJnsPus[$tt]=$jnsPus;
                    $tt++;                     
                }

            ?>
    <!-- /. WRAPPER  -->
     <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>

    
   
    <script >
        var map;
        var infoWindow;
        var marker;
        var myPosition;
        var marker_geo;
        
        var bounds;
        var boundFilter;

        var directionsService,
            directionsDisplay;

        var my_latx,
            my_lngx;

        var markersArray1 = [],
            arrayInfo = <?php echo json_encode($arrayInfo);?>,
            arrayid=<?php echo json_encode($arrayid); ?>,
            arrayNama=<?php echo json_encode($arrayNama);?>,
            arrayLat=<?php echo json_encode($arrayLat);?>,
            arrayLng=<?php echo json_encode($arrayLng);?>,
            arrayPosisi=<?php echo json_encode($arrayPosisi);?>,
            arrayJnsPus=<?php echo json_encode($arrayJnsPus); ?>;

        var arrayFasiliPud=<?php echo json_encode($arrayFasiliPus); ?>;
        var arrayPoliPud=<?php echo json_encode($arrayPoliPus); ?>;

        function init_map(){
            var myOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var posisiMap = {lat:  -8.798273, lng: 115.172371};
            map = new google.maps.Map(document.getElementById('map_puskesmas'), {
              zoom: 10,
              center: posisiMap,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            infoWindow = new google.maps.InfoWindow;      
            bounds = new google.maps.LatLngBounds();            
            
            var e=0;
            while  (e<arrayid.length){
                showMarker(bounds,map,  arrayLat[e], arrayLng[e], arrayInfo[e], e);
                e++;
            }

            var findRoute = function() {
                var FromPos=document.getElementById('tx_my_lokasi').value;
                var DestiPos=document.getElementById('pus_tujuan').value;
                var ss='CariRute';
                calculateAndDisplayRoute(ss, FromPos,DestiPos);
            };
               
            var emergency = function(){
               find_closest_Pus();
            }
            
            var filterShowAll = function(){
                var markerxx, a=0;
                while (a<arrayid.length){
                    markerxx=markersArray1[a];
                    if (!markerxx.getVisible()) {
                        markerxx.setVisible(true);
                    }
                    infoWindow.close(map, markerxx);
                    a++;
                }
                map.fitBounds(bounds);
                if (marker_geo.getVisible()) {
                    marker_geo.setVisible(false);
                }
                if (directionsDisplay !== undefined) {
                    directionsDisplay.setMap(null);
                }
            }

            var FilterResult= function(){
                filterProses(map,bounds);
            }

            get_lokasi_klik(map);
            document.getElementById('tx_my_lokasi').addEventListener('change', findRoute);
            document.getElementById('pus_tujuan').addEventListener('change', findRoute);
            document.getElementById('getRoute').addEventListener('click', findRoute);

            document.getElementById('btn_emergen').addEventListener('click', emergency);

            document.getElementById('filterShow').addEventListener('click', FilterResult);
            document.getElementById('filterShowAll').addEventListener('click', filterShowAll);

            
        }

        function directFromPus(map, latPus,lngPus){
             if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        myPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        
                        if (marker_geo!=null) {
                            marker_geo.setPosition(myPosition);                    
                        }else{
                            marker_geo = new google.maps.Marker({
                                map: map,
                                position: myPosition,
                                icon:"img/marker/my_location2.png"
                            });
                        }     
                        if (!marker_geo.getVisible()) {
                          marker_geo.setVisible(true);
                        }
                        google.maps.event.addListener(marker_geo, 'click', function(){
                            infoWindow.setContent("Your location");
                            infoWindow.open(map, marker_geo);
                        });                  
                        
                        var ss='routeFromPus';
                        var FromPusPos=latPus+','+lngPus;

                        calculateAndDisplayRoute(ss, myPosition, FromPusPos);
                    }, function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    handleLocationError(false, infoWindow, map.getCenter());
                }
        }

        function filterProses (map, bounds){
            var SelectedJenis=document.getElementById('FilterJnsPus').value;
            var SelectedFasili=document.getElementById('FilterFasilitas').value;
            var SelectedPoli=document.getElementById('filterPoli').value;
            boundFilter = new google.maps.LatLngBounds();

            var markertt; 
            var tmpResult, w, w2, q=0;
            while (q<arrayid.length){
                infoWindow.close(map, markertt);
                markertt=markersArray1[q];
                markertt.setVisible(false);
                
                if((SelectedFasili==0) && (SelectedJenis==0) && (SelectedPoli==0)) {
                    if (!markertt.getVisible()) {
                        markertt.setVisible(true);
                    }
                    var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                    boundFilter.extend(posFilter);
                }

                if((SelectedJenis!=0) && (SelectedFasili==0) && (SelectedPoli==0)) {
                    if (SelectedJenis==arrayJnsPus[q]) {
                        if (!markertt.getVisible()) {
                            markertt.setVisible(true);
                        }
                        var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                        boundFilter.extend(posFilter);
                    }
                }

                if((SelectedJenis!=0) && (SelectedFasili!=0) && (SelectedPoli==0)){
                    w=0;
                    while (w < arrayFasiliPud[q].length){
                       if ((SelectedJenis==arrayJnsPus[q]) && (SelectedFasili == arrayFasiliPud[q][w]) ) {
                            if (!markertt.getVisible()) {
                                markertt.setVisible(true);
                            }
                            var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                            boundFilter.extend(posFilter);
                            break;
                       }else{
                             markertt.setVisible(false);
                       }
                      w++;
                    }
                }

                
                if((SelectedJenis!=0) && (SelectedFasili==0) && (SelectedPoli!=0)){
                    w=0;
                    while (w < arrayPoliPud[q].length){
                        if ((SelectedJenis==arrayJnsPus[q]) && (SelectedPoli == arrayPoliPud[q][w]) ) {
                            if (!markertt.getVisible()) {
                                markertt.setVisible(true);
                            }
                            var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                            boundFilter.extend(posFilter);
                            break;
                        }
                        w++;
                    }
                }

                if((SelectedJenis==0) && (SelectedFasili==0) && (SelectedPoli!=0)){
                    w=0;
                    while (w < arrayPoliPud[q].length){
                        if (SelectedPoli == arrayPoliPud[q][w]) {
                            if (!markertt.getVisible()) {
                                markertt.setVisible(true);
                            }
                            var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                            boundFilter.extend(posFilter);
                            break;
                        }
                        w++;
                    }
                }

                if ((SelectedJenis==0) && (SelectedFasili!=0) && (SelectedPoli!=0)) {
                    w=0;
                    while (w < arrayFasiliPud[q].length){
                       if ((SelectedFasili == arrayFasiliPud[q][w])) {
                            w2=0;
                            while  (w2 < arrayPoliPud[q].length){
                                if (SelectedPoli == arrayPoliPud[q][w2]) {
                                    if (!markertt.getVisible()) {
                                        markertt.setVisible(true);
                                    }
                                    var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                                    boundFilter.extend(posFilter);
                                    break;
                                }
                                w2++;
                            }
                            break;
                       }
                      w++;
                    }
                }

                if ((SelectedJenis==0) && (SelectedFasili!=0) && (SelectedPoli==0)) {
                    w=0;
                    while (w < arrayFasiliPud[q].length){
                       if ((SelectedFasili == arrayFasiliPud[q][w])) {
                            if (!markertt.getVisible()) {
                                markertt.setVisible(true);
                            }
                            var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                            boundFilter.extend(posFilter);
                            break;
                       }
                      w++;
                    }
                }

                if ((SelectedJenis!=0) && (SelectedFasili!=0) && (SelectedPoli!=0)) {
                    w=0;
                    while (w < arrayFasiliPud[q].length){
                       if ((SelectedJenis==arrayJnsPus[q]) && (SelectedFasili == arrayFasiliPud[q][w])) {
                            w2=0;
                            while  (w2 < arrayPoliPud[q].length){
                                if ((SelectedJenis==arrayJnsPus[q]) && (SelectedPoli == arrayPoliPud[q][w2])) {
                                    if (!markertt.getVisible()) {
                                        markertt.setVisible(true);
                                    }
                                    var posFilter= new google.maps.LatLng (arrayLat[q], arrayLng[q]);
                                    boundFilter.extend(posFilter);
                                    break;
                                }
                                w2++;
                            }
                            break;
                       }
                      w++;
                    }
                }

                q++;
            }

            if (posFilter!=undefined) {
               map.fitBounds(boundFilter);
            }
            

            

            if (marker_geo.getVisible()) {
                marker_geo.setVisible(false);
            }
            if (directionsDisplay !== undefined) {
                directionsDisplay.setMap(null);
            }
        }


        function get_lokasi_klik (map){
            google.maps.event.addListener(map,'rightclick',function(event){  
                var lat_klik = event.latLng.lat();
                var lng_klik = event.latLng.lng();

                var pt2 = new google.maps.LatLng(lat_klik, lng_klik);
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({ 'latLng': pt2 }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $("#tx_my_lokasi").val(results[0].formatted_address);
                            if (marker_geo!=null) {
                                marker_geo.setPosition(pt2);                    
                            }else{
                                marker_geo = new google.maps.Marker({
                                    map: map,
                                    position: pt2,
                                    icon:"img/marker/my_location2.png"
                                });
                            }
                            if (!marker_geo.getVisible()) {
                                marker_geo.setVisible(true);
                            }    
                            var ss='CariRute';
                            var DestiPos=document.getElementById('pus_tujuan').value;
                            calculateAndDisplayRoute(ss, pt2,DestiPos);
                        }
                    }
                });

                    
            }); 
        }

        function find_closest_Pus() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        myPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        
                        if (marker_geo!=null) {
                            marker_geo.setPosition(myPosition);                    
                        }else{
                            marker_geo = new google.maps.Marker({
                                map: map,
                                position: myPosition,
                                icon:"img/marker/my_location2.png"
                            });
                        }     
                        if (!marker_geo.getVisible()) {
                          marker_geo.setVisible(true);
                        }
                        google.maps.event.addListener(marker_geo, 'click', function(){
                            infoWindow.setContent("Your location");
                            infoWindow.open(map, marker_geo);
                        });

                        var terdekat, j, i=0;
                        $.each(markersArray1,function(){
                            var distance=google.maps.geometry.spherical.computeDistanceBetween(this.getPosition(),myPosition);
                            if(!terdekat || (terdekat.jr_terdekat > distance)){
                                terdekat={markersArray1:this,
                                jr_terdekat:distance}
                                j=i;
                            }
                            i++;
                        });
                  
                        if(terdekat){
                            if (directionsDisplay !== undefined) {
                                directionsDisplay.setMap(null);
                            }
                            $('#searchPusResult').html('');
                            $("#inputSerach").val('');
                            var ss='Emergency';
                            calculateAndDisplayRoute(ss, myPosition,arrayPosisi[j]);
                            //google.maps.event.trigger(terdekat.marker,'click')
                        }
                       
                    }, function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    handleLocationError(false, infoWindow, map.getCenter());
                } 
   
        }

        function showMarker (bounds, map, lat, lng, info,j){
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);

            markersArray1.push(new google.maps.Marker({
                    map: map,
                    position: pt,
                    icon: "img/marker/marker4.png"
                  }));
            map.fitBounds(bounds);
            bindInfoWindow(markersArray1[j], map, infoWindow, info,j);
        }

        function bindInfoWindow(marker, map, infoWindow, html,j) {
            google.maps.event.addListener(marker, 'click', function() {
                if (directionsDisplay !== undefined) {
                    directionsDisplay.setMap(null);
                }
                $('#searchPusResult').html('');
                $("#inputSerach").val('');
                infoWindow.setContent(html);
                infoWindow.open(map, marker);

            });
        }

        function my_location_tttt(map) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    myPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                    if (marker_geo!=null) {
                            marker_geo.setPosition(myPosition);                    
                    }else{
                        marker_geo = new google.maps.Marker({
                            map: map,
                            position: myPosition,
                            icon:"img/marker/my_location2.png"
                        });
                    } 
                    if (!marker_geo.getVisible()) {
                        marker_geo.setVisible(true);
                    }                   
                    map.setCenter(myPosition);
                    google.maps.event.addListener(marker_geo, 'click', function(){
                        $('#searchPusResult').html('');
                        $("#inputSerach").val('');
                        infoWindow.setContent("Your location");
                        infoWindow.open(map, marker_geo);
                    });

                    if (directionsDisplay !== undefined) {
                        directionsDisplay.setMap(null);
                    }    
                        
                    if (infoWindow !== undefined) {
                        infoWindow.setMap(null);
                    }
                    $('#searchPusResult').html('');
                    $("#inputSerach").val('');
                    infoWindow.setContent("Your location")
                    infoWindow.open(map, marker_geo);

                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        $("#mylokasi").click(function(event) {
          event.preventDefault();

          navigator.geolocation.getCurrentPosition(function(position) {
            myPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK)
                $("#tx_my_lokasi").val(results[0].formatted_address);
              else
                $("#error").append("Unable to retrieve your address<br />");
            });
          },
          function(positionError){
            $("#error").append("Error: " + positionError.message + "<br />");
          },
          {
            enableHighAccuracy: true,
            timeout: 15 * 1000 // 10 seconds
          });
        });


        function calculateAndDisplayRoute(jnis,FromPos, DestiPos) {
            if (directionsDisplay !== undefined) {
                directionsDisplay.setMap(null);
            }

            directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
            directionsService = new google.maps.DirectionsService;
            directionsDisplay.setMap(map);

            directionsService.route({
                origin: FromPos, 
                destination: DestiPos,
                travelMode: google.maps.TravelMode.DRIVING
            }, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);                    
                    var leg = response.routes[ 0 ].legs[ 0 ];
                    var jarak=leg.distance.text;
                    var waktu =leg.duration.text;

                    $('#searchPusResult').html('');
                    $("#inputSerach").val('');
                    if (marker_geo!=null) {
                        marker_geo.setPosition(leg.start_location);                    
                    }else{
                        marker_geo = new google.maps.Marker({
                            map: map,
                            position: leg.start_location,
                            icon:"img/marker/my_location2.png"
                        });
                    } 
                    if (!marker_geo.getVisible()) {
                        marker_geo.setVisible(true);
                    }

                    

                    if (jnis=='CariRute'){
                        var uu=0;
                        while (arrayPosisi[uu] != DestiPos) {
                             uu++;
                        }

                        bounds.extend(leg.start_location);
                        map.fitBounds(bounds);
                        var info='<h4> '+arrayNama[uu]+' </h4>'+
                                         '<div class="alert alert-info">'+
                                            'Jarak : <b>'+jarak+
                                            '</b><br> Waktu Tempuh : <b>'+waktu+
                                        '</div>'   ;
                        infoWindow.setContent(info);
                        infoWindow.open(map, markersArray1[uu]);  
                    }

                    if(jnis=='Emergency'){
                        var uu=0;
                        while (arrayPosisi[uu] != DestiPos) {
                             uu++;
                        }

                        var infoNearest='<h4> <i class="fa fa-ambulance" aria-hidden="true"></i>  Emergency!! </h4>'  + 
                                        '<div class="alert alert-warning">'+
                                            'Puskesmas Terdekat : <b>' + arrayNama[uu]+
                                            '</b><br>Jarak : <b>'+jarak+
                                            '</b><br> Waktu Tempuh : <b>'+waktu+
                                        '</div>';
                        infoWindow.setContent(infoNearest);
                        infoWindow.open(map, markersArray1[uu]);
                        map.setCenter(markersArray1[uu]);
                    }

                    if (jnis=='routeFromPus') {
                        var uu=0;
                        while (arrayPosisi[uu] != DestiPos) {
                             uu++;
                        }

                        var infoForUser='<h4> Rute ke '+arrayNama[uu]+' </h4>'+
                                         '<div class="alert alert-info">'+
                                            'Jarak : <b>'+jarak+
                                            '</b><br> Waktu Tempuh : <b>'+waktu+
                                        '</div>'   ;
                        infoWindow.setContent(infoForUser);
                        infoWindow.open(map, marker_geo);
                        map.setCenter(markersArray1[uu]);
                    }
                                     
              } else {
                window.alert('Directions request failed due to ' + status);
              }

            });
        }
        google.maps.event.addDomListener(window, 'load', init_map);
        
        function SearchPus(dicari) {
            if (dicari.length > 0) {
                $('#searchPusResult').load('SearchPuskesmas.php?ff=' + dicari);
            } else {
                $('#searchPusResult').html('');
            }
        }

        function ShowInfo(map, idPus){
            var i=0;
            while (arrayid[i] != idPus) {
                i++;
            }
            infoWindow.setContent(arrayInfo[i]);
            infoWindow.open(map, markersArray1[i]);
            map.setCenter(new google.maps.LatLng(arrayLat[i],arrayLng[i]));

            $('#searchPusResult').html('');
            $("#inputSerach").val('');

            if (directionsDisplay !== undefined) {
                directionsDisplay.setMap(null);
            }

            if (marker_geo.getVisible()) {
              marker_geo.setVisible(false);
            }
            
        }
    </script>

    <script async defer 
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj3E3rS61aQhX4jnblfe0l7Y7qx_s8lX4&callback=init_map&libraries=geometry">
        </script>
</body>

</html>