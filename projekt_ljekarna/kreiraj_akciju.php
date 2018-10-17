<?php
session_start();
$skorime=$_SESSION['korisnik'];

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$unaziv = filter_input(INPUT_POST, 'naziv');
$upostotak = filter_input(INPUT_POST, 'postotak');
$uod = filter_input(INPUT_POST, 'od');
$udo = filter_input(INPUT_POST, 'do');

if (empty($unaziv)) {
    $tekst_greski .= "GRESKA! Niste unijeli sva polja!</br>";
    $brojac++;
} else {
    $sqlupit = "INSERT INTO akcija (naziv, postotak, od_datum, do_datum) VALUES ('$unaziv','$upostotak','$uod','$udo');";
    unos_baza($sqlupit);    
}

echo $tekst_greski;
header("refresh:1;url=kreiranje_akcija.php");
?>
