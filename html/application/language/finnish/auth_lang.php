<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Author: Mikko Heikkinen
*         @mikkohei13
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Kirjaudu';
$lang['login_subheading']      = 'Kirjaudu sähköpostiosoitteellasi ja salasanallasi';
$lang['login_identity_label']  = 'Sähköposti:';
$lang['login_password_label']  = 'Salasana:';
$lang['login_remember_label']  = 'Muista kirjautumiseni ';
$lang['login_submit_btn']      = 'Kirjaudu sisään';
$lang['login_forgot_password'] = 'Unohditko salasanasi?';

// Index
$lang['index_heading']           = 'Käyttäjät';
$lang['index_subheading']        = 'Luettelo käyttäjistä alla.';
$lang['index_fname_th']          = 'Etunimi';
$lang['index_lname_th']          = 'Sukunimi';
$lang['index_email_th']          = 'Sähköposti';
$lang['index_groups_th']         = 'Ryhmät';
$lang['index_status_th']         = 'Tila';
$lang['index_action_th']         = 'Toiminto';
$lang['index_active_link']       = 'Aktiivinen';
$lang['index_inactive_link']     = 'Epäaktiivinen';
$lang['index_create_user_link']  = 'Luo uusi käyttäjä';
$lang['index_create_group_link'] = 'Luo uusi ryhmä';

// Deactivate User
$lang['deactivate_heading']                  = 'Epäaktivoi käyttäjä';
$lang['deactivate_subheading']               = 'Oletko varma että haluat epäaktivoida käyttäjän \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Kyllä:';
$lang['deactivate_confirm_n_label']          = 'Ei:';
$lang['deactivate_submit_btn']               = 'Tallenna';
$lang['deactivate_validation_confirm_label'] = 'varmistus';
$lang['deactivate_validation_user_id_label'] = 'käyttäjän ID';

// Create User
$lang['create_user_heading']                           = 'Luo käyttäjä';
$lang['create_user_subheading']                        = 'Syötä käyttäjän tiedot alle.';
$lang['create_user_fname_label']                       = 'Etunimi:';
$lang['create_user_lname_label']                       = 'Sukunimi:';
$lang['create_user_company_label']                     = 'Yritys:';
$lang['create_user_email_label']                       = 'Sähköposti:';
$lang['create_user_address_label']                       = 'Postiosoite:';
$lang['create_user_password_label']                    = 'Salasana:';
$lang['create_user_password_confirm_label']            = 'Salasana uudelleen:';
$lang['create_user_submit_btn']                        = 'Luo käyttäjä';
$lang['create_user_validation_fname_label']            = 'Etunimi';
$lang['create_user_validation_lname_label']            = 'Sukunimi';
$lang['create_user_validation_email_label']            = 'Sähköpostiosoite';
$lang['create_user_validation_phone1_label']           = 'Puhelinumeron 1. osa';
$lang['create_user_validation_phone2_label']           = 'Puhelinumeron 2. osa';
$lang['create_user_validation_phone3_label']           = 'Puhelinumeron 3. osa';
$lang['create_user_validation_company_label']          = 'Yrityksen nimi';
$lang['create_user_validation_password_label']         = 'Salasana';
$lang['create_user_validation_password_confirm_label'] = 'Salasanan varmistus';
$lang['create_user_validation_old_id_label'] 			= 'Numerosi vanhassa pinnakisapalvelussa';
$lang['create_user_old_id_label']                       = 'Numerosi vanhassa pinnakisapalvelussa:';

// Edit User
$lang['edit_user_heading']                           = 'Muokkaa käyttäjää';
$lang['edit_user_subheading']                        = 'Syötä käyttäjän tiedot alle.';
$lang['edit_user_fname_label']                       = 'Etunimi:';
$lang['edit_user_lname_label']                       = 'Sukunimi:';
$lang['edit_user_company_label']                     = 'Yritys:';
$lang['edit_user_email_label']                       = 'Sähköposti:';
$lang['edit_user_address_label']                     = 'Postiosoite:';
$lang['edit_user_password_label']                    = 'Salasana (vaaditaan tietojen muuttamiseksi):';
$lang['edit_user_password_confirm_label']            = 'Salasanan varmistus:';
$lang['edit_user_groups_heading']                    = 'Jäsen ryhmissä';
$lang['edit_user_submit_btn']                        = 'Tallenna';
$lang['edit_user_validation_fname_label']            = 'Etunimi';
$lang['edit_user_validation_lname_label']            = 'Sukunimi';
$lang['edit_user_validation_email_label']            = 'Sähköpostiosoite';
$lang['edit_user_validation_phone1_label']           = 'Puhelinumeron 1. osa';
$lang['edit_user_validation_phone2_label']           = 'Puhelinumeron 2. osa';
$lang['edit_user_validation_phone3_label']           = 'Puhelinumeron 3. osa';
$lang['edit_user_validation_company_label']          = 'Yrityksen nimi';
$lang['edit_user_validation_groups_label']           = 'Ryhmät';
$lang['edit_user_validation_password_label']         = 'Salasana';
$lang['edit_user_validation_password_confirm_label'] = 'Salasanan varmistus';
$lang['edit_user_validation_old_id_label']			 = 'Numerosi vanhassa pinnakisapalvelussa';
$lang['edit_user_old_id_label']                       = 'Numerosi vanhassa pinnakisapalvelussa:';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Vaihda salasana';
$lang['change_password_old_password_label']                    = 'Vanha salasana:';
$lang['change_password_new_password_label']                    = 'Uusi salasana (ainakin %s merkkiä):';
$lang['change_password_new_password_confirm_label']            = 'Varmista uusi salasana:';
$lang['change_password_submit_btn']                            = 'Päivitä';
$lang['change_password_validation_old_password_label']         = 'Vanha salasana';
$lang['change_password_validation_new_password_label']         = 'Uusi salasana';
$lang['change_password_validation_new_password_confirm_label'] = 'Varmista uusi salasana';

// Forgot Password
$lang['forgot_password_heading']                 = 'Unohtunut salasana';
$lang['forgot_password_subheading']              = 'Syötä sähköpostiosoitteesi niin lähetämme sinulle viestin jonka avulla voit vaihtaa salasanasi.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Lähetä';
$lang['forgot_password_validation_email_label']  = 'Sähköpostiosoite';
$lang['forgot_password_username_identity_label'] = 'Käyttäjätunnus';
$lang['forgot_password_email_identity_label']    = 'Sähköposti';
$lang['forgot_password_email_not_found']         = 'Antamallasi sähköpostiosoitteella ei ole rekisteröidytty palveluun.';

// Reset Password
$lang['reset_password_heading']                               = 'Vaihda salasana';
$lang['reset_password_new_password_label']                    = 'Uusi salasana (ainakin %s merkkiä):';
$lang['reset_password_new_password_confirm_label']            = 'Varmista uusi salasana:';
$lang['reset_password_submit_btn']                            = 'Päivitä';
$lang['reset_password_validation_new_password_label']         = 'Uusi salasana';
$lang['reset_password_validation_new_password_confirm_label'] = 'Varmista uusi salasana';

// Activation Email
$lang['email_activate_heading']    = 'Aktivoi käyttäjän %s tili';
$lang['email_activate_subheading'] = 'Klikkaa tästä %s.';
$lang['email_activate_link']       = 'Aktivoi tilisi';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Uudelleenaseta salasana käyttäjälle %s';
$lang['email_forgot_password_subheading'] = 'Klikkaa tästä %s.';
$lang['email_forgot_password_link']       = 'Uudelleenaseta salasanasi';

// New Password Email
$lang['email_new_password_heading']    = 'Uusi salasana käyttäjälle %s';
$lang['email_new_password_subheading'] = 'Uusi salasanasi: %s';

