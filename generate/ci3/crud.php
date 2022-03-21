<?php

$html_insert .= '
    public function store()
    {
    ';
$html_update .= '
    public function update()
    {
    $id =  (int)$this->input->post("id"); // parameter yang mau di update
    ';
$html_delete .= '
    public function delete()
    {
        $id = (int)$this->input->get("id");
        $cek = $this->db->get_where("'.$table.'",["" => $id]); // tulis id yang dituju
        if($cek->num_rows() > 0)
        {
            $this->db->where("id",$id); // tulis id yang dituju
            $this->db->delete("'.$table.'");
            $this->session->set_flashdata("success"," Berhasil Hapus Data ! ");
            redirect(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Hapus Data ! "]);
        }else{
            $this->session->set_flashdata("failed"," Gagal Hapus Data ! ".validation_errors());
            redirect(base_url("'.$baseurl.'"));
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
$html_insert .= '
        $this->form_validation->set_rules("'.$col['name'].'", "'.$label.'", "required");';  
$html_update .= '
        $this->form_validation->set_rules("'.$col['name'].'", "'.$label.'", "required");'; 
            }

        }

$html_insert .= '
        if($this->form_validation->run() != false) {
        
            $data = [
    ';
$html_update .= '
        if($this->form_validation->run() != false) {

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
$html_insert .= "           '".$col['name']."' => ".'htmlspecialchars($this->input->post("'.$col['name'].'", TRUE) ,ENT_QUOTES),
    ';   
$html_update .= "           '".$col['name']."' => ".'htmlspecialchars($this->input->post("'.$col['name'].'", TRUE) ,ENT_QUOTES),
    ';  
            }
        }
$html_insert .= '
            ];

            $this->db->insert("'.$table.'", $data);
            $this->session->set_flashdata("success"," Berhasil Tambah Data ! ");
            redirect(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Tambah Data ! "]);
        }else{
            $this->session->set_flashdata("failed"," Gagal Tambah Data ! ".validation_errors());
            redirect(base_url("'.$baseurl.'"));
            // echo json_encode(["cek" => "error", "msg" => "".validation_errors()]);
        }
    }';
$html_update .= '
            ];

            $this->db->where("id", $id); // ubah id dan postnya
            $this->db->update("'.$table.'", $data);
            $this->session->set_flashdata("success"," Berhasil Update Data ! ");
            redirect(base_url("'.$baseurl.'/edit/".$id));
			// echo json_encode(["cek" => "success", "msg" => "Berhasil Update Data ! "]);
        }else{
            $this->session->set_flashdata("failed"," Gagal Update Data ! ".validation_errors());
            redirect(base_url("'.$baseurl.'/edit/".$id));
            // echo json_encode(["cek" => "error", "msg" => "".validation_errors()]);
        }
    }';