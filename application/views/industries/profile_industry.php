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
			<div class="col-xs-12">
				<div id="infoMessage"><?php echo $message;?></div>

				<?php foreach ($groups as $group):

					$foto_url = base_url().'/uploads/'.$group->foto;
					$thumbnail_foto_url = base_url().'/uploads/'.$group->thumb_foto;
					?>
					<div class="box box-primary">
						<div class="box-body box-profile">
							<img class="profile-user-img img-responsive img-square" src="<?php echo $thumbnail_foto_url;?>" alt="User profile picture">
							<h3 class="profile-username text-center">
								<b><?php echo $group->name;?></b>
							</h3>

							<p class="text-muted text-center"><a href="<?php echo $group->website;?>"><?php echo $group->website;?></a></p>

							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b><i class="fa fa-file-text-o margin-r-5"></i>  Deskripsi :</b>
									<a class="pull-right"><?php echo $group->description;?></a>
								</li>
								<li class="list-group-item">
									<b><i class="fa fa-map margin-r-5"></i> Lokasi : </b>
									<a class="pull-right"><?php echo $group->location;?></a>
								</li>
							</ul>
							<div class="row">
								<div class="col-md-12">
									<?php if ($this->ion_auth->is_admin()): ?>
										<a href="<?php echo site_url("industries/edit/".$group->id); ?>" class="btn btn-primary btn-block"><b>Update Industry Profile</b></a>
									<?php endif ?>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>

					<!-- About Me Box -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">About</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<strong><i class="fa fa-info-circle margin-r-5"></i> Tentang Industri</strong>
							<p class="text-muted"><?php echo $group->about;?></p>
							<hr>

							<strong><i class="fa fa-map-marker margin-r-5"></i>Alamat</strong>
							<p class="text-muted"><a href="https://www.google.co.id/maps/place/<?php echo $group->address;?>,<?php echo $group->location;?>" target="_blank"><?php echo $group->address;?>, <i><?php echo $group->location;?></i></a></p>
							<hr>

							<strong><i class="fa fa-user margin-r-5"></i> No.Handphone</strong>
							<p class="text-muted"><?php echo $group->phone;?></p>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
			<?php endforeach;?>
		</div>

		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
	<?php if (!$this->ion_auth->is_user())
	{
		echo '</div>';
	}
	?>
</div>
<!-- /.content-wrapper -->
