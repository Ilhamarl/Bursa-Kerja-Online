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
						<h3 class="box-title"><?php echo lang('edit_group_heading');?></h3>
					</div>
					<div id="infoMessage"><?php echo $message;?></div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php echo form_open(current_url());?>
					<div class="box-body">
						<div class="form-group">
							<label>Nama Grup</label>
							<?php echo form_input($group_name);?>
						</div>
						<div class="form-group">
							<label>Deskripsi Grup</label>
							<?php echo form_input($group_description);?>
						</div>
					</div>
					<!-- /.box -->
					<div class="box-footer">
						<?php echo form_submit('submit','Update Group',('class = "btn btn-md btn-primary"'));?>
						<?php if( $group->id != 1 && $group->id != 2):?>
						<a class="btn btn-danger btn-md pull-right" href="<?php echo site_url("admin/delete_group/".$group->id);?>" data-toggle="modal" data-target="#modal-danger">Delete</a>
						<?php endif;?>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
			<!-- /MODAL DELETE -->
										<div class="modal modal-danger fade" id="modal-danger">
											<div class="modal-dialog">
												<div class="modal-content">
													
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
			
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		</section>
		<!-- /.content -->
	</div>
<!-- /.content-wrapper -->