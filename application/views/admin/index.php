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
			<div class="col-lg-3 col-xs-12">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo get_count_job();?></h3>

						<p>Informasi Lowongan</p>
					</div>
					<div class="icon">
						<i class="ion ion-clipboard"></i>
					</div>
					<a href="<?php echo site_url('job')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-12">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo get_count_industry();?><!--<sup style="font-size: 20px">%</sup--></h3>

						<p>Informasi Industri</p>
					</div>
					<div class="icon">
						<i class="ion ion-briefcase"></i>
					</div>
					<a href="<?php echo site_url('industries')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-12">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo get_count_users();?></h3>

						<p>Siswa</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
					<a href="<?php echo site_url('admin/users')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-12">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo get_count_catagory();?></h3>
						<p>Katagori Lowongan</p>
					</div>
					<div class="icon">
						<i class="ion ion-flag"></i>
					</div>
					<a href="<?php echo site_url('admin/catagories')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
