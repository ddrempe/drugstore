<?php

session_start();
if (isset($_SESSION['uloga'])) {
    if ($_SESSION['uloga'] < 2) {
        echo "Neovlasten pristup! Nemate ovlasti za pristup stranici.";
        exit(0);
    }
} else {
    echo "Neovlasten pristup! Za nastavak se je potrebno prijaviti.";
    exit(0);
}

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$unaziv = filter_input(INPUT_POST, 'naziv');
$ucijena = filter_input(INPUT_POST, 'cijena');
$ukategorija = filter_input(INPUT_POST, 'kategorija');
$skorime = $_SESSION['korisnik'];

if (empty($unaziv) || empty($ucijena) || empty($ukategorija)) {
    $tekst_greski .= "GRESKA! Niste unijeli sva polja!</br>";
    $brojac++;
} else {
//    $sqlupit="SELECT * FROM korisnik, moderira WHERE moderira.idkorisnik=korisnik.idkorisnik AND korisnik.korime='$skorime';";
//    if (provjeri_postoji($sqlupit)) {
    $sqlupit = "INSERT INTO lijek (naziv, cijena, idkategorija) VALUES ('$unaziv', '$ucijena', '$ukategorija');";
    unos_baza($sqlupit);
//    }
//    else {
//        $tekst_greski .= "GRESKA! Ne mozete unijet lijek za tu kategoriju!</br>";
//    }
}

echo $tekst_greski;
header("refresh:1;url=definiranje_lijekova.php");
?>
