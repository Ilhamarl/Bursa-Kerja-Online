<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="login-box">
	<div class="login-logo">
		<img src="https://cdn.rawgit.com/Ilhamarl/CI-Burger/87782ea9/assets/images/SMKMbali.png" height="80" width="80" alt="Login">
		<p><small><?php echo lang('forgot_password_heading');?></small></p>
	</div>
	<!-- /.login-logo -->
	
	<div id="infoMessage"><?php echo $message;?></div>
	<div class="login-box-body">
		<p class="login-box-msg text-center"><small><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></small></p>
		
		<?php echo form_open("auth/forgot_password");?>
			<div class="form-group has-feedback">
				<label for="identity">
				<?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
				<?php echo form_input($identity);?>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>

			<div class="row">
				<!-- /.col -->
				<div class="col-xs-8">
					<a href="login"><?php echo('Back to Login');?></a>
					</div>
				<div class="col-xs-4">
					<?php echo form_submit('submit', lang('forgot_password_submit_btn'),('class="btn btn-primary btn-block btn-flat"'));?>
				</div>
				<!-- /.col -->
			</div>
		<?php echo form_close();?>

	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->