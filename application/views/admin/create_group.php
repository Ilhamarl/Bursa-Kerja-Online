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
						<h3 class="box-title"><?php echo lang('create_group_heading');?></h3>
					</div>
					<div id="infoMessage"><?php echo $message;?></div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php echo form_open("admin/create_group");?>
					<div class="box-body">
						<div class="form-group">
							<label><?php echo lang('create_group_name_label', 'group_name');?></label>
							<?php echo form_input($group_name);?>
						</div>
						<div class="form-group">
							<label><?php echo lang('create_group_desc_label', 'description');?></label>
							<?php echo form_input($description);?>
						</div>
					</div>
					<!-- /.box -->
					<div class="box-footer">
						<?php echo form_submit('submit',lang('create_group_submit_btn'),('class = "btn btn-md btn-primary"'));?>
					</div>
					<?php echo form_close();?>
				</div>
			</div>

			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		</section>
		<!-- /.content -->
	</div>
<!-- /.content-wrapper -->
