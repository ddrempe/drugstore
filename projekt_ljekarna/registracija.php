<?php
$vlastita_adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("baza/baza_funkcije.php");
$tekst_greski = "";
$uime = filter_input(INPUT_POST, 'ime');
$uprezime = filter_input(INPUT_POST, 'prezime');
$ugodina = filter_input(INPUT_POST, 'godina');
$uemail = filter_input(INPUT_POST, 'email');
$ukorime = filter_input(INPUT_POST, 'korime');
$ulozinka = filter_input(INPUT_POST, 'lozinka');
$ulozinka2 = filter_input(INPUT_POST, 'lozinka2');

session_start();
if (isset($_SESSION['korisnik'])) {
    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $brojac = 0;
    foreach ($_POST as $k => $vr) {
        if (empty($vr)) {
            $brojac = 1;
        }
    }
    if ($brojac != 0) {
        $tekst_greski = "PHP: Niste popunili sva polja obrasca!</br>";
    } else {
        $rizraz = "/^[a-zA-Z]+$/";
        if (!preg_match($rizraz, $uime)) {
            $tekst_greski .= "PHP: Ime je neispravno! </br>";
            $brojac++;
        }

        $rizraz = "/^[a-zA-Z]+$/";
        if (!preg_match($rizraz, $uprezime)) {
            $tekst_greski .= "PHP: Prezime je neispravno! </br>";
            $brojac++;
        }

        if ($ugodina < 1930 || $ugodina > 2016) {
            $tekst_greski .= "PHP: Godina nije u rasponu 1930-2016!<br>";
            $brojac++;
        }

        if (!is_numeric($ugodina)) {
            $tekst_greski .= "PHP: Godina nije broj!<br>";
            $brojac++;
        }

        if (strlen($uemail) > 40) {
            $tekst_greski .= "PHP: E-mail je predugačak!<br>";
            $brojac++;
        }

        if ($ulozinka != $ulozinka2) {
            $tekst_greski .= "PHP: Lozinke se ne podudaraju!<br>";
            $brojac++;
        }

        $sqlupit = "SELECT email FROM korisnik WHERE email='" . $uemail . "';";
        if (provjeri_postoji($sqlupit) == 1) {
            $tekst_greski .= "PHP: E-mail adresa je zauzeta!</br>";
            $brojac++;
        }
    }

    if ($brojac == 0) {
        //upis korisnika
        $sqlupit = "INSERT INTO korisnik(ime,prezime,godina,email,korime,lozinka)
                VALUES('$uime', '$uprezime', '$ugodina','$uemail','$ukorime', '$ulozinka');";
        unos_baza($sqlupit);
        $tekst_greski .= "Uspješno ste podnijeli zahtjev za registraciju!</br>";

        //aktivacijski kod
        //$vrijeme = date("Y-m-d H:i:s");
        $vrijeme =vvrijeme();
        $kod = $ukorime . $vrijeme;
        $kod = hash('md5', $kod);
        $sql = "INSERT INTO kod (vrijednost, vrijeme) VALUES('$kod', '$vrijeme');";
        unos_baza($sql);

        //slanje maila
        $mail_to = $uemail;
        $mail_from = "From: damdrempe@foi.hr";
        $mail_subject = "Ljekarna - Aktivacija racuna";
        $mail_body = "Uspjesno ste se registrirali! </br> Aktivirajte racun na linku: http://barka.foi.hr/WebDiP/2015_projekti/WebDiP2015x019/aktivacija.php?korisnik=" . $ukorime . "&kod=" . $kod . "";

        if (mail($mail_to, $mail_subject, $mail_body, $mail_from)) {
            $tekst_greski .= "Poslana poruka za: '$mail_to'!</br>";
        } else {
            $tekst_greski .= "Problem kod poruke za: '$mail_to'!</br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>    
    <head>
        <title>Registracija</title>
        <meta charset="utf-8">
        <meta name="author" content="Damir Drempetić">
        <meta name="keywords" content="FOI, WebDiP, Projekt2016, ljekarna">
        <meta name="description" content="Projekt ljekarna">
        <link rel="stylesheet" href="css/damdrempe.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/damdrempe_print.css" type="text/css" media="print"><!--
        <link rel="stylesheet" href="css/damdrempe_mobiteli.css" type="text/css" media="screen">-->
        <script src='https://www.google.com/recaptcha/api.js'></script>
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
                <li class="desno"><a class="aktivan" href="registracija.php">Registracija</a></li>
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
            <form novalidate id="frmregistracija" name="frmregistracija" method="post">
                <div id="sadrzajforme">
                    <h2>Obrazac za registraciju</h2>
                    <label for="ime">Ime: </label>
                    <input type="text" id="ime" name="ime" placeholder="ime"><br>
                    <label for="prezime">Prezime: </label>
                    <input type="text" id="prezime" name="prezime" placeholder="prezime"><br>
                    <label for="godina">Godina rođenja: </label>
                    <input type="number" id="godina" name="godina" placeholder="od 1930 do 2016"><br> 
                    <label for="email">E-mail adresa: </label>
                    <input type="email" id="email" name="email" placeholder="e-mail" ><br>
                    <label for="korime">Korisničko ime: </label>
                    <input type="text" id="korime" name="korime" placeholder="korisničko ime"><br>
                    <label for="lozinka">Lozinka: </label>
                    <input type="password" id="lozinka" name="lozinka" placeholder="lozinka"><br>
                    <label for="lozinka2">Potvrdite lozinku: </label>
                    <input type="password" id="lozinka2" name="lozinka2" placeholder="potvrdite lozinku"><br>

                    <label>Potvrdite da niste robot: </label>                                 
                    <div class="g-recaptcha" data-sitekey="6LcZzB4TAAAAAK94zM7vPW6XJUjaWvQT3EGlcy6c"></div>                  
                    <input type="submit" value="Registriraj se">
                </div>

                <div id="greske">
                    <div id="jsgreske">

                    </div>
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
        <script type="text/javascript" src="js/registracija.js"></script>
    </body>
</html>