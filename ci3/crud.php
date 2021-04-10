<?php

$html_insert .= '<?php 
public function store()
{
    ';
$html_update .= '<?php
public function update()
{
$id =  (int)$this->input->post("id"); // parameter yang mau di update
    ';
$html_delete .= '<?php 
public function delete()
{
    $id = (int)$this->input->get("id");
    $cek = $this->db->get_where("'.$table.'",["" => $id]); // tulis id yang dituju
    if($cek->num_rows() > 0)
    {
        $this->db->where("id",$id); // tulis id yang dituju
        $this->db->delete("'.$table.'");
        $this->session->set_flashdata("success"," Berhasil Delete Data ! ");
        redirect(base_url("'.$table.'"));
    }else{
        $this->session->set_flashdata("failed"," Gagal Delete Data ! ".validation_errors());
        redirect(base_url("'.$table.'"));
    }
}
    ';
        // for kolom codeigniter 3 ---
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));

$html_insert .= '
    $this->form_validation->set_rules("'.$col['name'].'", "'.$label.'", "required");';  
$html_update .= '
    $this->form_validation->set_rules("'.$col['name'].'", "'.$label.'", "required");'; 

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

$html_insert .= "       '".$col['name']."' => ".'htmlspecialchars($this->input->post("'.$col['name'].'", TRUE) ,ENT_QUOTES),
    ';   
$html_update .= "       '".$col['name']."' => ".'htmlspecialchars($this->input->post("'.$col['name'].'", TRUE) ,ENT_QUOTES),
    ';  
   

            }
$html_insert .= '
        ];

        $this->db->insert("'.$table.'", $data);
        $this->session->set_flashdata("success"," Berhasil Insert Data ! ");
        redirect(base_url("'.$table.'"));
    }else{
        $this->session->set_flashdata("failed"," Gagal Insert Data ! ".validation_errors());
        redirect(base_url("'.$table.'"));
    }
}';
$html_update .= '
        ];

        $this->db->where("id", $id); // ubah id dan postnya
        $this->db->update("'.$table.'", $data);
        $this->session->set_flashdata("success"," Berhasil Update Data ! ");
        redirect(base_url("'.$table.'/edit/".$id));
    }else{
        $this->session->set_flashdata("failed"," Gagal Update Data ! ".validation_errors());
        redirect(base_url("'.$table.'/edit/".$id));
    }
}';