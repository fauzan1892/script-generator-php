<?php
$html_code_detail .= '
<?php
    $id =  (int)$_POST["id"];
    $sql = "SELECT * FROM '.$table.' WHERE id = ?";
    $row = $connectdb->prepare($sql);
    $row->execute(array($id));
    $edit = $row->fetch(PDO::FETCH_OBJ);
?>
<table class="table table-striped">
    <tbody>
';

    // for kolom crud laravel --
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

$html_code_detail .= '      
        <tr>
            <td scope="row">'.$col['name'].'</td>
            <td>:</td>
            <td><?= $edit->'.$col['name'].';?></td>
        </tr>
';  

    }

$html_code_detail .= '
    </tbody>
</table>
';