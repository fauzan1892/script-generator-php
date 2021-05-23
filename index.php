<?php
/**
 * 
 * Author    : Fauzan Falah ( Anang )
 * File      : index.php
 * Web Name  : Codekop CRUD PHP Script Generator with Bootstrap 4-5
 * Version   : v1.0.0
 * Website   : https://www.codekop.com/
 * Facebook  : https://www.facebook.com/fauzan.falah2  
 * HP/WA	 : +6289618173609
 * E-mail 	 : codekop157@gmail.com / fauzancodekop@gmail.com / fauzan1892@codekop.com
 * 
 * 
 */
error_reporting(1);
if(!empty($_GET['get']))
{
    // koneksi antar database ---
    $dbhost = $_POST['host']; // set the hostname
    $dbname = $_POST['dbname']; // set the database name
    $dbuser = $_POST['user']; // set the mysql username
    $dbpass = $_POST['pass'];  // set the mysql password

    try {
        $koneksi = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $koneksi->exec("set names utf8");
        $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        return 'Connection failed : ' . $e->getMessage();
    }

    // https://stackoverflow.com/questions/5428262/php-pdo-get-the-columns-name-of-a-table
    
    // table sql ---
    $table = $_POST['table'];
    $kolom = $koneksi->prepare("SELECT * FROM $table LIMIT 0");
    $kolom->execute();

if(($_POST['type'] == '5')) {
// tipe input pakai php native ---
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
    
    // for basic form ---
    for ($i = 0; $i < $kolom->columnCount(); $i++) {
        $col = $kolom->getColumnMeta($i);
        $col['name'];
        // echo $col['native_type'].' =>'.$col['name'].'<br>';
        $label = ucfirst(preg_replace('/[^a-zA-Z0-9\']/', ' ', $col['name']));
        
        //tipe kolom
        if($col['native_type'] == 'LONG')
        {
            $type = 'number';
        }else if($col['native_type'] == 'BLOB'){
            $type = 'textarea';
        }else if($col['native_type'] == 'DATE'){
            $type = 'date';
        }else if($col['native_type'] == 'TIMESTAMP'){
            $type = 'datetime-local';
        }else{
            $type = 'text';
        }

        // tipe pakai laravel ---
        if(($_POST['type'] == '4'))
        {
            // tipe input pakai laravel ---
            include 'laravel/html.php';
        }else  if(($_POST['type'] == '5')) {

            // tipe input pakai php native ---
            include 'native/html.php';

        }else{

            // tipe input pakai codeigniter 3 ---
            include 'ci3/html.php';
        }
    } 

    // tipe pakai laravel ---
    if(($_POST['type'] == '4'))
    {
        // tipe input pakai laravel ---
        include 'laravel/detail.php';
        include 'laravel/crud.php';
        include 'laravel/tabel.php';

        $sc = 'Laravel';

    }else if(($_POST['type'] == '5')){

        // tipe input pakai php native ---
        include 'native/detail.php';
        include 'native/crud.php';
        include 'native/tabel.php';

        $sc = 'PHP Native';

    }else{

        // tipe input pakai codeigniter 3 ---
        include 'ci3/crud.php';
        include 'ci3/detail.php';
        include 'ci3/tabel.php';

        $sc = 'CodeIgniter 3';

    }

    // for basic form ---
    if(!empty($_POST['category'] == '1'))
    {
        // button tipe left
        $button  = '<button class="btn btn-primary btn-md">Save</button>';
    }else{
        // button tipe right
        $button  = '<button class="btn btn-primary btn-md float-right">Save</button>';
    }

    // array from CRUD
    if(!empty($_POST['array'] == '2'))
    {
        include 'crud_array.php';
    }else{
        $html_array = 'No Result';
    }
    // end crud laravel --
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="prism.css"/>
        <style>
            body{
                background: #222;
            }
            .card {
                border:2px solid #222;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid mt-5 mb-5">
            <h3 class="text-center text-success"><b>Codekop CRUD PHP Basic Script Generator with Bootstrap 4-5</b></h3>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header text-white bg-info">
                            <h5 class="card-title pt-2"><b>Form Setting PHP Connections</b> 
                            <small class="pl-2">[ Web Server Should be actived ]</small></h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="index.php?get=proses">
                                <div class="form-group">
                                    <label for="">Host</label>
                                    <input type="text"
                                        class="form-control" 
                                        name="host" placeholder="localhost" value="localhost" required>
                                </div>
                                <div class="form-group">
                                    <label for="">User</label>
                                    <input type="text" value="<?php if(isset($_POST['user'])){ echo $_POST['user'];}?>"
                                        class="form-control" 
                                        name="user" placeholder="root" value="root" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" value="<?php if(isset($_POST['pass'])){ echo $_POST['pass'];}?>"
                                        class="form-control" 
                                        name="pass" placeholder="Your Password">
                                </div>
                                <div class="form-group">
                                    <label for="">DB Name</label>
                                    <input type="text" value="<?php if(isset($_POST['dbname'])){ echo $_POST['dbname'];}?>"
                                        class="form-control" 
                                        name="dbname" placeholder="Example : codekop_crud" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Table Name</label>
                                    <input type="text"
                                        class="form-control" value="<?php if(isset($_POST['table'])){ echo $_POST['table'];}?>"
                                        name="table" placeholder="Example : tbl_article" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Category Form</label>
                                    <select class="form-control" name="category" required>
                                        <option value="1" 
                                            <?php   
                                                if(isset($_POST['category'])){
                                                    if($_POST['category'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Basic form </option>
                                        <option value="2"
                                            <?php   
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
                                        <option value="1"
                                            <?php   
                                                if(isset($_POST['button'])){
                                                    if($_POST['button'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Button Left</option>
                                        <option value="2" 
                                            <?php   
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
                                        <option value="1" 
                                            <?php   
                                                if(isset($_POST['array'])){
                                                    if($_POST['array'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>No</option>
                                        <option value="2" 
                                            <?php   
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
                                        <option value="1" 
                                            <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '1'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>No Actions</option>
                                        <option value="2"  
                                            <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '2'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>CodeIgniter 3</option>
                                        <option value="3" disabled>CodeIgniter 4</option>
                                        <option value="4"  
                                            <?php   
                                                if(isset($_POST['type'])){
                                                    if($_POST['type'] == '4'){ 
                                                        echo 'selected';
                                                    }
                                                }
                                            ?>>Laravel 6-8</option>
                                        <option value="5">PHP Native</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-md">
                                    Submit
                                </button>
                                <a href="index.php" class="btn btn-danger btn-md">Reset</a>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h5 class="card-title pt-2"><b>Display HTML</b></h5>
                        </div>
                        <div class="card-body">
                            <?= htmlspecialchars_decode($html_code);?><?= htmlspecialchars_decode($button);?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
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
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#ccreate" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Form HTML Create Result Code </b></h5>
                        </div>
                        <div class="card-body collapse" id="ccreate">
                            <pre class="language-php"><code><?= htmlspecialchars($html_code);?><?= htmlspecialchars($button);?></code></pre>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-white" style="background:#4934eb;">
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#ccupdate" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Form HTML Update Result Code</b></h5>
                        </div>
                        <div class="card-body collapse" id="ccupdate">
                            <pre class="language-php"><code><?= htmlspecialchars($html_code_update);?><?= htmlspecialchars($button);?></code></pre>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-white" style="background:#eb8f34">
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#cdetail" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Form HTML Details Result Code</b></h5>
                        </div>
                        <div class="card-body collapse" id="cdetail">
                            <pre class="language-php"><code><?= htmlspecialchars($html_code_detail);?></code></pre>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-white" style="background:#eb4f34">
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#ctabel" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Form HTML Table Result Code</b></h5>
                        </div>
                        <div class="card-body collapse" id="ctabel">
                            <pre class="language-php"><code><?= htmlspecialchars($html_code_tabel);?></code></pre>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-dark bg-warning">
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#carray" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Array Code CRUD with $_POST Result Code</b></h5>
                        </div>
                        <div class="card-body collapse" id="carray">
                            <pre class="language-php"><code><?= htmlspecialchars($html_array);?></code></pre>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-white bg-success">
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#cinsert" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Insert (store) Result Code (CRUD)</b></h5>
                        </div>
                        <div class="card-body collapse" id="cinsert">
                            <pre class="language-php"><code><?= htmlspecialchars($html_insert);?></code></pre>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#cedit" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Updated Result Code (CRUD)</b></h5>
                        </div>
                        <div class="card-body collapse" id="cedit">
                            <pre class="language-php"><code><?= htmlspecialchars($html_update);?></code></pre>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header text-white bg-danger">
                            <div class="float-right">
                                <a class="btn btn-default bg-white text-dark mt-1" 
                                    data-toggle="collapse" href="#cdel" href="javascript:void(0)" 
                                    role="button">Show</a>
                            </div>
                            <h5 class="card-title pt-2"><b>Delete Result Code (CRUD)</b></h5>
                        </div>
                        <div class="card-body collapse" id="cdel">
                            <pre class="language-php"><code><?= htmlspecialchars($html_delete);?></code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="prism.js"></script>
    </body>
</html>