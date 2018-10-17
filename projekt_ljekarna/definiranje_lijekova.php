<?php
session_start();
if (isset($_SESSION['uloga'])) {
    if ($_SESSION['uloga'] < 2) {
        echo "Neovlasten pristup! Nemate ovlasti za pristup stranici.";
        exit(0);
    }
} else {
    echo "Neovlasten pristup! Za nastavak se je potrebno prijaviti.";
    exit(0);
}
$skorime = $_SESSION['korisnik'];
$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require('baza/baza.class.php');
$bp = new Baza();
$sqlupit = "SELECT lijek.idlijek, lijek.naziv, lijek.cijena, kategorija.idkategorija, kategorija.naziv FROM lijek JOIN kategorija ON lijek.idkategorija=kategorija.idkategorija;";
$bp->spojiDB();
$rs = $bp->selectDB($sqlupit);

if ($bp->pogreskaDB()) {
    echo "Problem kod upita na bazu podataka!";
    exit;
}

$tablica = "<table><tr><th>ID lijek</th><th>Naziv</th><th>Cijena</th><th>Id kategorija</th><th>Naziv</th></tr>\n";

while (list($idlijek, $naziv, $cijena, $idkat, $nazivkat) = $rs->fetch_array()) {
    $tablica.= "<tr><td>$idlijek</td><td>$naziv</td><td>$cijena</td><td>$idkat</td><td>$nazivkat</td></tr>\n";
}
$tablica.= "</table>\n";

$sqlupit = "SELECT k.idkategorija, k.naziv, kor.idkorisnik, kor.korime FROM kategorija k, korisnik kor, moderira m WHERE k.idkategorija=m.idkategorija AND kor.idkorisnik=m.idkorisnik AND kor.korime='$skorime';";
$rs = $bp->selectDB($sqlupit);
$tablica2 = "<table><tr><th>ID Kategorija</th><th>Kategorija</th><th>ID Moderator</th><th>Moderator</th></tr>\n";

while (list($idkategorija, $naziv, $idkor, $nazivkor) = $rs->fetch_array()) {
    $tablica2.= "<tr><td>$idkategorija</td><td>$naziv</td><td>$idkor</td><td>$nazivkor</td></tr>\n";
}
$tablica2.= "</table>\n";

$rs->close();
$bp->zatvoriDB();
?>
<html>    
    <head>
        <title>Definiranje lijekova</title>
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
            <form novalidate method="post" action="definiraj_lijek.php">
                <div id="frmunosbaza">
                    <h2>Definiranje lijekova</h2>
                    <label for="ulica">Naziv: </label>
                    <input type="text" id="naziv" name="naziv" placeholder="naziv" ><br>
                    <label for="duzina">Cijena: </label>
                    <input type="text" id="cijena" name="cijena" placeholder="cijena" ><br>
                    <label for="duzina">ID kategorija: </label>
                    <input type="text" id="kategorija" name="kategorija" placeholder="id kategorija" ><br>
                    <input type="submit" value="Pošalji">
                </div>
            </form>
            <h2>Ispis lijekova i kategorija</h2>              
            <?php
            echo $tablica;
            echo "<br>";
            ?>
            <h2>Ispis dostupnih kategorija za moderiranje</h2>
            <?php
            echo $tablica2;
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