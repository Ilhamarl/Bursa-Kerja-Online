<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<?php if (!$this->ion_auth->is_user() && !$this->ion_auth->is_admin())
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

	<section class="content-header banner">
		<form action="<?php echo site_url('search');?>" method="POST" role="search" class="content-header input-group input-group text-center">
			<input type="text" name="keyword" class="form-control" id="navbar-search-input" placeholder="Cari Lowongan">
			<span class="input-group-btn">
				<button type="submit" value="search" name="search" class="btn btn-success btn-flat"><i class="fa fa-search"></i> Search</button>
			</span>
		</form>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		<div class="row">
			<div class="col-md-8">
				<?php
				if($users == NULL ){
					echo '<div class="well"><p>Lowongan yang dicari tidak ada, coba kata kunci yang lain </p></div>';
				}
				else
				{
					?>
					<?php foreach ($users as $user){?>
						<div class="box box-default">
							<div class="box-header with-border">
								<h3 class="box-title">
									<b><a href="<?php echo site_url('jobs/data_job/'.$user->id);?>"><?php echo $user->name;?></a></b>
								</h3> -
								<small class="label label-info"><?php echo $user->type;?></small>
							</div>

							<div class="box-body">
								<div class="col-xs-4">

									<?php foreach ($user->groups as $group){?>
										<a href="<?php echo site_url('jobs/data_job/'.$user->id);?>" target="_blank"><img src="<?php echo base_url('uploads/'.$group->thumb_foto);?>" width="90"></a>
										<h5><b><?php echo $group->name ;?></b></h5>
										<small><?php echo $group->location;?></small>
									<?php }?>

								</div>
								<div class="col-xs-8">
									<p><small>Berlaku s/d : <b><?php echo waktu($user->date_expired);?></b></small></p>
									<p><small><?php echo word_limiter($user->description, 20);?> <a href="<?php echo site_url('jobs/data_job/'.$user->id);?>">more</a></small></p>
									<?php foreach ($user->catagories as $catagory) { ?>
										<p><small><i>Catagory: <?php echo $catagory->name;?></i></small></p>
									<?php } ?>
								</div>
							</div>

							<div class="box-footer">

								<a href="<?php echo site_url('jobs/data_job/'.$user->id);?>" type="button" class="btn btn-sm btn-default">
									<i class="fa fa-eye"></i> Detail
								</a>
								<small class="pull-right">Post: <?php echo waktu($user->created_on);?></small>
							</div>
						</div>
					<?php }?>
				<?php }?>
			</div>

			<div class="col-md-4">
<!--
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Katagori</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<ul class="nav nav-stacked">
							<form action="<?php echo site_url('search/catagory');?>" method="POST" role="search" class="input-group input-group text-center">
								<input id="typed-input" type="text" name="keyword" class="form-control" id="navbar-search-input" placeholder="Cari Katagori">
								<span class="input-group-btn">
									<button type="submit" value="search" name="search" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
								</span>
							</form>
						</ul>
					</div>
				</div>
			-->
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Industri</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body" style="">
						<ul class="nav nav-stacked">
							<?php foreach ($industries as $catagory){?>
								<li class="">
									<a href="<?php echo site_url('industries/data_industry/'.$catagory->id);?>"><?php echo $catagory->name ;?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Katagori</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body" style="">
						<ul class="nav nav-stacked">
							<?php foreach ($katagori as $catagory){?>
								<li class="">
									<a href="<?php echo site_url('catagories/catagory/'.$catagory->id);?>"><?php echo $catagory->name ;?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>

			</div>

		</div>
		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
	<?php if (!$this->ion_auth->is_user() && !$this->ion_auth->is_admin())
	{
		echo '</div>';
	}
	?>
</div>
<!-- /.content-wrapper -->
