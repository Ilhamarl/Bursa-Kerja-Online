<div class="content-wrapper">
	<?php if (!$this->ion_auth->is_user())
	{
		echo '<div class="container">';
	}
	?>
	<section class="content-header banner">
		<div id="typed-strings">
			<h1 class="content-header text-center">Bursa Kerja Online</h1>
			<h3 class="text-center">SMK Muh 1 Bambanglipuro</h3>
		</div>
		<h1 id="typed" class="content-header text-center"></h1>
		<form action="<?php echo site_url('search');?>" method="POST" role="search" class="content-header input-group input-group text-center" style="">
			<input type="text" name="keyword" class="form-control" id="navbar-search-input" placeholder="Cari Lowongan">
			<span class="input-group-btn">
				<button type="submit" value="search" name="search" class="btn btn-success btn-flat"><i class="fa fa-search"></i> Search</button>
			</span>
		</form>
	</section>
	<!-- Main content -->
	<section class="content">
		<div id="infoMessage"><?php echo $message;?></div>
		<div class="row">
			<div class="col-md-8">
				<?php $i = 1; foreach ($users as $user){?>
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title">
								<b><a href="<?php echo site_url('jobs/data_job/'.$user->id);?>"><?php echo $user->name;?></a></b>
							</h3> | <small class="label label-info"><?php echo $user->type;?></small>
						</div>

						<div class="box-body">
							<div class="col-xs-4">
								<?php foreach ($user->groups as $group){?>
									<a href="<?php echo site_url('jobs/data_job/'.$user->id);?>" target="_blank"><img src="<?php echo base_url('uploads/'.$group->thumb_foto);?>" width="90"></a>
									<h5><b><a href="<?php echo site_url('jobs/data_job/'.$user->id);?>" target="_blank"><?php echo $group->name ;?></a></b></h5>
									<small><a href="<?php echo site_url('jobs/data_job/'.$user->id);?>" target="_blank"><?php echo $group->location;?></a></small>
								</div>
							<?php }?>
							<div class="col-xs-8">
								<p><small>Berlaku s/d: <b><?php echo waktu($user->date_expired);?></b></small></p>
								<p><small><?php echo word_limiter($user->description, 20);?> <a href="<?php echo site_url('jobs/data_job/'.$user->id);?>">more</a></small></p>
								<?php foreach ($user->catagories as $catagory) { ?>
									<p><small><i>Katagori: <a href="<?php echo site_url('catagories/catagory/'.$catagory->id);?>"><?php echo $catagory->name ;?></a></i></small></p>
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
				<p><?php echo $links; ?></p>
			</div>
			<div class="col-md-4">
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
	</section>
	<?php if (!$this->ion_auth->is_user())
	{
		echo '</div>';
	}
	?>
</div>
