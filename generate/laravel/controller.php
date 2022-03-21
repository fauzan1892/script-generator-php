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
 * File      : '.$class.'Controller.php
 * Web Name  : App Name
 * Developer : Your Name
 * E-mail    : Your Email
 * 
 * 
**/
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// use App\Models\ '.$class.';

class '.$class.'Controller extends Controller
{
    
    public function __construct()
    {
        // $this->middleware("auth");
    }

    public function index(Request $request)
    {
        $data = [
            "title_web"     => "'.$class.'",
            "sidebar"       => "'.$table.'",
            "request"       => $request,
            "'.$table.'"    => DB::table("'.$table.'")->latest()->paginate(5),
        ];
        return view("contents/'.$baseurl.'/home", $data);
    }

    public function create(Request $request)
    {
        $data = [
            "title"     => "Tambah - '.$class.'",
            "sidebar"   => "'.$table.'",
            "request"   => $request,
            "edit"      => $edit
        ];
        return view("contents/'.$baseurl.'/create", $data);
    }

    public function edit(Request $request, $id)
    {
        $edit = DB::table("'.$table.'")->where([ "id" => $id ])->first();
        if(!$edit){ abort("404"); }
        $data = [
            "title"     => "Edit - '.$class.'",
            "sidebar"   => "'.$table.'",
            "request"   => $request,
            "edit"      => $edit
        ];
        return view("contents/'.$baseurl.'/edit", $data);
    }

   ';