<?php
if($type == 'textarea')
{
    $inputmode = '<textarea class="form-control" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""></textarea>';
    $inputmode_update = '<textarea class="form-control" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""><?= $edit->'.$col['name'].';?></textarea>';
}else{
    $inputmode = '<input type="'.$type.'" class="form-control" name="'.$col['name'].'" id="'.$col['name'].'" placeholder="">';
    if($col['name'] == 'id'){
        $inputmode_update = '<input type="hidden" class="form-control" value="<?= base64_encode($edit->'.$col['name'].');?>" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""/>';
    }else{
        $inputmode_update = '<input type="'.$type.'" class="form-control" value="<?= $edit->'.$col['name'].';?>" name="'.$col['name'].'" id="'.$col['name'].'" placeholder=""/>';
    }
}

if(!empty($_POST['category'] == '1'))
{

$html_code .= '
<div class="form-group">
    <label for="'.$col['name'].'">'.$label.'</label>
    '.$inputmode.'
</div>
';
if($col['name'] != 'id'){
$html_code_update .= '
<div class="form-group">
    <label for="'.$col['name'].'">'.$label.'</label>
    '.$inputmode_update.'
</div>
';
}else{
 $html_code_update .= '
<div class="form-group">
    '.$inputmode_update.'
</div>
';
}
}else{

// result kode html create horizontal form ---
$html_code .= '
<div class="form-group row">
    <label for="'.$col['name'].'" class="col-sm-3 col-form-label">'.$label.'</label>
    <div class="col-sm-9">
        '.$inputmode.'
    </div>
</div>
';

// result kode html update horizontal form ---
$html_code_update .= '
<div class="form-group row">
    <label for="'.$col['name'].'" class="col-sm-3 col-form-label">'.$label.'</label>
    <div class="col-sm-9">
        '.$inputmode_update.'
    </div>
</div>
';

}