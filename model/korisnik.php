<?php
//ovo je korisnik koji ce se logovati
class Korisnik{
    public $id;
    public $korisnickoIme;
    public $lozinka;

    //ova funkcija, odnosno konstruktor je void 
    public function __construct($id=null,$username=null,$password=null){
        $this->id = $id;
        $this->korisnickoIme = $username;
        $this->lozinka = $password;  }

   //prosledjujemo celog korisnika i onda pristupamo njegovim atributima

   //mysqli je objekat koji predstavlja konekciju izmedju php-a i baze
    public static function logInUser($kor, mysqli $conn)
    {
        $query = "SELECT * FROM korisnik WHERE korisnickoIme='$kor->korisnickoIme' and lozinka='$kor->lozinka'";

        //konekcija sa bazom;
        return $conn->query($query);
    }
}


?>