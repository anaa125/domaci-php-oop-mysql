<?php

require "../dbBroker.php";
require "../model/prikazi.php";

if(isset($_POST['id'])){
    $obj = new Prikaz($_POST['id']);
    $status = $obj->deleteById($conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>