<?php
$controllers_build = '
<?php
/**
 * App Name
 * 
 * @link       https://www.codekop.com/
 * @version    1.0.1
 * @copyright  (c) '.date('Y').'
 * 
 * File      : '.$class.'.php
 * Web Name  : App Name
 * Developer : Your Name
 * E-mail    : Your Email
 * 
 * 
**/
defined("BASEPATH") OR exit("No direct script access allowed");
class '.$class.' extends CI_Controller {
	function __construct(){
	 	parent::__construct();
	}
    
	public function index()
	{
		$this->data["title_web"] = "'.$class.'";
		$this->data["sidebar"] = "'.$table.'";
        $this->data["view_template"] = "contents/'.$baseurl.'/home";
        $this->data["'.$table.'"] = $this->db->query("SELECT * FROM '.$table.'")->result();
		$this->load->view("layouts/app",$this->data);
	}
    
	public function create()
	{
		$this->data["title_web"] = "Tambah - '.$class.'";
		$this->data["sidebar"] = "'.$table.'";
        $this->data["view_template"] = "contents/'.$baseurl.'/create";
		$this->load->view("layouts/app",$this->data);
	}

    public function edit($id)
    {
        $cek = $this->db->get_where("'.$table.'",["id" => $id]);
        if($cek->num_rows() > 0){
            $edit = $cek->row();
            $this->data["edit"] = $edit;
            // $this->data["title_web"] = "Edit - '.$class.'";
            // $this->data["sidebar"] = "'.$table.'";
            // $this->data["view_template"] = "contents/'.$baseurl.'/edit";
            // $this->load->view("layouts/app",$this->data);
			$this->load->view("contents/'.$baseurl.'/edit",$this->data);
        }else{
            echo "<br><h4 class=text-center> Data Not Found !</h4><br>";
            // $this->session->set_flashdata("success"," Data Not Found ! ");
            // redirect(base_url("'.$baseurl.'"));
        }
    }
   ';