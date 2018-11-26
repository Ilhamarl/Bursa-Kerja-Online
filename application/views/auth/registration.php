<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="register-box">
	<div class="register-logo">
		<a href="<?php echo site_url('dashboard');?>">Register</a>
	</div>
	<div id="infoMessage"><?php echo $message;?></div>
	<div class="register-box-body">
		<p class="login-box-msg">Register a new membership</p>

		<?php echo form_open("auth/register_user");?>
		<div class="form-group has-feedback">
			<?php echo form_input($first_name);?>
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>

		<div class="form-group has-feedback">
			<?php echo form_input($last_name);?>
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>

		<div class="form-group has-feedback">
			<?php echo form_input($email);?>
			<?php if($identity_column!=='email') {
				echo form_error('identity');
			}
			?>
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>

		<div class="form-group has-feedback">
			<?php echo form_input($password);?>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			<div class="progress" style="margin:0">
				<div class="pwstrength_viewport_progress"></div>
			</div>
		</div>

		<div class="form-group has-feedback">
			<?php echo form_input($password_confirm);?>
			<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			<span id='message'></span>
		</div>

		<div class="row">
			<div class="col-xs-8">
				<div class="checkbox icheck">
					<a href="<?php echo site_url('auth/login');?>" class="text-center">I already have a membership</a>
				</div>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
				<?php echo form_submit('submit', lang('login_signup'),('class = "btn btn-primary btn-block btn-flat"'));?>
			</div>
			<!-- /.col -->
		</div>
		<?php echo form_close();?>
		</div>
	<!-- /.form-box -->
</div>
<!-- /.register-box -->
