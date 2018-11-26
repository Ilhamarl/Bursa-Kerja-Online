<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php if (!$this->ion_auth->is_user())
	{
		echo '<div class="container">';
	}
	?>
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
			<div class="col-md-4">
				<div id="infoMessage"><?php echo $message;?></div>

				<?php foreach ($users as $user):?>
					<div class="box box-primary">
						<div class="box-body box-profile">
							<?php foreach ($user->groups as $group):?>
								<a href="<?php echo site_url('industries/data_industry/'.$group->id);?>" class="profile-user-img img-responsive img-square" target="_blank"><img src="<?php echo base_url('uploads/'.$group->thumb_foto);?>" width="90"></a>
							<?php endforeach;?>
							<h3 class="profile-username text-center"><b><?php echo $user->name;?></b></h3>
							<p class="text-muted text-center">
								<?php echo ($user->active) ? '<span class="label label-success">'.lang('index_active_link').'</span>' : '<span class="label label-warning">'.lang('index_inactive_link').'</span>'; ?>
							</p>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b><i class="fa fa-industry"></i> Industri : </b>
									<p class="pull-right">
										<?php foreach ($user->groups as $group):?>
											<a href="<?php echo site_url('industries/data_industry/'.$group->id);?>" class="btn btn-xs btn-primary pull-right"><?php echo $group->name;?></a>
										<?php endforeach;?>
									</p>
								</li>

								<li class="list-group-item">
									<b><i class="fa fa-info"></i> Jenis Pekerjaan : </b>
									<a class="pull-right"><span class="label label-warning"><?php echo $user->type;?></a>
									</li>

									<li class="list-group-item">
										<b><i class="fa fa-calendar"></i> Berlaku hingga : </b>
										<a class="pull-right">
											<?php echo waktu($user->date_expired);?>
										</a>
									</li>

								</ul>
								<div class="row">
									<div class="col-md-12">
										<?php if ($this->ion_auth->is_admin()): ?>
											<a href="<?php echo site_url("jobs/edit/".$user->id); ?>" class="btn btn-primary btn-block"><b>Ubah Lowongan</b></a>
										<?php endif;?>
										<?php
										if($user->filedoc == NULL ){
											echo '<a href="" target="_blank" class="btn btn-sm btn-default btn-block"><i class="fa fa-download"></i> Form Belum Tersedia</a>';
										}
										else
										{
											?>
											<a href="<?php echo base_url('uploads/'.$user->filedoc);?>" target="_blank" class="btn btn-sm btn-default btn-block"><i class="fa fa-download"></i> Download Form</a>
										<?php }?>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
						</div>

					</div>
					<div class="col-md-8">
						<!-- About Me Box -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">About</h3>
								<small class="pull-right">
									<i>Post</i> : <?php echo waktu($user->created_on);?>
								</small>
							</div>

							<!-- /.box-header -->
							<div class="box-body">
								<strong><i class="fa fa-flag margin-r-5"></i> Katagori</strong>
								<p class="text-muted">
									<?php foreach ($user->catagories as $catagory){?>
										<?php echo $catagory->name;?>
									<?php }?>
								</p>
								<hr>

								<strong><i class="fa fa-file-text-o margin-r-5"></i> Deskripsi</strong>
								<p class="text-muted"><?php echo $user->description;?></p>
								<hr>

								<strong><i class="fa fa-info-circle margin-r-5"></i> Persyaratan</strong>
								<p class="text-muted"><?php echo $user->requirement;?></p>
								<hr>

								<strong><i class="fa fa-calendar margin-r-5"></i> Waktu tutup lowongan </strong>
								<p class="text-muted"><?php echo waktu($user->date_expired);?></p>
								<hr>

								<strong><i class="fa fa-user margin-r-5"></i> Gaji</strong>
								<p class="text-muted">Rp.<?php echo $user->sallary;?> ,00</p>

							</div>
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
			<?php endforeach;?>
		</section>
		<?php if (!$this->ion_auth->is_user())
		{
			echo '</div>';
		}
		?>
	</div>
