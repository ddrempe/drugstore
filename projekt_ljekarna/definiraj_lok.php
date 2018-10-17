<?php

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$uulica = filter_input(INPUT_POST, 'ulica');
$uduzina = filter_input(INPUT_POST, 'duzina');
$usirina = filter_input(INPUT_POST, 'sirina');

if (empty($uulica)||empty($uduzina)||empty($usirina)) {
    $tekst_greski .= "GRESKA! Niste unijeli sva polja!</br>";
    $brojac++;
} else {
    $sqlupit = "INSERT INTO poslovnica (ulica,duzina,sirina) VALUES ('$uulica', '$uduzina', '$usirina');";
    unos_baza($sqlupit);
}

echo $tekst_greski;
header("refresh:1;url=definiranje_lokacija.php");
?>
