<?php
$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("baza/baza_funkcije.php");
$tekst_obavijesti = "";

if ((isset($_GET["kod"]) && isset($_GET["korisnik"]))) {
    $primljeni_kod = $_GET["kod"];
    $primljeni_korisnik = $_GET["korisnik"];

    $brojac = 0;

    $sqlupit = "SELECT aktiviran FROM korisnik WHERE korime='" . $primljeni_korisnik . "';";
    $vraceni_redak = vrati_redak($sqlupit);
    if ($vraceni_redak[0] == 0) {
        $sqlupit = "SELECT * FROM kod WHERE vrijednost='" . $primljeni_kod . "';";
        if (provjeri_postoji($sqlupit) == 1) {
            $tekst_obavijesti.= "Aktivacijski kod postoji.<br>";

            $sqlupit = "SELECT iskoristenost, vrijeme FROM kod WHERE vrijednost='" . $primljeni_kod . "';";
            $vraceni_redak = vrati_redak($sqlupit);

            if ($vraceni_redak[0] == 0) {
                $kod_vrijeme = strtotime($vraceni_redak[1]);
                //$trenutno_vrijeme = strtotime(date("Y-m-d H:i:s"));
                $trenutno_vrijeme=strtotime(vvrijeme());
                if ($trenutno_vrijeme - $kod_vrijeme >= 43200) {//12sata*3600sekundi=43200
                    $tekst_obavijesti.= "GREŠKA! Aktivacijski kod je istekao!<br>";
                    $brojac++;
                }
            } else {
                $tekst_obavijesti.= "GREŠKA! Aktivacijski kod je iskoristen!<br>";
                $brojac++;
            }
        } else {
            $tekst_obavijesti.= "GREŠKA! Aktivacijski kod ne postoji!<br>";
            $brojac++;
        }

        if ($brojac == 0) { //nakon obavljanja svih provjera, upis u bazu
            $sqlupit = "UPDATE kod SET iskoristenost=1 WHERE vrijednost='" . $primljeni_kod . "';";
            unos_baza($sqlupit);

            $sqlupit = "UPDATE korisnik SET aktiviran=1, uloga=1 WHERE korime='" . $primljeni_korisnik . "';";
            unos_baza($sqlupit);
            $tekst_obavijesti .= "<br>USPJEH! Aktivirali ste korisnički račun za " . $primljeni_korisnik . " :)<br>";
        } else {
            $tekst_obavijesti .= "<br>Neuspješna aktivacija korisnika " . $primljeni_korisnik . ".<br>";
            $brojac++;
        }
    } else {
        $tekst_obavijesti .= "GREŠKA! Korisnik je već aktiviran!<br>";
        $tekst_obavijesti .= "Neuspješna aktivacija korisnika " . $primljeni_korisnik . ".<br>";
        $brojac++;
    }

    if ($brojac == 0) {
        $tekst_obavijesti .= "U roku od 10 sekundi biti ćete preusmjereni na prijavu.<br>";
        header("refresh:10;url=prijava.php");
    } else {
        $tekst_obavijesti .= "U roku od 10 sekundi biti ćete preusmjereni na početnu stranicu.<br>";
        header("refresh:10;url=index.php");
    }
} else {
    $tekst_obavijesti = "GREŠKA! Skripti nisu proslijeđeni parametri!";
}
?>

<!DOCTYPE html>
<html>    
    <head>
        <title>Aktivacija</title>
        <meta charset="utf-8">
        <meta name="author" content="Damir Drempetić">
        <meta name="keywords" content="FOI, WebDiP, Projekt2016, ljekarna">
        <meta name="description" content="Projekt ljekarna">
        <link rel="stylesheet" href="css/damdrempe.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/damdrempe_print.css" type="text/css" media="print"><!--
        <link rel="stylesheet" href="css/damdrempe_mobiteli.css" type="text/css" media="screen">-->
    </head>

    <body>
        <header id="zaglavlje">
            <a class="naslov" href="index.php">Ljekarna</a><br>
            <a class="opis">WebDiP projekt 2016</a>
        </header>

        <nav>
            <ul id="navigacija">
                <li class="lijevo"><a href="izbornik.php">Izbornik</a></li>
                <li class="lijevo"><a href="dokumentacija.html">Dokumentacija</a></li>                
                <li class="lijevo"><a href="o_autoru.html">O autoru</a></li>
                <li class="desno"><a href="registracija.php">Registracija</a></li>
                <li class="desno"><a href="prijava.php">Prijava</a></li>
            </ul>
        </nav>

        <section id="sadrzaj">
            <div class="centriraj">
                <h2>Stranica za aktivaciju</h2>
                <a>
                    <?php
                    echo $tekst_obavijesti;
                    ?>
                </a>
            </div>
        </section> 

        <footer id="podnozje">
            <a href="https://validator.w3.org/check?uri=<?php echo $vlastita_adresa ?>" target="_blank"><img class="ikona" src="img/HTML5.png" alt="html5 validacija"></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $vlastita_adresa ?>" target="_blank"> <img class="ikona" src="img/CSS3.png" alt="css3 validacija"></a>          
            <address><a href="mailto:damdrempe@foi.hr">KONTAKT: POŠALJI MAIL</a></address> 
            <a>&copy; 2016 Damir Drempetić 41900/13-R</a>         
        </footer>
    </body>
</html>