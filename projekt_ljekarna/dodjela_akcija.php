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

$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require('baza/baza.class.php');
$bp = new Baza();
$sqlupit = "SELECT l.idlijek, l.naziv, l.cijena, a.idakcija, a.naziv, a.postotak FROM lijek l, akcija a, na_akciji na WHERE l.idlijek=na.lijek_idlijek AND a.idakcija=na.akcija_idakcija;";
$bp->spojiDB();
$rs = $bp->selectDB($sqlupit);

if ($bp->pogreskaDB()) {
    echo "Problem kod upita na bazu podataka!";
    exit;
}

$tablica = "<table><tr><th>ID lijek</th><th>Lijek</th><th>Cijena</th><th>ID akcija</th><th>Akcija</th><th>Postotak</th><th>Nova cijena</th></tr>\n";

while (list($idlijek, $naziv, $cijena, $idakcija, $akcija, $postotak) = $rs->fetch_array()) {
    $nova_cijena=$cijena*((100-$postotak)/100);
    $tablica.= "<tr><td>$idlijek</td><td>$naziv</td><td>$cijena</td><td>$idakcija</td><td>$akcija</td><td>$postotak</td><td>$nova_cijena</td></tr>\n";
}
$tablica.= "</table>\n";

$rs->close();
$bp->zatvoriDB();
?>
<!DOCTYPE html>
<html>    
    <head>
        <title>Dodjela akcija</title>
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
            <form novalidate method="post" action="dodjeli_akciju.php">
                <div id="frmunosbaza">
                    <h2>Dodjela akcija</h2>
                    <label for="idmod">ID lijek: </label>
                    <input type="text" id="idl" name="idl" placeholder="id lijek" ><br>
                    <label for="naziv">ID akcija: </label>
                    <input type="text" id="ida" name="ida" placeholder="id akcija" ><br>
                    <input type="submit" value="Pošalji">
                </div>
            </form>
            <h2>Ispis lijekova na akciji</h2>
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