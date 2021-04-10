<?php
if($type == 'textarea')
{
    $inputmode = '<textarea class="form-control" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""></textarea>';
    $inputmode_update = '<textarea class="form-control" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""><?= $edit->'.$col['name'].';?></textarea>';
}else{
    $inputmode = '<input type="'.$type.'" class="form-control" name="'.$col['name'].'" id="'.$col['name'].'" placeholder="">';
    $inputmode_update = '<input type="'.$type.'" class="form-control" value="<?= $edit->'.$col['name'].';?>" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""/>';
}

if(!empty($_POST['category'] == '1'))
{

$html_code .= '
<div class="form-group">
    <label for="">'.$label.'</label>
    '.$inputmode.'
</div>
';
$html_code_update .= '
<div class="form-group">
    <label for="">'.$label.'</label>
    '.$inputmode_update.'
</div>
';

}else{

// result kode html create horizontal form ---
$html_code .= '
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">'.$label.'</label>
    <div class="col-sm-9">
        '.$inputmode.'
    </div>
</div>
';

// result kode html update horizontal form ---
$html_code_update .= '
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">'.$label.'</label>
    <div class="col-sm-9">
        '.$inputmode_update.'
    </div>
</div>
';

}