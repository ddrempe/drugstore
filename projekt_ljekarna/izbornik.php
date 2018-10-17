<?php
if (isset($_SERVER['HTTPS'])) {
    $http_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $http_url");
    exit();
}

require("baza/baza_funkcije.php");

$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$brojac = 0;
$tekst_greski = "";
session_start();
if (isset($_SESSION['uloga'])) {
    if ($_SESSION['uloga'] >= 1) {
        $tekst_greski .="<h2>Registrirani korisnik</h2>";
        $tekst_greski .="<a class='izborniklink' href = 'lokacije_mapa.php'>Poslovnice ljekarne</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'pregledavanje_racuna.php'>Pregledavanje računa</a><br>";
    }
    if ($_SESSION['uloga'] >= 2) {
        $tekst_greski .="<h2>Moderator</h2>";
        $tekst_greski .= "<a class='izborniklink' href = 'definiranje_lijekova.php'>Definiranje lijekova</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'kreiranje_akcija.php'>Kreiranje akcija</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'dodjela_akcija.php'>Dodjela akcija</a><br>";
    }
    if ($_SESSION['uloga'] >= 3) {
        $tekst_greski .="<h2>Administrator</h2>";
        $tekst_greski .= "<a class='izborniklink' href = 'http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html?format=json' target ='_blank'>Unesi pomak</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'virtualno_vrijeme.php'>Spremi pomak u bazu</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'blokiranje.php'>Blokiranje korisnika</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'definiranje_lokacija.php'>Definiranje lokacija</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'kreiranje_kategorija.php'>Kreiranje kategorija</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'dodjela_moderatora.php'>Dodjela moderatora</a><br>";
        $tekst_greski .= "<a class='izborniklink' href = 'pregled_dnevnika.php'>Pregled dnevnika</a><br>";
    }
} else {
    $tekst_greski .= "Pristup je dozvoljen isključivo registriranim korisnicima.<br>";
}
?>

<!DOCTYPE html>
<html>    
    <head>
        <title>Izbornik</title>
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
                <li class="lijevo"><a class="aktivan" href="izbornik.php">Izbornik</a></li>
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

        <section id="sadrzaj" style="padding-bottom: 200px;">
            <div class="centriraj">
                <h1>Izbornik</h1>
                <div class="izborniklink">
                    <?php echo $tekst_greski; ?>
                </div>
            </div>

        </section> 

        <footer id="podnozje">
            <a id="htaccess" href="privatno/korisnici.php">Ispis korisnika (.htaccess)</a>
            <a href="https://validator.w3.org/check?uri=<?php echo $vlastita_adresa ?>" target="_blank"><img class="ikona" src="img/HTML5.png" alt="html5 validacija"></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $vlastita_adresa ?>" target="_blank"> <img class="ikona" src="img/CSS3.png" alt="css3 validacija"></a>          
            <address><a href="mailto:damdrempe@foi.hr">KONTAKT: POŠALJI MAIL</a></address> 
            <a>&copy; 2016 Damir Drempetić 41900/13-R</a> 
            <?php echo "<br>Dohvaćeno vrijeme: "; echo vvrijeme();?>
        </footer>
    </body>
</html>