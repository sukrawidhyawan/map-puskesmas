<?php 
include 'dbconfig.php';
?>
    <a href='admin_puskesmas_baru.php'>
        <button type='submit' class='btn btn-info btn-md' style="margin-bottom: 15px; margin-top: 15px;"onclick="showBarupusKec()">
            <i class='glyphicon glyphicon-plus-sign'></i> Puskesmas Baru 
        </button>
    </a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" >
            <thead>
                <tr>                                                
                    <th class='text-center'>No</th>
                    <th class='text-center'>Nama Puskesmas</th>
                    <th class='text-center'>Alamat</th>
                    <th class='text-center'>No Hp</th>
                    <th class='text-center' > Action </th>                                                                      
                </tr>
            </thead>
                                            
            <tbody id="tabel_datapus">                                                    
                <?php  
                    $pus_kec=mysqli_query($con, "
                         SELECT 
                            tb_puskesmas.id_puskesmas, 
                            tb_puskesmas.nama_puskesmas,
                            tb_puskesmas.alamat, 
                            tb_puskesmas.no_hp

                        FROM tb_puskesmas where id_jns_puskesmas=1");
                                                                    
                        $k=1;
                        while ($br_puskec=mysqli_fetch_array($pus_kec)) {                                             
                            $id_puskec=$br_puskec['id_puskesmas'];
                            $nama_puskec=$br_puskec['nama_puskesmas']; 
                            $alamat_puskec=$br_puskec['alamat'];
                            $no_hp_puskec=$br_puskec['no_hp'];       

                            echo"<tr>                                                            
                                    <td>$k</td>
                                    <td>$nama_puskec</td>
                                    <td>$alamat_puskec</td>
                                    <td>$no_hp_puskec</td>                                
                                    <td class='text-center'> 
                                        <button class='btn btn-primary btn-xs' style='margin-top: 2px;'data-toggle='modal' onclick='showDetkec($id_puskec)'>
                                            <i class='glyphicon glyphicon-align-justify'></i> Detail...
                                        </button>

                                        <a href='admin_home_Edit.php?xx=$id_puskec'>
                                            <button class='btn btn-warning btn-xs' style='margin-top: 2px;'>
                                                <i class='fa fa-edit'></i> Edit
                                            </button>
                                        </a>
                                                                                
                                        <button class='btn btn-danger btn-xs' style='margin-top: 2px;'data-toggle='modal' onclick='showHapusKec($id_puskec)'>
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


                         