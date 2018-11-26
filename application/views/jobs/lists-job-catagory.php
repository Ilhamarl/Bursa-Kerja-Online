<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<?php if (!$this->ion_auth->is_user())
	{
		echo '<div class="container">';
	}
	?>
	<!-- Content Header (Page header) -->
	<section class="content-header banner">
		<h1 class="content-header text-center">
			<?php echo $title;?>
		</h1>
		<form action="<?php echo site_url('search');?>" method="POST" role="search" class="content-header input-group input-group text-center">
			<input type="text" name="keyword" class="form-control" id="navbar-search-input" placeholder="Cari Lowongan">
			<span class="input-group-btn">
				<button type="submit" value="search" name="search" class="btn btn-success btn-flat"><i class="fa fa-search"></i> Search</button>
			</span>
		</form>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- START SECTION -->
		<div class="row">
			<div class="col-md-8">
				<?php $i = 1; foreach ($users as $user){?>
					<div id="infoMessage"><?php echo $message;?></div>
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
								<p><small>Berlaku : <b><?php echo waktu($user->date_expired);?></b></small></p>
							</div>
							<div class="col-xs-8">
								<?php foreach ($user->catagories as $catagory){?>
									<small><?php echo $catagory->name ;?></small>
								<?php }?>
								<p><small><?php echo word_limiter($user->description, 20);?> <a href="<?php echo site_url('jobs/data_job/'.$user->id);?>">more</a></small></p>
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

				</div>
			</div> <!-- row -->
			<!-- END SECTION -->
		</section>
		<!-- /.content -->
		<?php if (!$this->ion_auth->is_user())
		{
			echo '</div>';
		}
		?>
	</div>
	<!-- /.content-wrapper -->
