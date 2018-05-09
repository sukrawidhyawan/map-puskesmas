<?php 
	include "dbconfig.php";


	$polix=mysqli_query($con, "SELECT * FROM  tb_poli");
                                                                
    $k=1;
    while ($br_poli=mysqli_fetch_array($polix)) {
                                                                   
	    $id_polixx=$br_poli['id_poli'];
	    $nama_polixx=$br_poli['nama_poli']; 
	    echo"<tr class='gradeA'>                                                            
	    		<td class='text-center'>$k</td>
	    		<td>$nama_polixx</td>
	                                                            
	            <td class='text-center'>      
	                <button 
	                    class='btn btn-warning btn-xs' style='margin-top: 2px;' 
	                    data-toggle='modal' 
	                    onclick='showEditPoli($id_polixx)'
	                >
	                    <i class='fa fa-edit'></i> Edit
	            	</button>
	                                                                        
	                                                                        
	                <button 
	                    class='btn btn-danger btn-xs' style='margin-top: 2px;' 
	                    data-toggle='modal' 
	                    onclick='showHapusPoli($id_polixx)'
	                >
	                    <i class='glyphicon glyphicon-trash'></i> Hapus
	                </button>
	                                                                         
	            </td>
	    	</tr>                                                            
	    ";
	     $k++;    
                                                           
    }
                                         
 ?>