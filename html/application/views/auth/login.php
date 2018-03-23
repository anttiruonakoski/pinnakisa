<?php
$title = " - Pinnakisapalvelu";
include "application/views/page_elements/header.php";
?>

<?php // MH 1.10.2013: changed order ?>
<h1><?php echo lang('login_heading');?></h1>
<div id="infoMessage"><?php echo $message;?></div>
<p><?php echo lang('login_subheading');?></p>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

<?php
include "application/views/page_elements/footer.php";
?>