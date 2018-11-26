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
				<?php echo form_open('catagories/edit/'.$catagory->id, array( "role" => "form" ) ); ?>
				<div class="form-group">
					<label for="Nama group" class="control-label required">Nama Katagori</label>
					<input type="text" name="catagory_name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $catagory->name); ?>" class="form-control" id="name" required="required" autofocus="autofocus"/>
					<small class="help-span">Contoh: <i>Teknik</i></small>
				</div>

				<div class="form-group">
					<label for="Keterangan" class="control-label required">Deskripsi/Sub Katagori</label>
					<input type="text" name="catagory_description" value="<?php echo ($this->input->post('description') ? $this->input->post('description') : $catagory->description); ?>" class="form-control" id="group" required="required"/>
					<small class="help-span">Contoh: <i>Teknik Mesin, Teknik Otomotif..</i></small>
				</div>
			</div>

			<div class="box-footer">
				<input type="submit" value="Update" class="btn btn-success submit-btn btn-md"/>
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
