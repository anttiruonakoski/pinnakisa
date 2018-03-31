
Pinnakisapalvelu
================

**FI**: Sovellus ja verkkopalvelu, johon voi perustaa (lintu)pinnakisoja. Käyttäjät voivat rekisteröityä, osallistua kisoihin ja tallentaa niihin pinnoja, sekä tarkastella reaaliaikaisia tuloksia ja tilastoja. Esimerkki: http://www.tringa.fi/kisa/ 

**EN**: Web application for managing, publishing and participating to (bird) tick contests. Users can register, take part to the contest, record the birds they have obersved, and examine real-time results and statistics as charts and tabular data. Example site: http://www.tringa.fi/kisa/ You can install the system by yourself, or ask to use it as a service <hawk(ät)biomi.org>.

* [Käyttöohje](MANUAL.md)
* [API (rajapinta)](API.md)
* [Kuvakaappauksia](docs/screencaptures.md)

### Tekniset vaatimukset:

* PHP
* Codeigniter framework (testattu versiolla 2.1.4)
* Ion Auth plugin (sisältyy tähän repositoryyn)
* MySQL

Käyttö
------

Voit joko asentaa ohjelmiston itse, tai pyytää päästä käyttämään valmiiksi asennettua versiota <hawk(ät)biomi.org>

### Asennus
1. Hanki ja asenna Codeigniter (ks. versio yllä)
2. Kopioi tämän repositoryn tiedostot Codeigniterin kanssa samaan hakemistoon
3. Luo tyhjä tietokanta ja sille käyttäjä kaikin oikeuksin.
4. Luo ja populoi tietokantataulut. Taulujen tiedot ovat hakemistossa application/sql/ Käytä etuliitettä taulujen nimissä, jos käytät samaa tietokantaa jonkin toisen palvelun kanssa (esim "kisa_").
5. Päivitä omat tietosi application/config -hakemiston tiedostoihin
	1. database.php: tietokannan tiedot
	2. mail.php: postipalvelimen tiedot
	3. config.php: encryption key
6. Rajoita tietokantakäyttäjän oikeudet: vain luku ja kirjoitusoikeudet tarvitaan


**HUOM:** Lajiluettelon lajilyhenteitä ei pidä mennä muuttamaan kisan käynnistymisen jälkeen: tämä aiheuttaa virheitä tulossivuilla ja kadottaa havaintoja tallennettaessa.


Lisenssit / Licenses
--------------------
* Pinnakisapalvelu: [MIT License](LICENSE.md) / Mikko Heikkinen/biomi.org 2013-
* Codeigniter: [MIT License](CODEIGNITER_LICENSE.txt) / British Columbia Institute of Technology 
* Ion Auth: Apache License v2.0 http://www.apache.org/licenses/LICENSE-2.0 / http://benedmunds.com/ion_auth/


TODO
----

MUST:
* Firefox Anttri bugifix

Parannusmahdollisuuksia:

SHOULD:
* Pinnojen poistotoiminto admineille
* Yhteystietojen katselutoiminto admineille
* Osallistumisen poisto / roskakorittaminen
* Estetään tallennus päivämäärillä, jotka ovat kisa-ajan ulkopuolella
* Kisan tietoihin päivämäärät näkyviin suomalaisessa formaatissa p(p).k(k).vvvv
* Käyttäjälle jonkinlainen mahdollisuus piilottaa rarit tallennuslomakkeelta
* Tekstimuutos: Väliaikaisesti suljettu -> Tunnus on suljettu väliaikaisesti liian monen epäonnistumisen kirjautumisen takia. Yritä uudelleen X minuutin kuluttua.
* Lisätietokenttä, joka näkyy kaikille osallistujalistassa, mutta ei liian hallitsevana

NICE:
* Siistimmän näköiset error/success-ilmoitukset
* Mahdollisuus sallia kisaan vain yksi osallistuminen per kisa
* Helpompi linkitys tulokset <-> osallistumislomake
* tunnus luotu -> vahvistus infomessage
* infomessage-tyylit puuttuvat
* pienennä infomessage-fonttia

<<<<<<< HEAD
=======
TODO/100 lajia
----

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
- results_summary -sivun laquo vie rootiin, po palvelun etusivulle
=======
>>>>>>> f4be055... Show dates in Finnish format
=======
=======
- puh ja katuosoite
>>>>>>> d949029... Front page styles and copy
- jquery click -> tap ??
- Fix user info saving feature: http://localhost:70/index.php/auth/edit_user/2
- Kirjaudu sisään -tyylit kun kirjautuminen erääntynyt
>>>>>>> d8b764a... Add styles for tab-style button
- Remove kms, hours, spontaneos (see participation 19bc9aeee726a628f7a40cdcb34438f2524e0f70 )
- Piilota etusivulta kisat, jos ei kirjautunut sisään
<<<<<<< HEAD
>>>>>>> ebb606a... Add new species list & converter
- UI/ulkoasun parantelu
=======
>>>>>>> d949029... Front page styles and copy
- testaus
<<<<<<< HEAD
>>>>>>> 7ff3132... Hide/show rarities

=======
- tietoturva: ei oikeutta editoida/poistaa muiden osallistumisia
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 3656f14... Add deletion feature

=======
- pvm suom.muotoon
=======
>>>>>>> f4be055... Show dates in Finnish format
- harvinaisten piilotus välilehdellä
>>>>>>> 212540c... New bird list with changed order & rarity

Asentaessa muista
- tietokantatiedot CI:n -> config/database.php
- hostname CI:n -> config/config.php

jos käytät Dockeria
- tietokantatiedot env-tiedostoon


### Asennus...

admin
admin
n...3

user nro 1:n voi deletoida

miten sallitaan kirjoitus backups-kansioon? nyt dockerfile:n chmod ei toimi, piti tehdä käsin containerissa
hawk
