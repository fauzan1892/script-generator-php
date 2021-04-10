<?php
$html_array .= '<?php
$data = [
    ';
            for ($i = 0; $i < $kolom->columnCount(); $i++) {
                $col = $kolom->getColumnMeta($i);
                $col['name'];
                // echo $col['native_type'].' =>'.$col['name'].'<br>';
                $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
                
$html_array .= '    "'.$col['name'].'" =>  htmlentities(strip_tags($_POST["'.$col['name'].'"])),
        ';   

            }
$html_array .= '];';