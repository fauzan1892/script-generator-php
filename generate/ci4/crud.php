<?php

$html_insert .= '
    public function store()
    {
        $val = $this->validate([
    ';
$html_update .= '
    public function update()
    {
    ';
$html_delete .= '
    public function delete($id)
    {
        $edit = $model->get_where("'.$table.'",["id" => $id])->getRow();
        if(isset($edit))
        {
            $builder = $this->db->table("'.$table.'");
            $builder->delete(["id" => $id]);

            $this->session->setFlashdata("success", "Berhasil Hapus Data !");
            return redirect()->to(base_url("'.$table.'"));  
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Hapus Data ! "]);
        }else{

            $this->session->setFlashdata("failed","ID : ".$id." cannot be found.");
            return redirect()->to(base_url("'.$table.'"));
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
$html_insert .= '           "'.$col['name'].'" => "required",
';  
$html_update .= '           "'.$col['name'].'" => "required",
';  
            }

        }

$html_insert .= '
        ]);

        if($val)
        {
            $data = [
    ';
$html_update .= '
        ]);
        
        if($val)
        {
            $data = [
    ';
        // for kolom codeigniter 3 ---
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
            if($col['name']  != 'id')
            {
$html_insert .= "           '".$col['name']."' => ".'$this->request->getPost("'.$col['name'].'", FILTER_SANITIZE_STRING),
    ';   
$html_update .= "           '".$col['name']."' => ".'$this->request->getPost("'.$col['name'].'", FILTER_SANITIZE_STRING),
    ';  
            }
        }
$html_insert .= '
            ];

            $builder = $this->db->table("'.$table.'");
            $builder->insert($data);
            $this->session->setFlashdata("success"," Berhasil Tambah Data ! ");
            return redirect()->to(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Tambah Data ! "]);
        }else{
            $this->session->setFlashdata("failed"," Gagal Tambah Data ! ".$this->validation->listErrors());
            return redirect()->to(base_url("'.$baseurl.'"));
            // echo json_encode(["cek" => "error", "msg" => "".$this->validation->listErrors()]);
        }
    }';
$html_update .= '
            ];

            $builder = $this->db->table("'.$table.'");
            $builder->where("id", $this->request->getPost("id"));
            $builder->update($data);
            $this->session->setFlashdata("success"," Berhasil Update Data ! ");
            return redirect()->to(base_url("'.$baseurl.'/edit/".$id));
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Update Data ! "]);
        }else{
            $this->session->setFlashdata("failed"," Gagal Update Data ! ".$this->validation->listErrors());
            return redirect()->to(base_url("'.$baseurl.'/edit/".$id));
            // echo json_encode(["cek" => "error", "msg" => "".$this->validation->listErrors()]);
        }
    }';