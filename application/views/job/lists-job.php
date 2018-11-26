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

		<?php $i = 1; foreach ($result as $user):?>
			<div class="box box-default">
				<div class="box-header with-border">
					<h2 class="box-title">
						<b><a href="<?php echo site_url('job/data_job/'.$user->id);?>"><?php echo $user->name;?></a></b>
					</h2>
					<small class="pull-right">Post by <?php echo waktu($user->created_on);?></small>
				</div>

				<div class="box-body">
					<div class="col-sm-4">
						<?php foreach ($user->groups as $group):?>
							<h4><b>
								<?php echo $group->name ;?>
							</b></h4>
							<p><?php echo $group->location;?></b></p>
							<p><?php echo $group->description;?></b></p>
						<?php endforeach?>
					</div>
					<div class="col-sm-4">
						<p>Jenis Pekerjaan : <b><?php echo $user->type;?></b></p>
						<p>Gaji Pekerjaan : <b><?php echo $user->sallary;?></b></p>
						<p>Berlaku hingga : <?php echo waktu($user->date_expired);?></p>
					</div>
				</div>

				<div class="box-footer">

					<button type="button" class="btn btn-default">
						<i class="fa fa-eye"></i> Detail
					</button>
					<!--
					<?php echo ($user->active)?
					anchor("job/".$user->id,'Applied','class="btn btn-success pull-right"'):
					anchor("job/". $user->id,'Apply' ,'class="btn btn-primary pull-right"');
					?>
				-->
			</div>
		</div>
	<?php endforeach;?>

	<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
