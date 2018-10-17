<?php

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$uid = filter_input(INPUT_POST, 'idodblokiraj');

if (empty($uid)) {
    $tekst_greski .= "GRESKA! Niste unijeli id korisnika!</br>";
    $brojac++;
} else {
    $sqlupit = "SELECT * FROM korisnik WHERE idkorisnik='" . $uid . "';";
    if (provjeri_postoji($sqlupit)) {
        $sqlupit = "UPDATE korisnik SET neuspjesne_prijave=0 WHERE idkorisnik='" . $uid . "';";
        unos_baza($sqlupit);
        $tekst_greski .= "Odblokiran je korisnik $uid!</br>";
    } else {
        $tekst_greski .= "GRESKA! Nepostojeći korisnik!</br>";
        $brojac++;
    }
}

echo $tekst_greski;
header("refresh:1;url=blokiranje.php");
?>
