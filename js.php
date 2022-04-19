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

    function prosesListDB(user, host, pass) {
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
                    $('#dbname').append('<option>' + data + '</option>');
                });
            },
            error: function (request, status, error) {
                alert("Database Tidak Ditemukan !");
            }
        });
    }

    function prosesListTable(user, host, pass, dbname) {
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
                    $('#table').append('<option>' + data + '</option>');
                });
            },
            error: function (request, status, error) {
                alert("Table Tidak Ditemukan !");
            }
        });
    } 
    
</script>