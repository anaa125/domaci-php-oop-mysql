<?php
//mogli smo da koristimo i include
require "dbBroker.php";
require "model/korisnik.php";

session_start();
if(isset($_POST['korisnickoIme']) && isset($_POST['lozinka'])){
    $uname = $_POST['korisnickoIme'];
    $upass = $_POST['lozinka'];

    //kreiramo novog korisnika
    $korisnik = new Korisnik(1, $uname, $upass);

    //ovde pokusavamo da ulogujemo Korisnika pozivamo staticku funkciju iz klase korisnik
    $odg = Korisnik::logInUser($korisnik, $conn); 
//ako je od odgovora broj redova jednako 1,odnosno ako je vracen jedan korsnik
    if($odg->num_rows==1){
        //da namse sledece ispise u konzoli
        echo  `
        <script>
        console.log( "Uspešno ste se prijavili");
        </script> `;
        //postavili smo sesiju koja se ovako zove 
        $_SESSION['korisnik_id'] = $korisnik->id;
        //postavljamo lokaciju na home.php
        header('Location: home.php');
        //zelimo da izadjemo sa ove stranice 
        exit();
    }else{
        //u suprotnom zelimo da nam se oco ispise
        echo `
        <script>
        console.log( "Niste se prijavili!");
        </script>
        `;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Pozorište</title>
</head>
<body>
<div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <h1 id="naslov">Jugoslovensko dramsko pozorište</h1>
                <div class="forma">
                    <label id="ime">Korisničko ime</label>
                    <input type="text" name="korisnickoIme" class="polje"  required>
                    <br>
                    <br>
                    <br>
                    <label id="sifra">Lozinka</label>
                    <input type="password" name="lozinka" class="polje" required>
                    <br>
                    <br>
                    <br>
                    <button type="submit" id="dugme" name="submit">Prijavi se</button>
                    
                </div>
</body>
</html>