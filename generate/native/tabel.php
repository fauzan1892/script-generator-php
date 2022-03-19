<?php
$html_code_tabel .= '
<div class="table-responsive">
    <table class="table table-striped" id="example1">
        <thead>
            <tr>
                <th>No</th>
    ';

        // for kolom crud laravel --
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

    $html_code_tabel .= '
                <th>'.$label.'</th>';  

        }

    $html_code_tabel .= '
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no =1;
                $sql = "SELECT * FROM '.$table.' ORDER BY id DESC";
                $row = $connectdb->prepare($sql);
                $row->execute();
                $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                foreach($hasil as $r){
            ?>
            <tr>
                <td><?= $no;?></td>
    ';
        // for kolom crud laravel --
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

    $html_code_tabel .= '      
                <td><?=$r->'.$col['name'].';?></td>';  

        }
    $html_code_tabel .= '
                <td>
                    <a href="<?= $baseUrl."'.$baseurl.'/detail.php?id=".$r->id;?>" 
                        class="btn btn-primary btn-sm" title="Detail">
                        <i class="fa fa-eye"></i> 
                    </a> 
                    <a href="<?= $baseUrl."'.$baseurl.'/edit.php?id=".$r->id;?>" 
                        class="btn btn-success btn-sm" title="Edit">
                        <i class="fa fa-edit"></i> 
                    </a> 
                    <a href="<?= $baseUrl."'.$baseurl.'/hapus.php?id=".$r->id;?>" 
                        class="btn btn-danger btn-sm" 
                        onclick="javascript:return confirm(`Data ingin dihapus ?`);" title="Delete">
                        <i class="fa fa-times"></i> 
                    </a>
                </td>
            </tr>
            <?php $no++; }?>
        </tbody>
    </table>
</div>
';