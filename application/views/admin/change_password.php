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
	<div class="col-sm-12">
		<div id="infoMessage"><?php echo $message;?></div>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo lang('change_password_heading');?></h3>
			</div>
			<?php echo form_open("admin/change_password");?>
			<div class="box-body">
				<div class="form-group">
					<?php echo lang('change_password_old_password_label', 'old_password');?>
					<?php echo form_input($old_password);?>
				</div>
				<div class="form-group">
					<?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?><br/>
					<?php echo form_input($new_password);?>
					<div class="progress" style="margin:0">
						<div class="pwstrength_viewport_progress"></div>
					</div>
				</div>
				<div class="form-group">
					<?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br/>
					<?php echo form_input($new_password_confirm);?>
					<span id='message'></span>
				</div>
			</div>
			<div class="box-footer">
				<?php echo form_input($user_id);?>
				<?php echo form_submit('submit',lang('change_password_submit_btn'),('class = "btn btn-sm btn-primary"'));?>
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
