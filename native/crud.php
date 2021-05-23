<?php

$html_insert .= '<?php 
// insert store data records code php
    ';
$html_update .= '<?php
// update data records code php
$id =  (int)$_POST["id"]; // should be integer (id)
    ';
$html_delete .= '<?php 
// removed (deleted) data records code php
    $id =  (int)$_POST["id"]; // should be integer (id)
    $sql = "SELECT * FROM '.$table.' WHERE id = ?";
    $row = $connectdb->prepare($sql);
    $row->execute(array($id));
    $cek = $row->rowCount();
    if($cek > 0)
    {
        $sql_delete = "DELETE FROM '.$table.' WHERE id = ?";
        $row_delete = $connectdb->prepare($sql_delete);
        $row_delete->execute(array($id));
        header("Location: ".$baseUrl."'.$table.'");
        exit;
    }else{
        header("Location: ".$baseUrl."'.$table.'");
        exit;
    }
}
    ';
        // for kolom php native ---
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

        }
 // for kolom php native ---
 for ($i = 0; $i < $kolom->columnCount(); $i++) {
    $col = $kolom->getColumnMeta($i);
    $col['name'];
    // echo $col['native_type'].' =>'.$col['name'].'<br>';
    $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

$html_insert .= '        $data[] =  htmlspecialchars($_POST["'.$col['name'].'"]);
';   
$html_update .= '        $data[] =  htmlspecialchars($_POST["'.$col['name'].'"]);
';    
        }

$html_insert .= '
        $sql = "INSERT INTO '.$table.' (';
$html_update .= '
        $data[] = $id;
        $sql = "UPDATE '.$table.' SET ';
        $n = $kolom->columnCount();
        $r = 1;
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
            if($n == $r){
$html_insert .= "".$col['name']."";   
$tanda .= "?";
$html_update .= "".$col['name']." = ? ";  
            }else{

$html_insert .= "".$col['name'].",";   
$html_update .= "".$col['name']." = ?, ";  
$tanda .= "?,";
            }
            $r++;
        }
       
$html_insert .= ' ) VALUES ( '.$tanda.')";
        $row = $connectdb->prepare($sql);
        $row->execute($data);
        header("Location: ".$baseUrl."'.$table.'");
        exit;
}';
$html_update .= ' WHERE id = ? ";

        $row = $connectdb->prepare($sql);
        $row->execute($data);
        header("Location: ".$baseUrl."'.$table.'");
        exit;
}';