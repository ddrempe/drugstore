<?php
$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require(dirname(__DIR__) . '/baza/baza.class.php');

$bp = new Baza();
$sqlupit = "SELECT idkorisnik, ime, prezime, email, korime, lozinka, uloga FROM korisnik";
$bp->spojiDB();
$rs = $bp->selectDB($sqlupit);

if ($bp->pogreskaDB()) {
    echo "Problem kod upita na bazu podataka!";
    exit;
}

$tablica = "<table><tr><th>ID</th><th>Ime</th><th>Prezime</th><th>E-mail</th><th>Korisničko ime</th><th>Lozinka</th><th>Uloga</th></tr>\n";

while (list($id, $ime, $prezime, $email, $korime, $lozinka, $uloga) = $rs->fetch_array()) {
    switch ($uloga) {
        case 0:
            $uloga = "Neregistrirani korisnik (0)";
            break;
        case 1:
            $uloga = "Registrirani korisnik (1)";
            break;
        case 2:
            $uloga = "Moderator (2)";
            break;
        case 3:
            $uloga = "Administrator (3)";
            break;
    }
    $tablica.= "<tr><td>$id</td><td>$ime</td><td>$prezime</td><td>$email</td><td>$korime</td><td>$lozinka</td><td>$uloga</td></tr>\n";
}
$tablica.= "</table>\n";

$rs->close();
$bp->zatvoriDB();
?>

<!DOCTYPE html>
<html>    
    <head>
        <title>Ispis korisnika</title>
        <meta charset="utf-8">
        <meta name="author" content="Damir Drempetić">
        <meta name="keywords" content="FOI, WebDiP, Projekt2016, ljekarna">
        <meta name="description" content="Projekt ljekarna">
        <link rel="stylesheet" href="../css/damdrempe.css" type="text/css" media="screen">
        <link rel="stylesheet" href="../css/damdrempe_print.css" type="text/css" media="print"><!--
        <link rel="stylesheet" href="css/damdrempe_mobiteli.css" type="text/css" media="screen">-->
    </head>

    <body>
        <header id="zaglavlje">
            <a class="naslov" href="../index.php">Ljekarna</a><br>
            <a class="opis">WebDiP projekt 2016</a>
        </header>

        <nav>
            <ul id="navigacija">
                <li class="lijevo"><a href="../izbornik.php">Izbornik</a></li>
                <li class="lijevo"><a href="../dokumentacija.html">Dokumentacija</a></li>                
                <li class="lijevo"><a href="../o_autoru.html">O autoru</a></li>
                <li class="desno"><a href="../registracija.php">Registracija</a></li>
                <li class="desno"><a href="../prijava.php">Prijava</a></li>
            </ul>
        </nav>

        <section id="sadrzaj">
            <div class="centriraj">
                <h2>Ispis korisnika iz baze podataka</h2> 
            </div>
            <h3>Tablica korisnici</h3>
            <?php
            echo $tablica;
            ?>
        </section> 

        <footer id="podnozje">
            <a href="https://validator.w3.org/check?uri=<?php echo $vlastita_adresa ?>" target="_blank"><img class="ikona" src="../img/HTML5.png" alt="html5 validacija"></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $vlastita_adresa ?>" target="_blank"> <img class="ikona" src="../img/CSS3.png" alt="css3 validacija"></a>          
            <address><a href="mailto:damdrempe@foi.hr">KONTAKT: POŠALJI MAIL</a></address> 
            <a>&copy; 2016 Damir Drempetić 41900/13-R</a>         
        </footer>
    </body>
</html>