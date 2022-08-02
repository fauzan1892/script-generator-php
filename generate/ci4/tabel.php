<?php
$html_code_tabel .= '
<div class="table-responsive">
    <table class="table table-striped" id="example1">
        <thead>
            <tr>
                <th>No</th>';

        // for kolom crud laravel --
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
            if($col['name']  != 'id')
            {
    $html_code_tabel .= '
                <th>'.$label.'</th>';  
            }

        }

    $html_code_tabel .= '
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no =1;
                foreach($'.$table.' as $r){
            ?>
            <tr>
                <td><?= $no;?></td>';
        // for kolom crud laravel --
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
            if($col['name']  != 'id')
            {
    $html_code_tabel .= '      
                <td><?=$r->'.$col['name'].';?></td>';  
            }
        }
    $html_code_tabel .= '
                <td>
                    <div class="btn-group" role="group" aria-label="Action Area">
                        <a href="<?= base_url("'.$baseurl.'/edit/".base64_encode($r->id));?>" 
                            class="btn btn-success btn-sm" title="Edit">
                            <i class="fa fa-edit"></i> 
                        </a> 
                        <a href="<?= base_url("'.$baseurl.'/delete/".base64_encode($r->id));?>" 
                            class="btn btn-danger btn-sm" 
                            onclick="javascript:return confirm(`Data ingin dihapus ?`);" title="Delete">
                            <i class="fa fa-times"></i> 
                        </a>
                    </div>
                </td>
            </tr>
            <?php $no++; }?>
        </tbody>
    </table>
</div>
';