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
				echo $this->session->flashdata('message');
				echo validation_errors();
				?>
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-warning"></i> Penting!</h4>
					<p>Jika industri belum terdaftar, daftarkan <a href="<?php echo site_url('industries/add');?>"><b>disini</b></a>.</p>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $title; ?></h3>
					</div>
					<div class="box-body">
						<?php echo form_open_multipart('job/add',array("role" => "form"));?>

						<div class="form-group">
							<label for="name">Nama Lowongan</label>
							<input type="text" name="name" value="<?php echo $this->form_validation->set_value('name');?>" class="form-control" id="name" required="required" autofocus="autofocus"/>
						</div>
						<!--
						<div class="form-group">
							<label for="type">Katagori<span class="field-required">*</span></label>
							<div class="form-input">
								<select name="catagory" class="form-control" data-placeholder="Jenis Pekerjaan" required="required">
									<option value="Administrasi">Administrasi</option>
									<option value="Manajemen">Manajemen</option>
									<option value="Bangunan/Konstruksi">Bangunan/Konstruksi</option>
									<option value="Multimedia">Multimedia</option>
									<option value="Ilmu Pengentahuan">Ilmu Pengentahuan</option>
									<option value="Keahlian Teknik">Keahlian Teknik</option>
									<option value="Pelayanan Jasa">Pelayanan Jasa</option>
									<option value="Teknologi Informasi">Teknologi Informasi</option>
								</select>
							</div>
						</div>-->

						<div class="form-group">
							<label for="level user">Katagori Lowongan<span class="field-required">*</span></label>
							<div class="form-input">
								<?php
								$daftar_catagory = get_daftar_catagories();
								echo form_dropdown('level_catagory[]', $daftar_catagory, '', 'class="form-control select2"');
								?>
								<small class="help-span">Jika katagori belum terdaftar, daftarkan <a href="<?php echo site_url('catagories/add');?>">disini</a></small>
							</div>
						</div>

						<div class="form-group">
							<label for="type">Jenis Pekerjaan <span class="field-required">*</span></label>
							<div class="form-input">
								<select name="type" class="form-control" id="type" data-placeholder="Jenis Pekerjaan" required="required">
									<option value="<?php echo $this->form_validation->set_value('type','Full Time');?>">Full Time</option>
									<option value="<?php echo $this->form_validation->set_value('type','Part Time');?>">Part Time</option>
									<option value="<?php echo $this->form_validation->set_value('type','Freelance');?>">Freelance</option>
									<option value="<?php echo $this->form_validation->set_value('type','Kontrak');?>">Kontrak</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label>Deskripsi<span class="field-required">*</span></label>
							<textarea id="textarea" value="<?php echo $this->form_validation->set_value('description');?>"  name="description" placeholder="Deskripsikan Pekerjaan" required="required"
								style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
							</div>

							<div class="form-group">
								<label class="required">Persyaratan <span class="field-required">*</span></label>
								<textarea id="textarea1" value="<?php echo $this->form_validation->set_value('requirement');?>" name="requirement" placeholder="Persyaratan Lamaran" required="required"
									style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
								</div>

								<div class="form-group">
									<label for="sallary" class="required">Gaji</label>
									<div class="input-group">
										<span class="input-group-addon"><b>Rp.</b></span>
										<input type="number" name="sallary" value="<?php echo $this->form_validation->set_value('sallary');?>" class="form-control" id="sallary" required="required">
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
										<input type="date" id="datepicker" name="date_expired"  value="<?php echo $this->form_validation->set_value('date_expired');?>" class="form-control pull-right"/>
									</div>
									<!-- /.input group -->
								</div>

								<div class="form-group">
									<label for="level user">Nama Industri/Perusahaan<span class="field-required">*</span></label>
									<div class="form-input">
										<?php
										$daftar_level = get_daftar_groups();
										echo form_dropdown('level_user[]', $daftar_level, '', 'class="form-control select2"');
										?>
										<small class="help-span">Jika industri belum terdaftar, daftarkan <a href="<?php echo site_url('industries/add');?>">disini</a></small>
									</div>
								</div>

								<div class="form-group">
									<div class="btn btn-default btn-file">
										<i class="fa fa-paperclip"></i> Upload File Formulir
										<input type="file" name="filedoc" class="form-control input-50" id="filedoc">
									</div>
									<p class="help-block">Max. 3MB</p>
								</div>

								<input type="hidden" name="date_created" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date_created" />

								<input type="hidden" name="date_modify" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="date_modify" />

							</div>
							<div class="box-footer">
								<button type="submit"  value="Submit" class="btn btn-success">Submit</button>
								<a href="<?php echo site_url('job');?>" class="btn" >Batal</a>
							</div> <!-- /form-actions -->

							<?php echo form_close(); ?>

						</div>
					</div>
				</div>

				<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
