<?php
// Show if we are using development database
if ("tring657_kisa_dev" == $this->db->database)
{
	$dev_info = "<span class=\"dev-note\">DEVELOPMENT DB</span> ";
	$dev_class = "development";
}
else
{
	$dev_info = "";
	$dev_class = "production";
}

?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo htmlspecialchars($title, ENT_COMPAT, 'UTF-8'); ?></title>
        <meta name="viewport" content="initial-scale=1">

        <link rel="stylesheet" href="<?php echo base_url(); ?>/application/views/page_elements/css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/application/views/page_elements/css/main.css?<?php echo rand(0, 1000); ?>">

        <link href='https://fonts.googleapis.com/css?family=Overlock:400,700|PT+Sans:400,700' rel='stylesheet' type='text/css'>

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
        
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<!--<script>window.jQuery || document.write('<script src="application/views/page_elements/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>-->

		<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="<?php echo base_url(); ?>application/views/page_elements/js/main.js?<?php echo rand(0, 1000); ?>"></script>
		<script src="<?php echo base_url(); ?>application/views/page_elements/js/vendor/tablesorter/jquery.tablesorter.min.js"></script>
		<?php echo @$script; ?>
    </head>
	
    <body<?php

	if ($this->ion_auth->logged_in())
	{
		if ($this->ion_auth->is_admin())
		{
			echo " class=\"adminin $dev_class\"";		
		}
		else
		{
			echo " class=\"loggedin $dev_class\"";
		}
	}
	else
	{
		echo " class=\"guest $dev_class\"";
	}
	
	?>><p id="toolNavi">
<?php

echo $dev_info;
echo "<span><a href=\"" . base_url() . "\" id=\"home\">Etusivu</a></span> ";
if ($this->ion_auth->logged_in())
{	
	echo "<span><a href=\"" . site_url("redirect/participation") . "\" id=\"home\">Oma lajiluettelo</a></span> ";
}
echo "<span><a href=\"" . site_url("redirect/results") . "\" id=\"home\">Tulokset</a></span> ";
echo " <span>•</span> ";

$userData = $this->ion_auth->user()->row();

if ($this->ion_auth->logged_in())
{	
    echo "<span><strong>" . htmlspecialchars($userData->email, ENT_COMPAT, 'UTF-8') . "</strong></span> ";
	if ($this->ion_auth->is_admin())
	{
		echo " <span><strong id=\"youAreAdmin\" title=\"Olet administrator\">admin</strong></span> ";
	}
	echo "<span><a href=\"" . site_url("auth/change_password") . "\">Vaihda salasana</a></span> ";
	echo "<span><a href=\"" . site_url("auth/edit_user/" . $userData->id) . "\">Muokkaa tietojasi</a></span> ";
	echo "<span><a href=\"" . site_url("auth/logout") . "\">Kirjaudu ulos</a></span> ";
}
else
{
	echo "<span><a href=\"" . site_url("auth/login") . "\" title=\"Kirjaudu sisään osallistuaksesi\">Kirjaudu sisään</a></span> ";
	echo "<span><a href=\"" . site_url("auth/create_user") . "\">Rekisteröidy</a></span> ";
//	echo "<span><a href=\"" . site_url("auth/forgot_password") . "\">Unohtuiko salasana?</a></span> ";
}
?>

</p>
<div id="content">
