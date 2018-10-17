<?php

require("baza/baza.class.php");

//provjera da li postoji redak u bazi
function provjeri_postoji($fupit) {
    $postoji = 0;
    $bp = new Baza();
    $bp->spojiDB();
    $rs = $bp->selectDB($fupit);
    if ($bp->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }
    if ($rs->num_rows != 0) {
        $postoji = 1;
    }
    $rs->close();
    $bp->zatvoriDB();
    return $postoji;
}

//za insert i update
function unos_baza($fupit) {
    $bp = new Baza();
    $bp->spojiDB();
    $rs = $bp->updateDB($fupit);
    if ($bp->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }
    $bp->zatvoriDB();
}

//dohvati jedan redak kao polje
function vrati_redak($fupit) {
    $bp = new Baza();
    $bp->spojiDB();
    $rs = $bp->selectDB($fupit);
    if ($bp->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }

    $red = $rs->fetch_array();

    $rs->close();
    $bp->zatvoriDB();
    return $red;
}

function vrati_retke($fupit) {
    $bp = new Baza();
    $bp->spojiDB();
    $rs = $bp->selectDB($fupit);
    if ($bp->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }

    while ($red = $rs->fetch_assoc()) {
        $redovi[] = $red;
    }

    $rs->close();
    $bp->zatvoriDB();
    return $redovi;
}

function dohvati_vvpomak() {
    $fupit="SELECT pomak FROM vvrijeme WHERE idvvrijeme=1;";
    $bp = new Baza();
    $bp->spojiDB();
    $rs = $bp->selectDB($fupit);
    if ($bp->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }

    $red = $rs->fetch_array();

    $rs->close();
    $bp->zatvoriDB();
    return $red[0];
}
   
function vvrijeme(){
    $vpomak=dohvati_vvpomak();
    $virtualno_vrijeme = date("Y-m-d H:i:s ", strtotime("+"."$vpomak"."hours"));
    
    return $virtualno_vrijeme;
}

//function unos_baza_dnevnik($fupit, $korisnik) {
//    $trenutno_vrijeme = vvrijeme();
//    $bp = new Baza();
//    $bp->spojiDB();
//    $rs = $bp->updateDB($fupit);
//    if ($bp->pogreskaDB()) {
//        echo "Problem kod upita na bazu podataka!";
//        exit;
//    }
//    $upit_dnevnik="INSERT INTO dnevnik (tip_zapisa, zapis, vrijeme, korisnik) VALUES ('3', '$fupit', '$trenutno_vrijeme', '$korisnik');";
//    $rs = $bp->updateDB($upit_dnevnik);
//    $bp->zatvoriDB();
//}

?>