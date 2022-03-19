<?php
if($type == 'textarea')
{
    $inputmode = '<textarea class="form-control @error("'.$col['name'].'") is-invalid @enderror" name="'.$col['name'].'" id="'.$col['name'].'" placeholder="">{{old("'.$col['name'].'")}}</textarea>';
    $inputmode_update = '<textarea class="form-control @error("'.$col['name'].'") is-invalid @enderror" name="'.$col['name'].'" id="'.$col['name'].'" placeholder="">{{$edit->'.$col['name'].'}}</textarea>';
}else{
    $inputmode = '<input type="'.$type.'" class="form-control @error("'.$col['name'].'") is-invalid @enderror" value="{{old("'.$col['name'].'")}}" name="'.$col['name'].'" id="'.$col['name'].'" placeholder="">';
    $inputmode_update = '<input type="'.$type.'" class="form-control @error("'.$col['name'].'") is-invalid @enderror" value="{{$edit->'.$col['name'].'}}" name="'.$col['name'].'" id="'.$col['name'].'" placeholder="">';
}

if(!empty($_POST['category'] == '1'))
{
    $html_code .= '
    <div class="form-group">
        <label for="'.$col['name'].'">'.$label.'</label>
        '.$inputmode.'
        @error("'.$col['name'].'")
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    ';
    $html_code_update .= '
    <div class="form-group">
        <label for="'.$col['name'].'">'.$label.'</label>
        '.$inputmode_update.'
        @error("'.$col['name'].'")
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    ';
}else{

    // result kode html create horizontal form ---
$html_code .= '
    <div class="form-group row">
        <label for="'.$col['name'].'" class="col-sm-3 col-form-label">'.$label.'</label>
        <div class="col-sm-9">
            '.$inputmode.'
            @error("'.$col['name'].'")
                <span class="text-danger">{{ $message }}</span>
            @enderror
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