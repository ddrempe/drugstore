function provjeri(forma) {
    var brojac = 0;
    var tekst_greski = "";

    //ime mora početi velikim slovom i biti duljine barem 3
    if (forma["ime"].value === "") {
        tekst_greski += "Niste unijeli ime!<br>";
        brojac++;
    } else {
        if (forma["ime"].value[0] !== forma["ime"].value[0].toUpperCase()) {
            tekst_greski += "Ime mora početi velikim slovom!</br>";
            brojac++;
        } else if (forma["ime"].value.length < 3) {
            tekst_greski += "Ime ne može imati manje od 3 slova!</br>";
            brojac++;
        }
    }

    //prezime mora početi velikim slovomi i biti duljine barem 3
    if (forma["prezime"].value === "") {
        tekst_greski += "Niste unijeli prezime!<br>";
        brojac++;
    } else {
        if (forma["prezime"].value[0] !== forma["prezime"].value[0].toUpperCase()) {
            tekst_greski += "Prezime mora početi velikim slovom!</br>";
            brojac++;
        } else if (forma["prezime"].value.length < 3) {
            tekst_greski += "Prezime ne može imati manje od 3 slova!</br>";
            brojac++;
        }
    }

    //godina
    if (forma["godina"].value === "") {
        tekst_greski += "Niste unijeli godinu rođenja!<br>";
        brojac++;
    } else {
        if (forma["godina"].value < 1930 || forma["godina"].value > 2016) {
            tekst_greski += "Godina nije u rasponu 1930-2016!<br>";
            brojac++;
        }

    }

    //email
    if (forma["email"].value === "") {
        tekst_greski += "Niste unijeli e-mail!<br>";
        brojac++;
    } else {
        var rizraz = /^\w{1,}@\w{1,}\.\w{1,}$/;
        if (!rizraz.test(forma["email"].value)) {
            tekst_greski += "E-mail mora biti oblika (nesto@nesto.nesto)!</br>";
            brojac++;
        }
    }

    //korisničko ime duljine 4-12, mala slova i brojke
    if (forma["korime"].value === "") {
        tekst_greski += "Niste unijeli korisničko ime!<br>";
        brojac++;
    } else {
        var rizraz = /^(?=.*[a-z])[a-z0-9]{4,12}$/;
        if (!rizraz.test(forma["korime"].value)) {
            tekst_greski += "Neispravno korisničko ime!</br>";
            brojac++;
        }
    }

    //lozinka duljine barem 8 znakova, velika i mala slova, posebni znakovi, brojke
    if (forma["lozinka"].value === "") {
        tekst_greski += "Niste unijeli lozinku!<br>";
        brojac++;
    } else {
        var rizraz = /(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[!#$?])(?=.*[0-9])/;
        if (!rizraz.test(forma["lozinka"].value)) {
            tekst_greski += "Neispravna lozinka!</br>";
            brojac++;
        }
    }

    //potvrda lozinke
    if (forma["lozinka2"].value === "") {
        tekst_greski += "Niste potvrdili lozinku!<br>";
        brojac++;
    } else {
        if (forma["lozinka"].value !== forma["lozinka2"].value) {
            tekst_greski += "Lozinke se ne podudaraju!<br>";
            brojac++;
        }
    }

    //recaptcha
    if (forma["g-recaptcha-response"].value === "") {
        tekst_greski += "Niste popunili reCAPTCHA potvrdu!<br>";
        brojac++;
    }

    tekst_greski += "Broj pogrešno popunjenih polja: " + brojac + " <br>";
    var divgreske = document.getElementById('jsgreske');
    divgreske.innerHTML = tekst_greski;

    if (brojac === 0)
        return true;
    else
        return false;
}

document.getElementById("frmregistracija").addEventListener("submit", function (event)
{
    if (provjeri(this) === true)
        return true;
    else
        event.preventDefault();
}
);
