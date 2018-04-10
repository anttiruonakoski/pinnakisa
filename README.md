
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

TODO/100 lajia
----

- results_species sivun alussa &#65279; -> harmaa palkki

- puh ja katuosoite
- jquery click -> tap ??
- Kirjaudu sisään -tyylit kun kirjautuminen erääntynyt
- testaus


### Asennus...

Asentaessa muista
- tietokantatiedot CI:n -> config/database.php
- hostname CI:n -> config/config.php

jos käytät Dockeria
- tietokantatiedot env-tiedostoon

admin
admin
n...3

user nro 1:n voi deletoida

miten sallitaan kirjoitus backups-kansioon? nyt dockerfile:n chmod ei toimi, piti tehdä käsin containerissa
hawk

Jos systeemi antaa virheen Core... Line 346
tarkoittaa tämä että tietokantaan ei saa yhteyttä. Tarkista hostname, käyttis, salasana etc.
