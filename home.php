<?php

require "dbBroker.php";
require "model/prikaz.php";

session_start();
//da li postoji zapamcena sesija koju smo postavili na index.php stranici
if (!isset($_SESSION['korisnik_id'])) {
    //ako nije postavljeno stavljamo da je lokacija index stranica 
    header('Location: index.php');
    exit();
}
// sad da tabelu popunimo informacijama
// 
$podaci = Prikaz::getAll($conn);

if (!$podaci) {
    //ako nema podataka
    echo "Nastala je greška pri preuzimanju podataka";
    // die() je funkcija koja radi isto sto i exit i ne izvrsava se nista ispod nje
    die();
}
if ($podaci->num_rows == 0) {
    //ako je rezultat prazan 
    echo "Nema zakazanih prikazivanja predstava";
    die();
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/druga.css">
        <title>Jugoslovensko dramsko pozorište</title>
    </head>

    <body>
        <h1 id="naslov">Prikazivanje predstava u JDP-u</h1>
        <div class="zaglavlje">

            <ul class="pozadina">
                <li style="display: inline-block;line-height: 50px; margin-top: 5px; margin-right: 50px">
                    <button id="btnPrikaz" style="text-transform: uppercase;">Prikaži repertoar predstava</button>
                </li>

                <li style="display: inline-block;line-height: 50px; margin-top: 5px ;margin-right: 50px">
                    <button id="-zakazivanje" type="button" data-toggle="modal" data-target="#myModal" style="text-transform: uppercase;">Zakaži prikazivanje predstave</button>
                </li>

                <li style="display: inline-block;line-height: 50px; margin-top: 5px ;margin-right: 50px">
                    <div class="col-md-4a">
                        <button id="btn-pretraga" style="text-transform: uppercase;">Pretraži prikazivanje predstave</button>
                        <input type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi po nazivu" hidden>
                    </div>
                </li>
            </ul>



        </div><!-- zatvaramo zaglavlje-->
        <br>
        <br>
        <br>
        <br>
        <br>

        <div id="pregled" style=" background-color: rgb(211, 187, 158);
    opacity: 90%; width: 90%; margin-left:auto; margin-right:auto; ">
            <br>
            <table id="tabela" style="color: black; background-color: bisque; width: 95%; margin-left:auto; margin-right:auto;  border: 1px solid black ">

                <thead class="thead" style="font-size: 40px;  text-align: center;">
                    <tr>
                        <th class="col" style="width: 20%;">Naziv predstave</th>
                        <th class="col" style="width: 20%;">Sala</th>
                        <th class="col" style="width: 20%;">Trajanje(min)</th>
                        <th class="col" style="width: 20%;">Datum</th>
                        <th class="col" style="width: 20%;">KorisnikID</th>
                    </tr>

                </thead>
                <tbody>

                    <?php
                    while ($red = $podaci->fetch_array()) :
                    ?>
                        <tr>
                            <td><?php echo $red["naziv"] ?></td>
                            <td><?php echo $red["sala"] ?></td>
                            <td><?php echo $red["trajanje"] ?></td>
                            <td><?php echo $red["datum"] ?></td>
                            <td><?php echo $red["korisnikID"] ?></td>
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donut" value=<?php echo $red["id"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>

                        </tr>
                <?php
                    endwhile;
                } ?>

                </tbody>
            </table>
            <!-- zatvaramo tabelu-->

            <div class="row">
                <ul class="pozadina" style="margin-left:12%; margin-top: 50px; ">
                    <li style="display: inline-block;  line-height: 50px; ">
                        <div class="col-md-1">
                            <button id="dugme-izmeni" style="background-color: bisque; width: 400px; border-radius: 5px; font-size: 25px;" data-toggle="modal" data-target="#izmeniModal">Izmeni zakazani prikaz predstave</button>

                        </div>
                    </li>
                    <li style="display: inline-block;   line-height: 50px;">
                        <div class="col-md-12">
                            <button id="btn-obrisi" formmethod="post" style="background-color: bisque;width: 400px;  border-radius: 5px; font-size: 25px;">Obriši prikazivanje predstave</button>
                        </div>
                    </li>
                    <li style="display: inline-block;   line-height: 50px;  ">
                        <div class="col-md-2">
                            <button id="btn-sortiraj" style="background-color: bisque; width: 400px; border-radius: 5px; font-size: 25px;" onclick="sortiraj()">Sortiraj po nazivu sale</button>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- dodaj modal -->
                <!--Sadrzaj modala-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="post" id="dodajForm">
                                <h3 style="color: black; text-align: left ">Zakazi prikazivanje predstave</h3>
                                <div class="row">
                                    <div class="col-md-11 ">
                                        <div class="form-group">
                                            <label for="">Naziv predstave</label>
                                            <input type="text" style="border: 1px solid black; width: 200px;" name="naziv" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sala</label>
                                            <input type="text" style="border: 1px solid black;width: 200px; " name="sala" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sala">Trajanje</label>
                                            <input type="number" style="border: 1px solid black; width: 200px; " name="trajanje" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sala">ID korisnika(1,3 ili 5)</label>
                                            <input type="number" style="border: 1px solid black; width: 200px; " name="korisnikID" class="form-control" />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Datum</label>
                                                <input type="date" style="border: 1px solid black; width: 200px; " name="datum" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button id="Dodaj" type="submit" style=" background-color: bisque;font-size: 20px; border-radius: 10px">Zakazi projekciju</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" -default" data-dismiss="modal">Zatvori</button>
                    </div>
                </div>

            </div>



        </div>
        <!-- Modal -->
        <div class="modal fade" id="izmeniModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal sadrzaj-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="post" id="izmeniForm">
                                <h3 style="color: black">Izmeni zakazani prikaz</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="id" type="text" name="id" style="border: 1px solid black; width: 200px; " class="form-control" placeholder="Id *" value="" readonly />
                                        </div>
                                        <div class="form-group">
                                            <input id="naziv" type="text" name="naziv" style="border: 1px solid black; width: 200px; " class="form-control" placeholder="naziv*" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="sala" type="text" name="sala" style="border: 1px solid black; width: 200px; " class="form-control" placeholder="sala *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="trajanje" type="number" name="trajanje" style="border: 1px solid black; width: 200px; " class="form-control" placeholder="trajanje(min) *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="datum" type="date" name="datum" style="border: 1px solid black; width: 200px; " class="form-control" placeholder="Datum *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="korisnikID" type="number" name="korisnikID" style="border: 1px solid black; width: 200px; " class="form-control" placeholder="id korisnika(1, 3 ili 5) *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <button id="btnIzmeni" type="submit" style=" background-color: bisque;font-size: 20px; border-radius: 10px"> Izmeni
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" -default" data-dismiss="modal">Zatvori</button>
                    </div>
                </div>



            </div>

        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <script>
            function sortiraj() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("tabela");
                switching = true;

                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("TD")[1];
                        y = rows[i + 1].getElementsByTagName("TD")[1];
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }

            function funkcijaZaPretragu() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("tabela");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>


    </body>

    </html>