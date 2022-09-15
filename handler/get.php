<?php

require "../dbBroker.php";
require "../model/prikaz.php";

if(isset($_POST['id'])){
    $myArray = Prikaz::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}

?>