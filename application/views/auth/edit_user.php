<?php
$title = " - Pinnakisapalvelu";
include "application/views/page_elements/header.php";
?>

<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php // echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string());?>

      <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>
	  
      <p>
            <?php echo lang('edit_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            <?php echo lang('edit_user_old_id_label', 'old_id');?> <br />
            <?php echo form_input($old_id);?>
      </p>

      <p id="p_password">
            <?php echo lang('edit_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

<!--
      <p>
            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
            <?php echo form_input($password_confirm);?>
      </p>
-->

	<?php
	// Only admins can edit their groups
	if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
	{
		echo "<h3>" . lang('edit_user_groups_heading') . "</h3>";
		foreach ($groups as $group)
		{
			echo "<label class=\"checkbox\">";
				$gID=$group['id'];
				$checked = null;
				$item = null;
				foreach($currentGroups as $grp) {
					if ($gID == $grp->id) {
						$checked= ' checked="checked"';
					break;
					}
				}
			echo "<input type=\"checkbox\" name=\"groups[]\" value=\"" . $group['id'] . "\" $checked>";
			echo $group['name'];
			echo "</label>";
		}
	}
	?>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

<?php echo form_close();?>

<?php
include "application/views/page_elements/footer.php";
?>
