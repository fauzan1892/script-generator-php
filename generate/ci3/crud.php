<?php

$html_insert .= '
    /* Store a newly created resource in storage. */
    public function store()
    {';
$html_update .= '
    
    /* Update the specified resource in storage. */
    public function update()
    {
        $id =  base64_decode($this->input->post("id")); // parameter yang mau di update';
$html_delete .= '
    
    /* Remove the specified resource from storage. */
    public function delete($id)
    {
        $id = base64_decode($id);
        $cek = $this->db->get_where("'.$table.'",["id" => $id]); // where id parameters
        if($cek->num_rows() > 0)
        {
            $this->db->where("id",$id); // where id parameters
            $this->db->delete("'.$table.'");
            $this->session->set_flashdata("success"," Remove Data Successfuly ! ");
            redirect(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "success", "msg" => "Remove Data Successfuly ! "]);
        }else{
            $this->session->set_flashdata("failed"," Remove Data Failed ! ".validation_errors());
            redirect(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "error", "msg" => "Data Not Found ! "]);
        }
    }
}
    ';
        // for kolom codeigniter 3 ---
        for ($i = 0; $i < $kolom->columnCount(); $i++) {
            $col = $kolom->getColumnMeta($i);
            $col['name'];
            // echo $col['native_type'].' =>'.$col['name'].'<br>';
            $label = ucwords(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
            if($col['name']  != 'id')
            {
$html_insert .= '
        $this->form_validation->set_rules("'.$col['name'].'", "'.$label.'", "required");';  
            }
$html_update .= '
        $this->form_validation->set_rules("'.$col['name'].'", "'.$label.'", "required");'; 

        }

$html_insert .= '
        if($this->form_validation->run() != false) {
    ';
$html_update .= '
        if($this->form_validation->run() != false) {
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
            $data["'.$col['name'].'"] = htmlentities($this->input->post("'.$col['name'].'", TRUE));';         
$html_update .= '
            $data["'.$col['name'].'"] = htmlentities($this->input->post("'.$col['name'].'", TRUE));';      
                }
            }
        }
$html_insert .= '

            $this->db->insert("'.$table.'", $data);
            $this->session->set_flashdata("success","  Store Data Successfuly ! ");
            redirect(base_url("'.$baseurl.'"));
			// echo json_encode(["cek" => "success", "msg" => " Store Data Successfuly ! "]);
        }else{
            $this->session->set_flashdata("failed"," Store Data Failed ! ".validation_errors());
            redirect(base_url("'.$baseurl.'"));
            // echo json_encode(["cek" => "error", "msg" => "".validation_errors()]);
        }
    }';
$html_update .= '

            $this->db->where("id", $id); // where id parameters
            $this->db->update("'.$table.'", $data);
            $this->session->set_flashdata("success"," Update Data Successfuly ! ");
            redirect(base_url("'.$baseurl.'/edit/".$id));
			// echo json_encode(["cek" => "success", "msg" => "Update Data Successfuly ! "]);
        }else{
            $this->session->set_flashdata("failed"," Update Data Failed ! ".validation_errors());
            redirect(base_url("'.$baseurl.'/edit/".$id));
            // echo json_encode(["cek" => "error", "msg" => "".validation_errors()]);
        }
    }';