<?php
require("baza/baza_funkcije.php");
$json_file = file_get_contents('http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json');
$jfo = json_decode($json_file, true);
$pomak = $jfo['WebDiP']['vrijeme']['pomak']['brojSati'];
echo $pomak;
$trenutno_vrijeme = date("Y-m-d H:i:s");

$sqlupit = "UPDATE vvrijeme set pomak='".$pomak."', trenutno='".$trenutno_vrijeme."' WHERE idvvrijeme=1;";
unos_baza($sqlupit);

$tekst_obavijesti = "U roku od 2 sekunde biti ćete preusmjereni na početnu stranicu administratora.<br>";
echo $tekst_obavijesti;
header("Location: izbornik.php");
?>