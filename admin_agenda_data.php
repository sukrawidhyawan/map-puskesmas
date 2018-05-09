<?php 
	include "dbconfig.php";


	$agendax=mysqli_query($con, "SELECT id_agenda, nama_agenda, tgl_agenda, nama_puskesmas, tb_puskesmas.`id_puskesmas`as id_pus FROM  tb_agenda_kegiatan INNER JOIN tb_puskesmas ON tb_agenda_kegiatan.`id_puskesmas`=tb_puskesmas.`id_puskesmas`");
                                                                
    $k=1;
    while ($br_agenda=mysqli_fetch_array($agendax)) {
                                                                   
	    $id_agenda=$br_agenda['id_agenda'];
	    $nama_agenda=$br_agenda['nama_agenda'];
	    $tgl_agenda=$br_agenda['tgl_agenda'];
	    $namaPus= $br_agenda['nama_puskesmas'];
	    $idPUsAgenda =$br_agenda['id_pus'];

	    echo"<tr >                                                            
	    		<td class='text-center'>$k</td>
	    		<td>$nama_agenda</td>
	        	<td>$tgl_agenda</td>  
	        	<td>$namaPus</td>                                            
	            <td class='text-center'>      
	                <button 
	                    class='btn btn-warning btn-xs' style='margin-top: 2px;' 
	                    data-toggle='modal' 
	                    onclick='showEditAgenda($id_agenda)'
	                >
	                    <i class='fa fa-edit'></i> Edit
	            	</button>
	                                                                        
	                                                                        
	                <button 
	                    class='btn btn-danger btn-xs' style='margin-top: 2px;' 
	                    data-toggle='modal' 
	                    onclick='showHapusAgenda($id_agenda)'
	                >
	                    <i class='glyphicon glyphicon-trash'></i> Hapus
	                </button>
	                                                                         
	            </td>
	    	</tr>                                                            
	    ";
	     $k++;    
                                                           
    }
                                         
 ?>