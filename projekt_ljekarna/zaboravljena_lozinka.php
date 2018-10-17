<?php
$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("baza/baza_funkcije.php");
$brojac = 0;
$tekst_greski = "";
$uemail = filter_input(INPUT_POST, 'email');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($uemail)) {
        $tekst_greski .= "GREŠKA! Niste unijeli e-mail adresu!</br>";
        $brojac++;
    } else {
        $sqlupit = "SELECT * FROM korisnik WHERE email='" . $uemail . "';";
        if (provjeri_postoji($sqlupit)) {
            //unos nove lozinke u bazu
            $vrijeme = date("Y-m-d H:i:s");
            $lozinka = $uemail. $vrijeme;
            $lozinka = hash('crc32', $lozinka);
            $sqlupit = "UPDATE korisnik SET lozinka='" . $lozinka . "' WHERE email='" . $uemail . "';";
            unos_baza($sqlupit);

            //slanje maila
            $mail_to = $uemail;
            $mail_from = "From: damdrempe@foi.hr";
            $mail_subject = "Ljekarna - Resetiranje lozinke";
            $mail_body = "Vaša nova lozinka je: " . $lozinka . "";

            if (mail($mail_to, $mail_subject, $mail_body, $mail_from)) {
                $tekst_greski .= "Poslana je nova lozinka na: '$mail_to'!</br>";
            } else {
                $tekst_greski .= "Problem kod poruke za: '$mail_to'!</br>";
            }

        } else {
            $tekst_greski .= "GREŠKA! Nepostojeća e-mail adresa!</br>";
            $brojac++;
        }
    }
}
?>
<html>    
    <head>
        <title>Zaboravljena lozinka</title>
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
            <form novalidate id="frmzaboravljena" name="frmzaboravljena" method="post">
                <div id="sadrzajforme">
                    <h2>Zaboravljena lozinka</h2>
                    <label for="email">E-mail adresa: </label>
                    <input type="email" id="email" name="email" placeholder="e-mail" ><br>
                    <input type="submit" value="Pošalji">
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