<?php 
include 'dbconfig.php';
 ?>
 
<a href='admin_puskesmas_baru.php'>
    <button type='submit' class='btn btn-info btn-md' style="margin-bottom: 15px; margin-top: 15px;">
        <i class='glyphicon glyphicon-plus-sign'></i> Puskesmas Baru 
    </button>
</a>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="data-puspu">
        <thead>
            <tr>                                                
                <th class='text-center'>No</th>
                <th class='text-center'>Nama Puskesmas Pembantu</th>
                <th class='text-center'>Alamat</th>
                <th class='text-center'>No Hp</th>
                <th class='text-center' > Puskesmas Kecamatan </th>
                <th class='text-center' > Action </th>                                                                                
            </tr>
        </thead>
                                            
        <tbody>                                                    
        <?php  

            $pus_kec=mysqli_query($con ,"
                SELECT 
                    tb_puskesmas_pembantu.id_puskesmas, 
                    tb_puskesmas.nama_puskesmas
                FROM tb_puskesmas_pembantu
                INNER JOIN tb_puskesmas 
                ON tb_puskesmas_pembantu.id_puskesmas = tb_puskesmas.id_puskesmas") or die (mysqli_error());
                                                                
                $k=1;
                while ($br=mysqli_fetch_array($pus_kec)) {                                            
                    $id=$br["id_puskesmas"];
                    $nama=$br["nama_puskesmas"]; 
                    $daf_pus_kec[$k]=$nama;
                    $daf_id_pu[$k] = $id;                                                  
                    $k++;                                     
                }
                                                    
                $puspu=mysqli_query($con, "
                    SELECT 
                        
                        tb_puskesmas_pembantu.id_pp, 
                        tb_puskesmas.nama_puskesmas,
                        tb_puskesmas.alamat, 
                        tb_puskesmas.no_hp
                    FROM tb_puskesmas_pembantu
                    INNER JOIN tb_puskesmas 
                    ON tb_puskesmas_pembantu.id_pp = tb_puskesmas.id_puskesmas") or die (mysqli_error());
                                                                
                $k=1;
                while ($br2=mysqli_fetch_array($puspu)) {                                                 
                    $id_puspu=$br2['id_pp'];
                    $nama_puspu=$br2['nama_puskesmas']; 
                    $alamat_puspu=$br2['alamat'];
                    $no_hp_puspu=$br2['no_hp'];       

                    echo"<tr>                                                            
                            <td>$k</td>
                            <td>$nama_puspu</td>
                            <td>$alamat_puspu</td>
                            <td>$no_hp_puspu</td>
                            <td>$daf_pus_kec[$k]</td>
                                                                    
                            <td class='text-center'>
                                <button class='btn btn-primary btn-xs' style='margin-top: 2px;'data-toggle='modal' onclick='showDetPusPu($id_puspu)'>
                                    <i class='glyphicon glyphicon-align-justify'></i> Detail...
                                </button>

                                <a href='admin_home_Edit.php?xx=$id_puspu'>
                                    <button type='submit' class='btn btn-warning btn-xs' style='margin-top: 2px;'>
                                        <i class='fa fa-edit'></i> Edit
                                    </button>
                                </a>

                                <button class='btn btn-danger btn-xs' style='margin-top: 2px;'data-toggle='modal' onclick='showHapusPu($id_puspu)'>
                                    <i class='glyphicon glyphicon-trash'></i> Hapus
                                </button> 
                            </td>
                        </tr>                                                            
                    ";
                    $k++;           
                }
        ?>
        </tbody>
    </table>
</div>