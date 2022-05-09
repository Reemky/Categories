<?php

include 'DBconfig.php';
$conn = mysqli_connect(hostname, username, pass, dbname);

if (mysqli_connect_errno()) {
    die("Unable to connect to server:" . mysqli_connect_error());
}
$query = "SELECT * FROM categories WHERE parent_id is null;";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);

?>

<!DOCTYPE html>

<head>

    <title>Categories</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 d-none d-md-block"></div>
            <div class="col-xs-12 col-md-4 push-4">
                <select name="category" class="form-control category">
                    <option value="">Select</option>
                    <?php
                    foreach ($data as $da) {
                        echo '<option value="' . $da['id'] . '">' . $da['name'] .'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 d-none d-md-block"></div>
        </div>
        <div id="dropdownlist_container"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
               $(document).ready(function() {
            $(document).on('change', '.category', function() {
                var id = $(this).val();
                $.ajax({
                    url: 'getC.php',
                    type: 'post',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $('#dropdownlist_container').append(data);
                    }
                })
            });
        });
    </script>
</body>
</html>

