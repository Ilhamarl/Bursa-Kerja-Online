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
				<h3 class="box-title"><?php echo $title; ?></h3>
			</div>
			<?php echo $this->session->flashdata('message'); ?>
			<?php echo validation_errors(); ?>

			<div class="box-body">
				<?php echo form_open_multipart('catagories/add',array("role" => "form")); ?>
				<div class="form-group">
					<label for="Nama group" class="control-label required">Nama Katagori</label>
					<input type="text" name="catagory_name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="group_name" placeholder="Nama Katagori Lowongan" required="required" autofocus="autofocus"/>
					<small class="help-span">Contoh: <i>Teknik</i></small>
				</div>

				<div class="form-group">
					<label for="Keterangan" class="control-label required">Deskripsi/Sub Katagori</label>
					<input type="text" name="description" value="<?php echo $this->input->post('description'); ?>" class="form-control" id="description" placeholder="Deskripsi Sub Katagori" required="required"/>
					<small class="help-span">Contoh: <i>Teknik Mesin, Teknik Otomotif..</i></small>
				</div>
			</div>

			<div class="box-footer">
				<input type="submit" value="Submit" class="btn btn-success submit-btn btn-md"/>
				&nbsp;
				<a href="<?php echo site_url('catagories'); ?>" class="btn btn-md btn-danger pull-right">Batal</a>
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
