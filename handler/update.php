<?php
require "../dbBroker.php";
require "../model/prikaz.php";

if(isset($_POST['id']) && isset($_POST['naziv']) && isset($_POST['sala']) 
&& isset($_POST['trajanje']) && isset($_POST['korisnikID'])&& isset($_POST['datum'])){

    $noviPrikaz = new Prikaz($_POST['id'],$_POST['naziv'],$_POST['sala'],$_POST['trajanje'],$_POST['datum'],$_POST['korisnikID']);
    //pozivanje static funkcije za dodavanje novog prikaza
    $status =Prikaz::update($noviPrikaz,$conn);

    if($status){
        // ako se vrati objekat 
        echo 'Success';
    }else{
        echo $status;
        echo "Failed";
    }
}
?>