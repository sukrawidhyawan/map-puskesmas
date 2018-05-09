
                                                <?php  

                                                include "dbconfig.php";
                                                    $fasilitasx=mysqli_query($con, "SELECT * FROM  tb_fasilitas") or die (mysqli_error());
                                                                
                                                    $k=1;
                                                    while ($br_fasili=mysqli_fetch_array($fasilitasx)) {
                                                                   
                                                        $id_fasilixx=$br_fasili['id_fasilitas'];
                                                        $nama_fasilixx=$br_fasili['nama_fasilitas']; 
                                                                echo"<tr>                                                            
                                                                    <td class='text-center' >$k</td>
                                                                    <td>$nama_fasilixx</td>
                                                            
                                                                    <td class='text-center'>      
                                                                            <button 
                                                                                class='btn btn-warning btn-xs' style='margin-top: 2px;' 
                                                                                data-toggle='modal' 
                                                                                onclick='showEditFasili($id_fasilixx)'
                                                                            >
                                                                                <i class='fa fa-edit'></i> Edit
                                                                            </button>
                                                                        
                                                                        
                                                                            <button 
                                                                                class='btn btn-danger btn-xs' style='margin-top: 2px;' 
                                                                                data-toggle='modal' 
                                                                                onclick='showHapusFasili($id_fasilixx)'
                                                                            >
                                                                                <i class='glyphicon glyphicon-trash'></i> Hapus
                                                                            </button>
                                                                    </td>
                                                                    </tr>                                                            
                                                                        ";
                                                                $k++;    
                                                           
                                                    }
                                            ?>