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
				<?php echo form_open('industries/edit/'.$group->id, array( "role" => "form" ) ); ?>
				<div class="form-group">
					<label for="Nama group" class="control-label required">Nama Industri</label>
					<input type="text" name="group_name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $group->name); ?>" class="form-control" id="name" required="required" autofocus="autofocus"/>
					<small class="help-span pull">Contoh: <i>PT.Example  /  CV.Example</i></small>
				</div>
				
				<div class="form-group">
					<label for="Keterangan" class="control-label required">Keterangan</label>
					<input type="text" name="group_description" value="<?php echo ($this->input->post('description') ? $this->input->post('description') : $group->description); ?>" class="form-control" id="group" required="required"/>
					<small class="help-span">Contoh: <i>Perusahaan Otomotif</i></small>
				</div>
				
				<div class="form-group">
					<label for="about" class="control-label required">Tentang Industri</label>
					<textarea type="text" name="about" value="<?php echo ($this->input->post('about') ? $this->input->post('about') : $group->about);?>" class="form-control" id="about" required="required"><?php echo $group->about;?></textarea>
					<small class="help-span"><i>Penjelasan tentang sejarah atau gambaran profil industri !</i></small>
				</div>
				
				<div class="form-group">
					<label class="control-label required">Website</label>
					<input type="url" name="website" value="<?php echo ($this->input->post('website') ? $this->input->post('website') : $group->website); ?>" class="form-control" id="website" required="required"/>
					<small class="help-span">Contoh: http://example.com</small>
				</div>
				
				<div class="form-group">
					<label for="phone" class="control-label required">Telepon</label>
					<input type="phone" name="phone" value="<?php echo ($this->input->post('phone') ? $this->input->post('phone') : $group->phone); ?>" class="form-control" id="phone" required="required" data-inputmask='"mask": "+62 9999 9999 9999"' data-mask>
					<small class="help-span">Contoh: <i>+62  0821... </i> atau <i> +62  021-xxxxxx</i></small>
				</div>
				
				<div class="form-group">
					<label for="location" class="control-label required">Kota</label>
					<input type="text" name="location" value="<?php echo ($this->input->post('location') ? $this->input->post('location') : $group->location); ?>" class="form-control" id="location" placeholder="Kota/Kab. ..." required="required"/>
					<small class="help-span">Contoh : <i>Kota Jakarta</i> / <i>Kab. Sleman</i> !</small>
				</div>
				
				<div class="form-group">
					<label for="address" class="control-label required">Alamat</label>
					<input type="text" name="address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $group->address); ?>" class="form-control" id="address" placeholder="Alamat" required="required"/>
				</div>
			</div>
			
			<div class="box-footer">
				<input type="submit" value="Update" class="btn btn-success submit-btn btn-md"/>
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