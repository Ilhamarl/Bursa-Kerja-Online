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
	<div class="col-md-12">
		<div id="infoMessage"><?php echo $message;?></div>
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo lang('change_password_heading');?></h3>
			</div>
			<!-- /.box-header -->
			<?php echo form_open("user/change_password");?>
			<div class="box-body">
				<div class="form-group">
					<?php echo lang('change_password_old_password_label', 'old_password');?> 
					<?php echo form_input($old_password);?>
				</div>
				
				<div class="form-group">
					<label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br/>
					<?php echo form_input($new_password);?>
					<div class="progress" style="margin:0">
						<div class="pwstrength_viewport_progress"></div>
					</div>
				</div>
				
				<div class="form-group">
					<?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br/>
					<?php echo form_input($new_password_confirm);?>
					<div class="progress" style="margin:0">
						<div class="pwstrength_viewport_progress"></div>
					</div>
					<span id='message'></span>
				</div>
				
				<?php echo form_input($user_id);?>
				<?php echo form_submit('submit',lang('change_password_submit_btn'),('class = "btn btn-primary pull-right"'));?>
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