<?php
$html_code_detail .= '
<div class="table-responsive">';
    // for kolom crud laravel --
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

        if($col['name']  != 'id')
        {
$html_code_detail .= '        
        <div class="row mt-3">
            <div class="col-sm-4">'.$label.'</div>
            <div class="col-sm-8"><?= $edit->'.$col['name'].';?></div>
        </div>
';  
        }
    }

$html_code_detail .= '</div>';

$html_code_detail .= '


<div class="table-responsive">
    <table class="table table-striped">
        <tbody>
';
    // for kolom crud laravel --
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

        if($col['name']  != 'id')
        {
$html_code_detail .= '      
            <tr>
                <th>'.$label.'</th>
                <td><?= $edit->'.$col['name'].';?></td>
            </tr>
';  
        }
    }

$html_code_detail .= '
        </tbody>
    </table>
</div>
';