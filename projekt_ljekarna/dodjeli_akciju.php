<?php

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$uidakcija = filter_input(INPUT_POST, 'ida');
$uidlijek = filter_input(INPUT_POST, 'idl');

if (empty($uidakcija) || empty($uidlijek)) {
    $tekst_greski .= "GRESKA! Niste unijeli sva polja!</br>";
    $brojac++;
} else {
    $sqlupit = "INSERT INTO na_akciji (akcija_idakcija, lijek_idlijek) VALUES ('$uidakcija', '$uidlijek');";
    unos_baza($sqlupit);
}

echo $tekst_greski;
header("refresh:1;url=dodjela_akcija.php");
?>
