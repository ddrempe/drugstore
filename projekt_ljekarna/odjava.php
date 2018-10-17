<?php
session_start();

require("baza/baza_funkcije.php");
$skorime=$_SESSION['korisnik'];
$zapis = "Odjavio se korisnik $skorime";
$trenutno_vrijeme = vvrijeme();
$sqlupit = "INSERT INTO dnevnik (tip_zapisa, zapis, vrijeme, korisnik) VALUES (2, '$zapis', '$trenutno_vrijeme', '$skorime');";
unos_baza($sqlupit);

if (session_id() != "") {
    session_unset();
    session_destroy();
}
header('location: prijava.php');
?>