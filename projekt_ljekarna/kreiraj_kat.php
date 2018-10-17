<?php

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$unaziv = filter_input(INPUT_POST, 'naziv');

if (empty($unaziv)) {
    $tekst_greski .= "GRESKA! Niste unijeli sva polja!</br>";
    $brojac++;
} else {
    $sqlupit = "INSERT INTO kategorija (naziv) VALUES ('$unaziv');";
    unos_baza($sqlupit);
}

echo $tekst_greski;
header("refresh:1;url=kreiranje_kategorija.php");
?>
