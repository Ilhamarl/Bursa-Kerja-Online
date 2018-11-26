<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
	<div class="col-sm-12">
		<div id="infoMessage"><?php echo $message;?></div>
		<?php foreach ($users as $user):?>
		<div class="box box-primary">

			<div class="box-header">
				<h3 class="profile-username text-center"><b>
					<?php echo $user->name;?>
				</b>
				</h3>
			</div>

			<div class="box-body table-responsive ">
				<div class="table-responsive no-padding">
					<table id="example1" class="table table-striped table-hover table-bordered">
						<thead>
							<tr class="info">
								<th class="text-center">NO</th>
								<th>Nama Lowongan</th>
								<th>Type</th>
								<th>Berlaku hingga</th>
								<th>Form</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1;foreach ($user->groups as $lowongan):?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td><a href="<?php echo site_url('jobs/data_job/'.$lowongan->id);?>"><?php echo $lowongan->name;?></a></td>
									<td><?php echo $lowongan->type;?></td>
									<td><?php echo waktu($lowongan->date_expired);?></td>
									<?php if ($lowongan->filedoc == NULL)
									{ ?>
										<td><a href="" target="_blank" class="label label-default"><i class="fa fa-file-text"></i> Tidak Tersedia</a></td>
									<?php }
									else
									{
										?>
										<td><a href="<?php echo base_url('uploads/'.$lowongan->filedoc);?>" target="_blank" class="label label-default"><i class="fa fa-download"></i> Unduh Form</a></td>
									<?php } ?>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div><!-- box-body-->
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
