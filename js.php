<?php if(isset($_GET['get'])){?>
<script>
    $(document).ready(function () {
        let user = '<?= $_POST['user'];?>';
        let host = '<?= $_POST['host'];?>';
        let pass = '<?= $_POST['pass'];?>';
        let dbname = '<?= $_POST['dbname'];?>';
        let table = '<?= $_POST['table'];?>';
        prosesListDB(user, host, pass, dbname);
        prosesListTable(user, host, pass, dbname, table);
    });
</script>
<?php }?>
<script>
    // change the value of the input field jquery
    $(document).ready(function () {
        $('#user').change(function() {
            let user = $('#user').val();
            let host = $('#host').val();
            let pass = $('#pass').val();
            prosesListDB(user, host, pass);
        });
        $('#pass').change(function() {
            let user = $('#user').val();
            let host = $('#host').val();
            let pass = $('#pass').val();
            prosesListDB(user, host, pass);
        });
        $('#dbname').change(function() {
            let user = $('#user').val();
            let host = $('#host').val();
            let pass = $('#pass').val();
            let dbname = $(this).val();
            prosesListTable(user, host, pass, dbname);
        });
    });

    function prosesListDB(user, host, pass, dbname = null) {
        // create ajax
        $.ajax({
            url: 'php/cekdb.php',
            type: 'POST',
            data: {
                user: user,
                host: host,
                pass: pass
            },
            dataType: 'json',
            success: function (result) {
                $('#dbname')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="" disabled>Select DB Name</option>')
                    .val('');
                $.each(result, function (i, data) {
                    if(dbname == data) {
                        $('#dbname').append('<option selected>' + data + '</option>');
                    }else{
                        $('#dbname').append('<option>' + data + '</option>');
                    }
                });
            },
            error: function (request, status, error) {
                alert("Database Tidak Ditemukan !");
            }
        });
    }

    function prosesListTable(user, host, pass, dbname, table = null) {
        // create ajax
        $.ajax({
            url: 'php/cektable.php',
            type: 'POST',
            data: {
                user: user,
                host: host,
                pass: pass,
                dbname : dbname
            },
            dataType: 'json',
            success: function (result) {
                $('#table')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="" disabled>Select DB Name</option>')
                    .val('');
                $.each(result, function (i, data) {
                    if(table == data) {
                        $('#table').append('<option selected>' + data + '</option>');
                    }else{
                        $('#table').append('<option>' + data + '</option>');
                    }
                });
            },
            error: function (request, status, error) {
                alert("Table Tidak Ditemukan !");
            }
        });
    } 
    
</script>
<script>
    function copyFunction(idCopy) {
        const copyText = document.getElementById(idCopy).textContent;
        const textArea = document.createElement('textarea');
        textArea.textContent = copyText;
        document.body.append(textArea);
        textArea.select();
        document.execCommand("copy");
        textArea.remove();
        alert('Copy Success !');
    }
</script>