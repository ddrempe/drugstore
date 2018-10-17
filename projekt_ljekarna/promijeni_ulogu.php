<?php

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$uid = filter_input(INPUT_POST, 'iduloga');
$uuloga = filter_input(INPUT_POST, 'uloga');

if (empty($uid)||empty($uuloga)) {
    $tekst_greski .= "GRESKA! Niste unijeli id korisnika!</br>";
    $brojac++;
} else {
    $sqlupit = "SELECT * FROM korisnik WHERE idkorisnik='" . $uid . "';";
    if (provjeri_postoji($sqlupit)) {
        $sqlupit = "UPDATE korisnik SET uloga=".$uuloga." WHERE idkorisnik='" . $uid . "';";
        unos_baza($sqlupit);
        $tekst_greski .= "Promijenjena je uloga $uid!</br>";
    } else {
        $tekst_greski .= "GRESKA! Nepostojeći korisnik!</br>";
        $brojac++;
    }
}

echo $tekst_greski;
header("refresh:1;url=blokiranje.php");
?>
