<?php
    require_once 'kumomo_connect.php';
    require_once 'functions.php';

    $data = userProfile($_GET['id']);
    
    if(!empty($data)){
        echo json_encode($data);
    }
    else{
        echo "false";
    }
?>