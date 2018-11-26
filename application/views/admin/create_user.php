<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;?> <small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title;?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


		<div class="row">
			<!-- left column -->
			<div class="col-sm-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $title;?></h3>
					</div>
					<div id="infoMessage"><?php echo $message;?></div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php echo form_open_multipart("admin/create_user");?>
					<div class="box-body">

						<div class="form-group">
							<label><?php echo lang('create_user_fname_label', 'first_name');?></label>
							<?php echo form_input($first_name);?>
						</div>
						<div class="form-group">
							<label><?php echo lang('create_user_lname_label', 'last_name');?></label>
							<?php echo form_input($last_name);?>
						</div>

						<div class="form-group">
							<label><?php echo lang('create_user_email_label', 'email');?></label>
							<?php echo form_input($email);?>
							<?php
								if($identity_column!=='email') {
									echo form_error('identity');
								}
							?>
						</div>

						<div class="form-group">
							<label>Username</label>
							<?php echo form_input($identity);?>
							<?php
								if($identity_column!=='email') {
									echo form_error('identity');
								}
							?>
						</div>

						<div class="form-group">
							<label>Alamat</label>
							<?php echo form_input($address);?>
						</div>
						<div class="form-group">
							<label><?php echo lang('create_user_phone_label', 'phone');?> </label>
							<?php echo form_input($phone);?>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1"><?php echo lang('create_user_password_label', 'password');?> </label>
							<?php echo form_input($password);?>

							<div class="progress" style="margin:0">
								<div class="pwstrength_viewport_progress"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
							<?php echo form_input($password_confirm);?>
						</div>
					</div>
					<!-- /.box -->
					<div class="box-footer">
						<?php echo form_submit('submit', lang('create_user_submit_btn'),('class = "btn btn-md btn-primary"'));?>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
