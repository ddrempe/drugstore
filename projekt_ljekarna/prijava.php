<?php
if (!isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off') {
    $https_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $https_url");
    exit();
}
$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$ukorime = filter_input(INPUT_POST, 'korime');
$ulozinka = filter_input(INPUT_POST, 'lozinka');

session_start();
if (isset($_SESSION['korisnik'])) {
    header("Location: index.php");
}

if (isset($_COOKIE["zadnji_korisnik"])) {
    $zapamceni_korisnik = $_COOKIE["zadnji_korisnik"];
} else
    $zapamceni_korisnik = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($ukorime) || empty($ulozinka)) {
        $tekst_greski .= "GREŠKA! Niste popunili oba polja!</br>";
        $brojac++;
    } else {
        $sqlupit = "SELECT * FROM korisnik WHERE korime='" . $ukorime . "';";
        if (provjeri_postoji($sqlupit)) {
            $vraceni_redak = vrati_redak($sqlupit);
            if ($vraceni_redak["lozinka"] == $ulozinka) {
                if ($vraceni_redak["aktiviran"] == 1) {
                    if ($vraceni_redak["neuspjesne_prijave"] < 4) {
                        $tekst_greski.= "Uspješno ste se prijavili. :)<br>";
                        $_SESSION['korisnik'] = $ukorime;
                        $_SESSION['uloga'] = $vraceni_redak["uloga"];

                        $sqlupit = "UPDATE korisnik SET neuspjesne_prijave=0 WHERE korime='" . $ukorime . "';";
                        unos_baza($sqlupit);
                        
                        $zapis="Prijavio se korisnik $ukorime";
                        $trenutno_vrijeme=vvrijeme();
                        $sqlupit = "INSERT INTO dnevnik (tip_zapisa, zapis, vrijeme, korisnik) VALUES (1, '$zapis', '$trenutno_vrijeme', '$ukorime');";
                        unos_baza($sqlupit);

                        //pamćenje u kolačić
                        if (isset($_POST['zapamti'])) {
                            setcookie("zadnji_korisnik", $ukorime, time() + (3600 * 24 * 30));
                            if(isset($_COOKIE["zadnji_korisnik"])){
                                $zapamceni_korisnik = $_COOKIE["zadnji_korisnik"];                                
                            }
                        }
                    } else {
                        $tekst_greski.= "GREŠKA! Korisnički račun je zaključan!<br>";
                        $brojac++;
                    }
                } else {
                    $tekst_greski.= "GREŠKA! Korisnički račun nije aktiviran!<br>";
                    $brojac++;
                }
            } else {
                $sqlupit = "UPDATE korisnik SET neuspjesne_prijave=neuspjesne_prijave+1 WHERE korime='" . $ukorime . "';";
                unos_baza($sqlupit);

                $tekst_greski.= "GREŠKA! Pogrešna lozinka!<br>";
                $brojac++;
            }
        } else {
            $tekst_greski.= "GREŠKA! Nepostojeće korisničko ime!<br>";
            $brojac++;
        }
    }
}
?>

<!DOCTYPE html>
<html>    
    <head>
        <title>Prijava</title>
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
                <li class="desno"><a class="aktivan" href="prijava.php">Prijava</a></li>
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
            <form id="frmprijava" method="post">
                <div id="sadrzajforme">
                    <h2>Obrazac za prijavu</h2>
                    <label for="korime">Korisničko ime: </label><br>
                    <input type="text" id="korime" name="korime" placeholder="korisničko ime" autofocus="autofocus" value="<?php echo $zapamceni_korisnik; ?>"><br>
                    <label for="lozinka">Lozinka: </label><br>
                    <input type="password" id="lozinka" name="lozinka" placeholder="lozinka"><br>
                    <label for="zapamti">Zapamti me: </label>
                    <input type="checkbox" id="zapamti" name="zapamti" value="1" checked><br>
                    <input type="submit" value="Prijavi se">
                    <a href="zaboravljena_lozinka.php">Zaboravljena lozinka</a>
                </div>

                <div id="greske">
                    <div id="phpgreske">
                        <?php
                        echo $tekst_greski;
                        ?>
                    </div>
                </div>   
            </form>
        </section>

        <footer id="podnozje">
            <a href="https://validator.w3.org/check?uri=<?php echo $vlastita_adresa ?>" target="_blank"><img class="ikona" src="img/HTML5.png" alt="html5 validacija"></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $vlastita_adresa ?>" target="_blank"> <img class="ikona" src="img/CSS3.png" alt="css3 validacija"></a>          
            <address><a href="mailto:damdrempe@foi.hr">KONTAKT: POŠALJI MAIL</a></address> 
            <a>&copy; 2016 Damir Drempetić 41900/13-R</a>         
        </footer>
    </body>
</html>