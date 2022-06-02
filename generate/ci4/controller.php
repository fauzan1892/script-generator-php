<?php
$controllers_build = '
<?php
/**
 * App Name
 * 
 * @link       https://www.codekop.com/
 * @version    1.0.1
 * @copyright  Codekop Generator (c) '.date('Y').'
 * 
 * File      : '.$class.'.php
 * Web Name  : App Name
 * Developer : Your Name
 * E-mail    : Your Email
 * 
 * 
**/
namespace App\Controllers;
use App\Models\R!@#'.$class.';

class '.$class.' extends BaseController
{
    protected $'.$table.';
 
    function __construct()
    {
        $this->'.$table.' = new '.$class.'_model();
    }

	public function index()
	{
		$this->data["title_web"] = "'.$class.'";
		$this->data["sidebar"] = "'.$table.'";
        $this->data["view_template"] = "contents/'.$baseurl.'/home";
        $this->data["'.$table.'"] = $this->$'.$table.'->get'.$class.'()->findAll();
		view("layouts/app",$this->data);
	}
    
	public function create()
	{
		$this->data["title_web"] = "Tambah - '.$class.'";
		$this->data["sidebar"] = "'.$table.'";
        $this->data["view_template"] = "contents/'.$baseurl.'/create";
		
        view("layouts/app",$this->data);
	}

    public function edit($id)
    {
        $edit = $this->'.$table.'->get'.$class.'($id)->getRow();
        if($edit){
            $this->data["edit"] = $edit;
            // $this->data["title_web"] = "Edit - '.$class.'";
            // $this->data["sidebar"] = "'.$table.'";
            // $this->data["view_template"] = "contents/'.$baseurl.'/edit";
            // view("layouts/app",$this->data);
			view("contents/'.$baseurl.'/edit",$this->data);
        }else{
            echo "<br><h4 class="text-center"> Data Not Found !</h4><br>";
            // $this->session->setFlashdata("failed"," Data Not Found ! ");
            // return redirect()->to(base_url("'.$baseurl.'"));
        }
    }
   ';

$controllers_build = preg_replace('/R!@#/i', '', $controllers_build);