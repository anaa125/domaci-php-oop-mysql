<?php
class Prikaz{
    public $id;   
    public $naziv;   
    public $sala;   
    public $trajanje;   
    public $datum;
    public $korisnikID;

   //konstruktor
    public function __construct($id=null, $naziv=null, $sala=null, $trajanje=null, $datum=null,$korisnikID=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->sala = $sala;
        $this->trajanje = $trajanje;
        $this->datum = $datum;
        $this->korisnikID=$korisnikID;
    }
// slede funkcije koje ce komunicirati sa bazom 

    #funkcija prikazi sve getAll- static je poziva se nad klasom Prikaz
    
    public static function getAll(mysqli $conn)
    {
        //pravimo query 
        $query = "SELECT * FROM prikazi";
        //konekcija koja treba da izvrsi query funkciju 
        return $conn->query($query);
    }

    #funkcija getById

    public static function getById($id, mysqli $conn){

        $query = "SELECT * FROM prikazi WHERE id=$id";
         // myObj je niz koji je prazan
        $myObj = array();
        if($msqlObj = $conn->query($query)){
            //ako upit vrati bilo kakve rezultate

            while($red = $msqlObj->fetch_array(1)){
                //dodajemo na kraj niza
                $myObj[]= $red;
            }
        }

        return $myObj;
    }


    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM prikazi WHERE id=$this->id";
        return $conn->query($query);
    }

     #update
   /* public function update1($id, mysqli $conn)
    {
        $query = "UPDATE prikaza set naziv = $this->naziv,sala = $this->sala,trajanje = $this->trajanje,datum = $this->datum,korisnikID=$this->korisnikID WHERE id=$id";
        return $conn->query($query);
    }
    */

    public function update(Prikaz $noviPrikaz,mysqli $conn){
        $upit = "UPDATE prikazi set naziv = $noviPrikaz->naziv,sala = $noviPrikaz->sala,
        trajanje = $noviPrikaz->trajanje,datum = $noviPrikaz->datum,korisnikID=$noviPrikaz->korisnikID 
        WHERE id=$noviPrikaz->id";
        return $conn->query($upit);
    }


    #insert
    public static function add(Prikaz $Prikaz, mysqli $conn)
    {
        $query = "INSERT INTO prikazi(naziv, sala, trajanje, datum, korisnikID) VALUES('$Prikaz->naziv','$Prikaz->sala','$Prikaz->trajanje','$Prikaz->datum','$Prikaz->korisnikID')";
        return $conn->query($query);
    }
}
?>