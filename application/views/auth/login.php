<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo site_url('dashboard');?>"><img src="https://raw.githubusercontent.com/Ilhamarl/Bursa-Kerja-AdminLTE/master/assets/images/SMKMbali.png" height="80" width="80" alt="Login"></a>
		<p><small><?php echo lang('login_heading');?></small></p>
	</div>
	<!-- /.login-logo -->
	<div id="infoMessage"><?php echo $message;?></div>
	<div class="login-box-body">
		<p class="login-box-msg text-center"><small><?php echo lang('login_subheading');?></small></p>
		<?php echo form_open("auth/login");?>
		<div class="form-group has-feedback">
			<?php echo form_input($identity);?>
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<?php echo form_input($password);?>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="row">
			<div class="col-xs-8">
				<?php echo form_checkbox('remember', '1', FALSE, 'id="input" type="checkbox" class="icheck"');?>&nbsp<?php echo('Remeber me')?>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
				<?php echo form_submit('submit', lang('login_submit_btn'),('class="btn btn-primary btn-block btn-flat"'));?>
			</div>
			<!-- /.col -->
		</div>
		<?php echo form_close();?>
		<br>
		<div class="login-box-msg">
			<div class="col-xs-12">
				<a href="<?php echo site_url('auth/register_user');?>" class="text-center"><p><?php echo lang('login_signup');?></p></a>
			</div>
			<!--
				<div class="col-xs-6">
				<a href="<?php echo site_url('auth/forgot_password');?>" class="text-center"><small><?php echo lang('login_forgot_password');?></small></a>
				</div>
			-->
		</div>
	</div>
	<!-- /.login-box-body -->
</div><!-- /.login-box -->
