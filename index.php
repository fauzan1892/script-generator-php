<?php
/**
 * 
 * Author    : Fauzan Falah
 * File      : index.php
 * Web Name  : Codekop CRUD PHP Script Generator with Bootstrap 4-5
 * Version   : v1.0.0
 * Website   : https://www.codekop.com/
 * Github    : https://github.com/fauzan1892
 * Facebook  : https://www.facebook.com/fauzan.falah2  
 * HP/WA	 : +6281298669897
 * E-mail 	 : codekop157@gmail.com / fauzancodekop@gmail.com / fauzan1892@codekop.com
 * 
 * 
 */
error_reporting(1);
if(!empty($_GET['get']))
{
    /*
    |--------------------------------------------------------------------------
    | DB Connections
    |--------------------------------------------------------------------------
    |
    */
    $dbhost = $_POST['host']; // set the hostname
    $dbname = $_POST['dbname']; // set the database name
    $dbuser = $_POST['user']; // set the mysql username
    $dbpass = $_POST['pass'];  // set the mysql password

    try {
        $dbConnect = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbConnect->exec("set names utf8");
        $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        return 'Connection failed : ' . $e->getMessage();
    }

    /*
    |--------------------------------------------------------------------------
    | Tabel SQL
    |--------------------------------------------------------------------------
    |
    | Reference : https://stackoverflow.com/questions/5428262/php-pdo-get-the-columns-name-of-a-table
    |
    */
    $table = $_POST['table'];
    $class = ucwords($_POST['table']);
    $baseurl = $_POST['url'];
    $kolom = $dbConnect->prepare("SELECT * FROM $table LIMIT 0");
    $kolom->execute();

    /*
    |--------------------------------------------------------------------------
    | START GENERATE CODE
    |--------------------------------------------------------------------------
    |
    */
    
    // PHP PDO Code Generator ( EDIT FORM HTML CODE )
    if(($_POST['type'] == '5')) {
    $html_code_update .= '
    <?php
        $id =  (int)$_POST["id"];
        $sql = "SELECT * FROM '.$table.' WHERE id = ?";
        $row = $connectdb->prepare($sql);
        $row->execute(array($id));
        $edit = $row->fetch(PDO::FETCH_OBJ);
    ?>
    ';
    }

    // BASIC FORM HTML CODE
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucwords(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
        //tipe kolom
        if($col['native_type'] == 'LONG')
        {
            $type = 'number';
        }else if($col['native_type'] == 'STRING'){
            $type = 'enum';
        }else if($col['native_type'] == 'BLOB'){
            $type = 'textarea';
        }else if($col['native_type'] == 'DATE'){
            $type = 'date';
        }else if($col['native_type'] == 'TIMESTAMP'){
            $type = 'datetime-local';
        }else{
            $type = 'text';
        }

        // START GENERATE FORM HTML CODE
        // if($col['name'] != 'id')
        // {
            // LARAVEL 
            if(($_POST['type'] == '4')){
                include 'generate/laravel/html.php';
            // PHP PDO 
            }elseif(($_POST['type'] == '5')) {
                include 'generate/native/html.php';
            // CodeIgniter 4
            }else  if(($_POST['type'] == '3')){
                include 'generate/ci4/html.php';
            // CodeIgniter 3
            }else{
                include 'generate/ci3/html.php';
            }
        // }
        // END GENERATE FORM HTML CODE
    }
    
    // LARAVEL
    if(($_POST['type'] == '4')){
        include 'generate/laravel/controller.php';
        include 'generate/laravel/detail.php';
        include 'generate/laravel/crud.php';
        include 'generate/laravel/tabel.php';

        $sc = 'Laravel';
        $formmethod = '<form method="POST" action="{{ url("'.$baseurl.'") }}"> @csrf';

    // PHP PDO
    }else if(($_POST['type'] == '5')){
        include 'generate/native/detail.php';
        include 'generate/native/crud.php';
        include 'generate/native/tabel.php';

        $sc = 'PHP Native';
        $formmethod = "<form method='POST' action=''>";

    // CodeIgniter 4
    }else  if(($_POST['type'] == '3')){
        include 'generate/ci4/controller.php';
        include 'generate/ci4/crud.php';
        include 'generate/ci4/detail.php';
        include 'generate/ci4/tabel.php';

        $sc = 'CodeIgniter 4';
        $formmethod = '<form method="POST" action="<?= base_url("'.$baseurl.'");?>">';

    // CodeIgniter 3
    }else{
        include 'generate/ci3/controller.php';
        include 'generate/ci3/crud.php';
        include 'generate/ci3/detail.php';
        include 'generate/ci3/tabel.php';

        $sc = 'CodeIgniter 3';
        $formmethod = '<form method="POST" action="<?= base_url("'.$baseurl.'");?>">';

    }

    // Button Generate HTML Code
    if(!empty($_POST['category'] == '1')){
        // LEFT
        $button .= '<button type="submit" class="btn btn-primary btn-md">Save</button>';
    }else{
        // RIGHT
        $button .= '<button class="btn btn-primary btn-md float-right">Save</button>';
    }

    // Array from CRUD
    if(!empty($_POST['array'] == '2'))
    {
        include 'crud_array.php';
    }else{
        $html_array = 'No Result';
    }
$button .= '
</form>';
    // END GENERATE CODE
}
?>
<!doctype html>
    <html lang="en">
        <head>
            <title>CRUD PHP Script Generator with Bootstrap</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="prism.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
                integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <style>
                body{
                    background: rgba(20,139,99,1);
                }
                .tab-pane{
                    height: 400px;
                    overflow-y: scroll;
                }
                .card{
                    border-radius: 10px;
                    border: 0px;
                }
                .card-header{
                    border-radius: 10px 10px 0 0 !important;
                }
            </style>
        </head>
        <body>
            <div class="container mt-5 mb-5">
                <h3 class="text-center text-white"><b>Codekop CRUD PHP Basic Script Generator with Bootstrap</b>
                </h3>
                <br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-md mb-3" data-toggle="modal" data-target="#modelId">
                    <i class="fas fa-cog"></i> Settings
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Form Setting PHP Connections [ Web Server Should be actived ]
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="index.php?get=proses">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Host</label>
                                                <input type="text" class="form-control" name="host"
                                                    placeholder="localhost" id="host" value="localhost" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">User</label>
                                                <input type="text"
                                                    value="<?php if(isset($_POST['user'])){ echo $_POST['user'];}?>"
                                                    class="form-control" name="user" id="user" placeholder="root" value="root"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password"
                                                    value="<?php if(isset($_POST['pass'])){ echo $_POST['pass'];}?>"
                                                    class="form-control" name="pass" id="pass" placeholder="Your Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="">DB Name</label>
                                                <select id="dbname" name="dbname" class="form-control" required>
                                                    <option value="" readonly>Select DB Name</option>
                                                </select>
                                                <!-- <input type="text"
                                                    value="<?php if(isset($_POST['dbname'])){ echo $_POST['dbname'];}?>"
                                                    class="form-control" name="dbname"
                                                    placeholder="Example : codekop_crud" required> -->
                                            </div>
                                            <div class="form-group">
                                                <label for="">Table Name</label>
                                                <select id="table" name="table" class="form-control" required>
                                                    <option value="" readonly>Select Table Name</option>
                                                </select>
                                                <!-- <input type="text" class="form-control"
                                                    value="<?php if(isset($_POST['table'])){ echo $_POST['table'];}?>"
                                                    name="table" placeholder="Example : tbl_article" required> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Base URL</label>
                                                <input type="text" class="form-control"
                                                    value="<?php if(isset($_POST['url'])){ echo $_POST['url'];}?>"
                                                    name="url" placeholder="Example : admin/users" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Category Form</label>
                                                <select class="form-control" name="category" required>
                                                    <option value="1" <?php   
                                                if(isset($_POST['category'])){
                                                    if($_POST['category'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Basic form </option>
                                                    <option value="2" <?php   
                                                if(isset($_POST['category'])){
                                                    if($_POST['category'] == '2'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Horizontal form</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Button Form</label>
                                                <select class="form-control" name="button" required>
                                                    <option value="1" <?php   
                                                if(isset($_POST['button'])){
                                                    if($_POST['button'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Button Left</option>
                                                    <option value="2" <?php   
                                                if(isset($_POST['button'])){
                                                    if($_POST['button'] == '2'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Button Right</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Array Code CRUD with POST</label>
                                                <select class="form-control" name="array" required>
                                                    <option value="1" <?php   
                                                if(isset($_POST['array'])){
                                                    if($_POST['array'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>No</option>
                                                    <option value="2" <?php   
                                                if(isset($_POST['array'])){
                                                    if($_POST['array'] == '2'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Yes</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Type Framework / Native PHP</label>
                                                <select class="form-control" name="type" required>
                                                    <option value="1" <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>No Actions</option>
                                                    <option value="2" <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '2'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>CodeIgniter 3</option>
                                                    <option value="3" <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '3'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>CodeIgniter 4</option>
                                                    <option value="4" <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '4'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Laravel</option>
                                                    <option value="5"" <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '5'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>PHP Native</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header text-white bg-primary">
                                <h5 class="card-title pt-2"><b>Display HTML</b></h5>
                            </div>
                            <div class="card-body">
                                <?= htmlspecialchars_decode($html_code);?><?= htmlspecialchars_decode($button);?>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-12">
                        <div class="row">
                            <?php if(isset($_GET['get'])){?>
                            <div class="col-sm-10">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Script <?= $sc;?> Generate Successfuly !</strong>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <a href="index.php" class="btn btn-danger btn-lg btn-block">
                                    <b>RESET</b>
                                </a>
                            </div>
                            <?php }else{?>

                            <div class="col-sm-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Please setting your connection on the database ( MySQL )</strong>
                                </div>
                            </div>

                            <?php }?>
                        </div>
                        <div class="card">
                            <div class="card-header text-white bg-info">
                                <b><i class="fas fa-code mr-1"></i>Form HTML Result Code </b>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="create-tab" data-toggle="tab" href="#create"
                                            role="tab" aria-controls="create" aria-selected="true">HTML Create</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="edite-tab" data-toggle="tab" href="#edite" role="tab"
                                            aria-controls="edite" aria-selected="false">HTML Edit</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                                            aria-controls="detail" aria-selected="false">HTML Detail</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="table-tab" data-toggle="tab" href="#table12" role="tab"
                                            aria-controls="table" aria-selected="false">HTML Table</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="array-tab" data-toggle="tab" href="#array" role="tab"
                                            aria-controls="array" aria-selected="false">Array</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="controller-tab" data-toggle="tab" href="#controller"
                                            role="tab" aria-controls="controller" aria-selected="true">Base Controller</a>
                                    </li>
                                    <li class="nav-item" role="model">
                                        <a class="nav-link" id="model-tab" data-toggle="tab" href="#model"
                                            role="tab" aria-controls="model" aria-selected="true">Model</a>
                                    </li>
                                    <li class="nav-item" role="route">
                                        <a class="nav-link" id="route-tab" data-toggle="tab" href="#route"
                                            role="tab" aria-controls="route" aria-selected="true">Route</a>
                                    </li>
                                    <!-- <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="insert-tab" data-toggle="tab" href="#insert"
                                            role="tab" aria-controls="insert" aria-selected="true">Insert</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab"
                                            aria-controls="update" aria-selected="false">Update</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete" role="tab"
                                            aria-controls="delete" aria-selected="false">Delete</a>
                                    </li> -->
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="create" role="tabpanel"
                                        aria-labelledby="create-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preCreate')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preCreate"
                                            class="language-php"><code><?= htmlspecialchars($formmethod);?><?= htmlspecialchars($html_code);?><?= htmlspecialchars($button);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="edite" role="tabpanel" aria-labelledby="edite-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preEdit')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preEdit"
                                            class="language-php"><code><?= htmlspecialchars($formmethod);?><?= htmlspecialchars($html_code_update);?><?= htmlspecialchars($button);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preDetail')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preDetail" 
                                            class="language-php"><code><?= htmlspecialchars($html_code_detail);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="table12" role="tabpanel" aria-labelledby="table-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preTable')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preTable" 
                                            class="language-php"><code><?= htmlspecialchars($html_code_tabel);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="array" role="tabpanel" aria-labelledby="array-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preArray')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preArray" 
                                            class="language-php"><code><?= htmlspecialchars($html_array);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="controller" role="tabpanel"
                                        aria-labelledby="controller-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preController')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preController"
                                            class="language-php"><code>
                                            <?= htmlspecialchars($controllers_build ?? '');?>
                                            <?= htmlspecialchars($html_insert);?>
                                            <?= htmlspecialchars($html_update);?>
                                            <?= htmlspecialchars($html_delete);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="model" role="tabpanel" aria-labelledby="model-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preModel')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preArray" 
                                            class="language-php"><code></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="route" role="tabpanel" aria-labelledby="route-tab">
                                        <button id="buttonController" 
                                            onclick="copyFunction('preRoute')" 
                                            class="btn btn-secondary btn-sm mt-3 mb-2">
                                            <i class="fas fa-copy mr-1"></i> Copy All
                                        </button>
                                        <pre id="preRoute" 
                                            class="language-php"><code></code></pre>
                                    </div>
                                    <!-- <div class="tab-pane fade" id="insert" role="tabpanel"
                                        aria-labelledby="insert-tab">
                                        <pre
                                            class="language-php"><code><?= htmlspecialchars($html_insert);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
                                        <pre
                                            class="language-php"><code><?= htmlspecialchars($html_update);?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
                                        <pre
                                            class="language-php"><code><?= htmlspecialchars($html_delete);?></code></pre>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <div class="card-header text-dark bg-warning">
                                <div class="float-right">
                                    <a class="btn btn-default bg-white text-dark mt-1" data-toggle="collapse"
                                        href="#carray" href="javascript:void(0)" role="button">Show</a>
                                </div>
                                <h5 class="card-title pt-2"><b>Array Code CRUD with $_POST Result Code</b></h5>
                            </div>
                            <div class="card-body collapse" id="carray">
                                <pre class="language-php"><code><?= htmlspecialchars($html_array);?></code></pre>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="prism.js"></script>
                <?php include 'js.php';?>
        </body>
        </html>