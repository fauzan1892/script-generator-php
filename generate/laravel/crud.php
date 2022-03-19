<?php
$html_insert .= '<?php 
public function store(Request $request)
{
    $validator = \Validator::make($request->all(),[
';
$html_update .= '<?php
public function update(Request $request)
{
    $id =  (int)$request->get("id"); // parameter yang mau di update
    $validator = \Validator::make($request->all(),[
';
$html_delete .= '<?php 
public function delete(Request $request)
{
    $id =  (int)$request->get("id"); // parameter yang mau di update
    $cek = DB::table("'.$table.'")->where(["id" => $id])->first(); // tulis id yang dituju
    if(isset($cek))
    {
        DB::table("'.$table.'")->where(["id" => $id])->delete();
        return redirect(url())->with("success"," Berhasil Delete Data ! ");
    }else{
        return redirect()->back()
        ->withErrors($validator)
        ->with("failed"," Gagal Delete Data ! ");
    }
}
';
    // for kolom crud laravel --
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
        if($col['name']  != 'id')
        {
$html_insert .= '       "'.$col['name'].'" => "required",
';  
$html_update .= '       "'.$col['name'].'" => "required",
';  
        }

    }

$html_insert .= '
    ]);
    if($validator->passes())
    {

        DB::table("'.$table.'")->insert([
';
$html_update .= '
    ]);
    if($validator->passes())
    {
        DB::table("'.$table.'")->where("id",$id)->update([
';

    // for kolom crud laravel --
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
        if($col['name']  != 'id')
        {

$html_insert .= "           '".$col['name']."' => ".'$request->get("'.$col['name'].'"),
';   
$html_update .= "           '".$col['name']."' => ".'$request->get("'.$col['name'].'"),
';  
        }
    }

$html_insert .= '
        ]);
        return redirect()->back()->with("success"," Berhasil Insert Data ! ");
    }else{
        return redirect()->back()
        ->withErrors($validator)
        ->with("failed"," Gagal Insert Data ! ");
    }
}';
$html_update .= '
        ]);
        return redirect()->back()->with("success"," Berhasil Update Data ! ");
    }else{
        return redirect()->back()
        ->withErrors($validator)
        ->with("failed"," Gagal Update Data ! ");
    }
}';
?>