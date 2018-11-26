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
			<div class="col-md-12">
				<?php
					echo $this->session->flashdata('action_status');
					echo validation_errors();
				?>
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-warning"></i> Penting!</h4>
					<p>Jika industri belum terdaftar, daftarkan <a href="<?php echo site_url('industries/add');?>">disini</a></p>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Lowongan</h3>
					</div>
					<div class="box-body">
						<?php echo form_open_multipart('job/edit/'.$job->id, array("role" => "form") ); ?>
						<div class="form-group">
							<label for="name" class="control-label required">Nama Lowongan</label>
							<input type="text" name="name" value="<?php echo $job->name ?>" class="form-control" id="name" required="required" autofocus="autofocus"/>
						</div>

						<div class="form-group">
							<label for="level user" class="control-label">Katagori Lowongan<span class="field-required">*</span></label>
							<div class="form-input">
								<?php
									$daftar_catagory = get_daftar_catagories();
									echo form_dropdown('level_catagory[]', $daftar_catagory, $current_catagory, 'class="form-control"');
								?>
								<small class="help-span">Jika industri belum terdaftar, daftarkan <a href="<?php echo site_url('catagories/add');?>">disini</a></small>
							</div>
						</div>

						<div class="form-group">
							<label for="type">Jenis Pekerjaan <span class="field-required">*</span></label>
							<div class="form-input">
								<?php echo form_dropdown($type,$type_option,$type_value); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="control-label">Deskripsi</label>
							<textarea id="textarea" value="<?php echo $job->description ?>" name="description" placeholder="Deskripsi Pekerjaan" required="required"
							style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
								<?php echo $job->description;?>
							</textarea>
						</div>

						<div class="form-group">
							<label for="requirement" class="control-label required">Persyaratan</label>
							<textarea id="textarea1" value="<?php echo $job->requirement ?>" name="requirement" placeholder="Place some text here" required="required"
							style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
								<?php echo $job->requirement;?>
							</textarea>
						</div>

						<div class="form-group">
							<label for="sallary" class="required">Gaji</label>
							<div class="input-group">
								<span class="input-group-addon"><b>Rp.</b></span>
								<input type="number" name="sallary" value="<?php echo $job->sallary;?>" class="form-control" id="sallary" required="required" >
								<span class="input-group-addon">,00</span>
							</div>
							<small class="help-span">Format harus Angka !</small>
						</div>

						<div class="form-group">
							<label class="control-label required">Berlaku sampai :</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" name="date_expired"  value="<?php echo $job->date_expired ?>" class="form-control pull-right" id="datepicker">
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

						<div class="form-group">
							<div class="btn btn-default btn-file">
								<i class="fa fa-paperclip"></i> Upload File, Max 3MB
								<input type="file" name="filedoc" class="form-control input-50" id="filedoc">
							</div>
							<p class="help-block"><i>File saat ini :</i> <?php echo $job->filedoc;?></p>
						</div>
					</div>

					<input type="hidden" name="date_created" value="<?php echo date('Y-m-d'); ?>" class="form-control input-50" id="date_created" />
					<input type="hidden" name="date_modify" value="<?php echo date('Y-m-d'); ?>" class="form-control input-50" id="date_modify" />

					<div class="box-footer">
						<input type="submit" value="Update" class="btn btn-success submit-btn btn-md"/>
						<a href="<?php echo site_url('job');?>" class="btn btn-md">Batal</a>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
			</div

			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
