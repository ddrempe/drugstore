<?php
session_start();
if (isset($_SESSION['uloga'])) {
    if ($_SESSION['uloga'] < 1) {
        echo "Neovlasten pristup! Nemate ovlasti za pristup stranici.";
        exit(0);
    }
} else {
    echo "Neovlasten pristup! Za nastavak se je potrebno prijaviti.";
    exit(0);
}

$skorime=$_SESSION['korisnik'];
$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require('baza/baza.class.php');
$bp = new Baza();
$sqlupit = "SELECT r.idracun, r.vrijeme, r.lijek, r.kolicina, r.cijena, k.korime FROM racun r, korisnik k WHERE r.idkorisnik=k.idkorisnik AND k.korime='".$skorime."';";
$bp->spojiDB();
$rs = $bp->selectDB($sqlupit);

if ($bp->pogreskaDB()) {
    echo "Problem kod upita na bazu podataka!";
    exit;
}

$tablica = "<table><tr><th>ID</th><th>Vrijeme</th><th>Lijek</th><th>Količina</th><th>Cijena</th><th>Korisnik</th></tr>\n";

while (list($id, $vrijeme, $lijek, $kolicina, $cijena, $korisnik) = $rs->fetch_array()) {
    $tablica.= "<tr><td>$id</td><td>$vrijeme</td><td>$lijek</td><td>$kolicina</td><td>$cijena</td><td>$korisnik</td></tr>\n";
}
$tablica.= "</table>\n";

$rs->close();
$bp->zatvoriDB();
?>
<html>    
    <head>
        <title>Pregledavanje računa</title>
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
        <?php
        if (session_id() == '') {
            session_start();
        }
        if (isset($_SESSION['korisnik'])) {
            echo "<a id=\"prijavljenkor\" href=\"odjava.php\">Trenutno ste prijavljeni kao korisnik $_SESSION[korisnik]. Kliknite ovdje za odjavu.</a>";
        } else
            echo "<a id=\"prijavljenkor\">Korisnik nije prijavljen.</a>";
        ?>

        <section id="sadrzaj">       
            <h2>Ispis računa</h2>
            <div class="centriraj">                
                <?php
                echo $tablica;
                ?>
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