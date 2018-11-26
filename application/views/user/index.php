<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
		
		
		<div id="infoMessage">
			<h4><?php echo $message;?></h4>
		</div>
		<div class="row">
			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>Jobs</h3>
						
						<p>Informasi Pekerjaan</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="<?php echo site_url('jobs')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>Industry<sup style="font-size: 20px"></sup></h3>
						
						<p>Daftar Industri</p>
					</div>
					<div class="icon">
						<i class="ion ion-clipboard"></i>
					</div>
					<a href="<?php echo site_url('industries')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col ->
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>Profile</h3>
						<p>Profil Siswa</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
					<a href="<?php echo site_url('user/data_user')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-xs-12">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>Settings</h3>
						<p>Update Profile/Password</p>
					</div>
					<div class="icon">
						<i class="ion ion-gear-a"></i>
					</div>
					<a href="<?php echo site_url('user/data_user')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		
		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
	</div>
<!-- /.content-wrapper -->