<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - Finnish
*
* Author: Jarno Fabritius
*         jarno.fabritius@meisso.com
*         @meisso_jarno
* 
* Author: Mikko Heikkinen
*         @mikkohei13
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  01.03.2011
*
* Description:  Finnish language file for Ion Auth messages and errors
*
*/


// Account Creation
$lang['account_creation_successful']             = 'Tilin luonti onnistui';
$lang['account_creation_unsuccessful']           = 'Tilin luonti epäonnistui';
$lang['account_creation_duplicate_email']        = 'Sähköpostiosoite on virheellinen tai se on jo käytössä';
$lang['account_creation_duplicate_username']     = 'Tunnus on virheellinen tai se on jo käytössä';

// Password
$lang['password_change_successful']              = 'Salasana on nyt vaihdettu';
$lang['password_change_unsuccessful']            = 'Salasanan vaihto ei onnistunut. Tarkista että kirjoitit vanhan salasanan oikein.';
$lang['forgot_password_successful']              = 'Salasanan uudelleenasetusohjeet lähetettiin sähköpostiisi';
$lang['forgot_password_unsuccessful']            = 'Salasanan uudelleenasetus ei onnistunut';

// Activation
$lang['activate_successful']                     = 'Tili on nyt aktivoitu';
$lang['activate_unsuccessful']                   = 'Tilin aktivointi epäonnistui';
$lang['deactivate_successful']                   = 'Tili on suljettu';
$lang['deactivate_unsuccessful']                 = 'Tilin sulkeminen epäonnistui';
$lang['activation_email_successful']             = 'Aktivointiviesti lähetettiin';
$lang['activation_email_unsuccessful']           = 'Aktivointiviestiä ei voitu lähettää';

// Login / Logout
$lang['login_successful']                        = 'Olet nyt kirjautunut sisään';
$lang['login_unsuccessful']                      = 'Kirjautuminen epäonnistui';
$lang['login_unsuccessful_not_active']           = 'Tiliä ei ole aktivoitu';
$lang['login_timeout']                           = 'Tunnus on väliaikaisesti suljettu liian monen virheellisen kirjautumisyrityksen takia. Yritä uudelleen myöhemmin.';
$lang['logout_successful']                       = 'Olet nyt kirjautunut ulos';
  
// Account Changes
$lang['update_successful']                       = 'Tilin tiedot on nyt päivitetty';
$lang['update_unsuccessful']                     = 'Tietojen päivitys epäonnistui';
$lang['delete_successful']                       = 'Tili poistettu';
$lang['delete_unsuccessful']                     = 'Tilin poisto epäonnistui';

// Groups
$lang['group_creation_successful']               = 'Ryhmä luotiin onnistuneesti';
$lang['group_already_exists']                    = 'Ryhmän nimi jo käytössä';
$lang['group_update_successful']                 = 'Ryhmän tiedot päivitetty';
$lang['group_delete_successful']                 = 'Ryhmä poistettu';
$lang['group_delete_unsuccessful']               = 'Ryhmän poisto epäonnistui';
$lang['group_name_required']                     = 'Ryhmän nimi tarvitaan';

// Email Subjects
$lang['email_forgotten_password_subject']        = 'Unohtuneen salasanan palautus';
$lang['email_new_password_subject']              = 'Uusi salasana';
$lang['email_activation_subject']                = 'Tilin aktivointi';

