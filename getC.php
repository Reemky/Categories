<?php
include 'DBconfig.php';
$conn = mysqli_connect(hostname, username, pass, dbname);

if (mysqli_connect_errno()) {
    die("Unable to connect to server:" . mysqli_connect_error());
}

 if(isset($_POST['id']) && is_numeric($_POST['id'])){
    $id= $_POST['id'];
    $query = 'SELECT * FROM categories WHERE parent_id = ' . $id;
    $result = mysqli_query($conn,$query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(!empty($data)){
    echo '<div class="row">
    <div class="col-md-4 d-none d-md-block"></div>
    <div class="col-xs-12 col-md-4 push-4">
    <select name="category" class="form-control category">
    <option value="">Select</option>';
    foreach($data as $da){
    echo '<option value="'.$da['id'].'">'.$da['name'].'</option>';
    }
    echo '</select>
    </div>
    <div class="col-md-4 d-none d-md-block"></div>
    </div>';
    }
}

mysqli_close($conn);
?>