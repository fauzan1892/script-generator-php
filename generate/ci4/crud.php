<?php

$html_insert .= '
    /* Store a newly created resource in storage. */
    public function store()
    {
    ';
$html_update .= '

    /* Update the specified resource in storage. */
    public function update()
    {
        $id =  base64_decode($this->request->getPost("id")); 
    ';
$html_delete .= '

    /* Remove the specified resource from storage. */
    public function delete($id)
    {
        $edit = $this->'.$table.'->get'.$class.'($id)->getRow();
        if(isset($edit))
        {
            $builder = $this->db->table("'.$table.'");
            $builder->delete(["id" => $id]);

            $this->session->setFlashdata("success", "Berhasil Hapus Data !");
            return redirect()->to(base_url("'.$baseurl.'"));  
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Hapus Data ! "]);
        }else{

            $this->session->setFlashdata("failed","ID : ".$id." cannot be found.");
            return redirect()->to(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "error", "msg" => "Data Tidak Ditemukan ! "]);
        }
    }
}
    ';
        // for kolom codeigniter 3 ---
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
            if($col['name']  != 'id')
            {
                if($col['native_type'] == 'TIMESTAMP') { }else{
$html_insert .= '
        $validate["'.$col['name'].'"] = "required";';         
$html_update .= '
        $validate["'.$col['name'].'"] = "required";';      
                }
            }
        }
$html_insert .= '
        $val = $this->validate($validate);

        if($val){
    ';
$html_update .= '
        $val = $this->validate($validate);
        
        if($val){
    ';
        // for kolom codeigniter 3 ---
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
            if($col['name']  != 'id')
            {
                if($col['native_type'] == 'TIMESTAMP')
                {
$html_insert .= '
            $data["'.$col['name'].'"] = date("Y-m-d H:i:s");';
$html_update .= '   
            $data["'.$col['name'].'"] = date("Y-m-d H:i:s");';
                }else{
              
$html_insert .= '
            $data["'.$col['name'].'"] = $this->request->getPost("'.$col['name'].'", FILTER_SANITIZE_FULL_SPECIAL_CHARS);';         
$html_update .= '
            $data["'.$col['name'].'"] = $this->request->getPost("'.$col['name'].'", FILTER_SANITIZE_FULL_SPECIAL_CHARS);';      
                }
            }
        }
$html_insert .= '

            $builder = $this->db->table("'.$table.'");
            $builder->insert($data);
            $this->session->setFlashdata("success"," Berhasil Tambah Data ! ");
            return redirect()->to(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Tambah Data ! "]);
        }else{
            $this->session->setFlashdata("failed"," Gagal Tambah Data ! ".\Config\Services::validation()->listErrors());
            return redirect()->to(base_url("'.$baseurl.'"));
            // echo json_encode(["cek" => "error", "msg" => "".\Config\Services::validation()->listErrors()]);
        }
    }';
$html_update .= '

            $builder = $this->db->table("'.$table.'");
            $builder->where("id", $id);
            $builder->update($data);
            $this->session->setFlashdata("success"," Berhasil Update Data ! ");
            return redirect()->to(base_url("'.$baseurl.'/edit/".$id));
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Update Data ! "]);
        }else{
            $this->session->setFlashdata("failed"," Gagal Update Data ! ".\Config\Services::validation()->listErrors());
            return redirect()->to(base_url("'.$baseurl.'/edit/".$id));
            // echo json_encode(["cek" => "error", "msg" => "".\Config\Services::validation()->listErrors()]);
        }
    }';