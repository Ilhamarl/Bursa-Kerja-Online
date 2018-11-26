<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div>
			<div id="infoMessage"><?php echo $message;?></div>
			
			<?php echo form_open('user/edit_user');?>
			<div class="box-body">
				<div class="form-group">
					<label><?php echo lang('edit_user_fname_label', 'first_name');?></label>
					<?php echo form_input($first_name);?>
				</div>
				
				<div class="form-group">
					<label><?php echo lang('edit_user_lname_label', 'last_name');?></label>
					<?php echo form_input($last_name);?>
				</div>
				
				<div class="form-group">
					<label>Alamat :</label>
					<?php echo form_textarea($address);?>
				</div>
				
				<div class="form-group">
					<label><?php echo lang('edit_user_phone_label', 'phone');?></label>
					<?php echo form_input($phone);?>
				</div>
				
				<div class="form-group">
					<label for="exampleInputPassword1"><?php echo lang('edit_user_password_label', 'password');?></label>
					<?php echo form_input($password);?>
					<div class="progress" style="margin:0">
						<div class="pwstrength_viewport_progress"></div>
					</div>
					
				</div>
				
				<div class="form-group">
					<label for="exampleInputPassword1"><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
					<?php echo form_input($password_confirm);?>
					<span id='message'></span>
				</div>
				
			</div> 
			
			<div class="box-footer">
				<?php echo form_input($user_id);?>
				<?php echo form_submit('submit',lang('edit_user_submit_btn'),('class = "btn btn-md btn-primary"'));?>
			</div>
			<?php echo form_close();?>
			
		</div>
	</div>
</div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->