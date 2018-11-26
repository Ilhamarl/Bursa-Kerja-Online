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
	<div class="col-md-12">
		<div id="infoMessage"><?php echo $message;?></div>

		<?php foreach ($users as $user):?>
		<div class="box box-primary">
			<div class="box-body box-profile">
				<a href=""><img class="profile-user-img img-responsive img-circle" src="https://raw.githubusercontent.com/Ilhamarl/Bursa-Kerja-AdminLTE/master/assets/dist/img/user2-160x160.png" alt="User profile picture"></a>

				<h3 class="profile-username text-center">
					<b><?php echo $user->first_name;?> <?php echo $user->last_name;?></b>
				</h3>

				<p class="text-muted text-center"><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></p>
				<p class=" text-center">
					<?php echo ($user->active) ? '<span class="label label-success">'.('Active').'</span>' : '<span class="label label-danger">'.('Inactive').'</span>'; ?>
				</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Terakhir Login : </b>
						<a class="pull-right">
							<?php echo tanggal_waktu($user->last_login);?>
						</a>
					</li>
					<li class="list-group-item">
						<b>Status : </b>
						<a class="pull-right">
							<?php foreach ($user->groups as $group):?>
							<span class="label label-info"><?php echo $group->name;?></span>
							<?php endforeach;?>
						</a>
					</li>
				</ul>
				<div class="row">
					<div class="col-sm-6 col-xs-6">
						<a href="<?php echo site_url("user/edit_user/".$user->id) ;?>" class="btn btn-sm btn-primary btn-block"><b>Update Profile</b></a>
					</div>
					<div class="col-sm-6 col-xs-6">
						<a href="<?php echo site_url("user/change_password/".$user->id);?>" class="btn btn-sm btn-primary btn-block"><b>Change Password</b></a>
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
				<strong><i class="fa fa-intersex margin-r-5"></i> Jenis Kelamin</strong>
				<p class="text-muted"><?php echo $user->sex;?></p>
				<hr>

				<strong><i class="fa fa-info-circle margin-r-5"></i> Agama</strong>
				<p class="text-muted"><?php echo $user->religion;?></p>
				<hr>

				<strong><i class="fa fa-birthday-cake margin-r-5"></i> Tempat, Tanggal Lahir</strong>
				<p class="text-muted"><?php echo $user->location;?> <?php echo waktu($user->birthdate);?></p>
				<hr>

				<strong><i class="fa fa-map-marker margin-r-5"></i>Alamat</strong>
				<p class="text-muted"><?php echo $user->address;?></p>
				<hr>

				<strong><i class="fa fa-user margin-r-5"></i> No.Handphone</strong>
				<p class="text-muted"><?php echo $user->phone;?></p>
				<hr>

				<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
				<p><span class="label label-info"><?php echo $user->skill;?></span></p>
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
</div>
<!-- /.content-wrapper -->
