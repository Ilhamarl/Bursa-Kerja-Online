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
						<?php echo form_open_multipart('industries/add',array("role" => "form")); ?>
						<div class="form-group">
							<label for="Nama group" class="control-label required">Nama Industri</label>
							<input type="text" name="group_name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="group_name" placeholder="Contoh: PT.Example" required="required" autofocus="autofocus"/>
							<small class="help-span">Contoh: <i>PT.Example  /  CV.Example</i></small>
						</div>

						<div class="form-group">
							<label for="Keterangan" class="control-label required">Deskripsi</label>
							<input type="text" name="description" value="<?php echo $this->input->post('description'); ?>" class="form-control" id="description" placeholder="Deskripsi" required="required"/>
							<small class="help-span">Contoh: <i>Perusahaan Otomotif</i></small>
						</div>

						<div class="form-group">
							<label for="about" class="control-label required">Tentang Industri</label>
							<textarea type="text" name="about" value="<?php echo $this->input->post('about'); ?>" class="form-control" id="about" placeholder="Perusahaan ini bergerak di bidang ..." required="required"></textarea>
							<small class="help-span"><i>Penjelasan tentang sejarah atau gambaran profil industri !</i></small>
						</div>

						<div class="form-group">
							<label for="email" class="control-label required">Website</label>
							<input type="url" name="website" value="<?php echo $this->input->post('website'); ?>" class="form-control" id="website" placeholder="http://..."/>
							<small class="help-span">Contoh: http://example.com</small>
						</div>

						<div class="form-group">
							<label for="phone" class="control-label required">Telepon</label>
							<input type="phone" name="phone" value="<?php echo $this->input->post('phone'); ?>" class="form-control" id="phone" required="required" data-inputmask='"mask": "+62 9999 9999 9999"' data-mask>
							<small class="help-span">Contoh: <i>+62821... </i> atau <i> 021-xxxxxx</i></small>
						</div>

						<div class="form-group">
							<label for="location" class="control-label required">Kota</label>
							<input type="text" name="location" value="<?php echo $this->input->post('location'); ?>" class="form-control" id="location" placeholder="Kota/Kab. ..." required="required"/>
							<small class="help-span">Contoh : <i>Kota Jakarta</i> / <i>Kab. Sleman</i> !</small>
						</div>

						<div class="form-group">
							<label for="address" class="control-label required">Alamat</label>
							<input type="text" name="address" value="<?php echo $this->input->post('address'); ?>" class="form-control" id="address" placeholder="Alamat Lengkap" required="required"/>
						</div>

						<div class="form-group">
							<div class="btn btn-default btn-file">
								<i class="fa fa-paperclip"></i> Upload Foto Industri
								<input type="file" name="foto" class="form-control input-50" id="foto" required="required">
							</div>
							<p class="help-block">Max. 3MB</p>
						</div>

					</div>

					<div class="box-footer">
						<input type="submit" value="Submit" class="btn btn-success submit-btn btn-md"/>
						&nbsp;
						<a href="<?php echo site_url('industries'); ?>" class="btn btn-md btn-danger pull-right">Batal</a>
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
