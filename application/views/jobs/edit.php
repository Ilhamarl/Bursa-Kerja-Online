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
		<?php
			echo $this->session->flashdata('message');
			echo validation_errors();
		?>
		<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Penting!</h4>
				<p>Jika industri belum terdaftar, daftarkan <a href="<?php echo site_url('industries/add');?>">disini</a></p>
		</div>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Lowongan</h3>
			</div>
			<div class="box-body">
				<?php echo form_open('jobs/edit/'.$user->id, array("role" => "form") ); ?>
				<div class="form-group">
					<label for="name" class="control-label required">Nama Lowongan</label>
					<input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" required="required" autofocus="autofocus"/>
				</div>

				<div class="form-group">
					<label for="type">Jenis Pekerjaan <span class="field-required">*</span></label>
					<div class="form-input">
						<select name="type" class="form-control select2" id="type" data-placeholder="Jenis Pekerjaan" required="required">
							<?php
							$selected = NULL;
							if ($user->type){
							$selected = 'selected="selected"';
							}
							?>
							<option value="Full Time" <?php echo $selected;?>>Full Time</option>
							<option value="Part Time" <?php echo $selected;?>>Part Time</option>
							<option value="Freelance" <?php echo $selected;?>>Freelance</option>
							<option value="Kontrak" <?php echo $selected;?>>Kontrak</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="description" class="control-label">Deskripsi</label>
					<textarea id="textarea" value="<?php echo $user->description ?>" name="description" placeholder="Deskripsi Pekerjaan" required="required"
					style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
						<?php echo $user->description;?>
					</textarea>
				</div>

				<div class="form-group">
					<label for="requirement" class="control-label required">Persyaratan</label>
					<textarea id="textarea1" value="<?php echo $user->requirement ?>" name="requirement" placeholder="Place some text here" required="required"
					style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
						<?php echo $user->requirement;?>
					</textarea>
				</div>

				<div class="form-group">
					<label for="sallary" class="required">Gaji</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-money"></i></span>
					<input type="number" name="sallary" value="<?php echo $user->sallary ?>" class="form-control" id="sallary" required="required" >
					<span class="input-group-addon">.00</span>
					</div>
					<small class="help-span">Format harus Angka !</small>
				</div>

				<div class="form-group">
					<label class="control-label required">Berlaku sampai :</label>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="date" name="date_expired"  value="<?php echo $user->date_expired ?>" class="form-control pull-right" id="datepicker">
					</div>
					<!-- /.input group -->
				</div>

				<div class="form-group">
					<label for="level user" class="control-label">Nama Perusahaan<span class="field-required">*</span></label>
					<div class="form-input">
						<?php
							$daftar_level = get_daftar_groups();
							echo form_dropdown('level_user[]', $daftar_level, $current_level, 'class="form-control select2"');
						?>
						<small class="help-span">Jika industri belum terdaftar, daftarkan <a href="<?php echo site_url('industries/add');?>">disini</a></small>
					</div>
				</div>
			</div>

			<input type="hidden" name="date_created" value="<?php echo date('Y-m-d'); ?>" class="form-control input-50" id="date_created" />
			<input type="hidden" name="date_modify" value="<?php echo date('Y-m-d'); ?>" class="form-control input-50" id="date_modify" />

			<div class="box-footer">
				<input type="submit" value="Update" class="btn btn-md btn-success"/>
				<a href="<?php echo site_url('jobs');?>" class="btn btn-md btn-danger pull-right">Batal</a>
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
