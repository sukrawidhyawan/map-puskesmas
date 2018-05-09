<?php
    include "dbconfig.php";
    $WordSerach= str_replace("%20"," ",$_GET['ff']);
    $query = 'SELECT * FROM tb_puskesmas WHERE nama_puskesmas LIKE "%' . $WordSerach . '%" OR alamat LIKE "%' . $WordSerach . '%" OR no_hp LIKE "%' . $WordSerach . '%"';
    $result = mysqli_query($con, $query);
    echo 		'<div style="width:92%;background:#fff;position:absolute;z-index:5; solid">'.
    			'<div >'.
    				' <div class="table-responsive">'.
    					'<table class="table table-hover">'.
    						'<tbody>';
    while ($row = mysqli_fetch_array($result)) {
        echo  					'<tr style="border-bottom:1px solid #ccc;cursor:pointer" onmouseout="$(this).removeClass('."'".'alert alert-info'."'".')" onmouseover="$(this).addClass('."'".'alert alert-info'."'".')" onclick="ShowInfo(map, '.$row['id_puskesmas'].')">'.
                					'<td><b>'. $row['nama_puskesmas'] .'</b><br/>'.
                					'<i>' . $row['alamat'] . '</i> </td>'.
                				' </tr>';
    }
    echo 					'</tbody>'.
               			'</table>'.
                    '</div>'.
            	'</div>'.
            '</div>';
?>
