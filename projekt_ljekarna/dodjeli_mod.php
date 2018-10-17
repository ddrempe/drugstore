<?php

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$uidkat = filter_input(INPUT_POST, 'idkat');
$uidmod = filter_input(INPUT_POST, 'idmod');

if (empty($uidkat) || empty($uidmod)) {
    $tekst_greski .= "GRESKA! Niste unijeli sva polja!</br>";
    $brojac++;
} else {
    $sqlupit = "INSERT INTO moderira (idkategorija, idkorisnik) VALUES ('$uidkat', '$uidmod');";
    unos_baza($sqlupit);
    
    $sqlupit = "UPDATE korisnik SET uloga=2 WHERE idkorisnik=".$uidmod.";";
    unos_baza($sqlupit);
}

echo $tekst_greski;
header("refresh:1;url=dodjela_moderatora.php");
?>
