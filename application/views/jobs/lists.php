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
		
		<div class="row">
			<div class="col-xs-12">
				<div id="infoMessage">
					<h4>
					<?php echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors(); ?>
					</h4>
				</div>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?php echo $title ?></h3>	
						<div class="box-tools">
							<form action="<?php echo site_url('search');?>" method="POST" role="search" class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
								
								<div class="input-group-btn">
									<button type="submit" value="search" name="search" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</form>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr class="info">
								<th class="text-center">NO</th>
								<th>Nama Lowongan</th>
								<th>Type</th>
								<th>Gaji</th>
								<th>Berlaku hingga</th>
								
								<th>Nama Industri</th>
								<th class="text-center">Status</th>
								<th class="text-center">Aksi</th>
							</tr>
							
							<?php $i = 1;foreach ($users as $user):?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td><a href="<?php echo site_url('jobs/data_job/'.$user->id);?>"><?php echo $user->name;?></a></td>
								<td><?php echo $user->type;?></td>
								<td>Rp.<?php echo $user->sallary;?></td>
								<td><?php echo waktu($user->date_expired);?></td>
								<td>
									<?php foreach ($user->groups as $group):?>
									<?php echo $group->name ;?>
									<?php endforeach?>
								</td>
								
								<td class="text-center">
									<?php 
										echo ($user->active)?
										anchor("jobs/deactivate/".$user->id, 'aktif','type="button" class="label label-success" data-toggle="modal" data-target="#modal-warning"'): 
										anchor("jobs/activate/". $user->id, 'tidak aktif', 'class="label bg-orange"');
									?>
								</td>
								
								<td class="text-center">
									<a href="<?php echo site_url('jobs/edit/'.$user->id);?>" class="label label-info"><i class="fa fa-edit"></i> Edit</a>
									&nbsp;
									<a href="#" data-url="<?php echo site_url('jobs/delete/'.$user->id); ?>" class="label label-danger confirm_delete"><i class="fa fa-trash"></i> Hapus</a>
								</td>
							</tr>
							
							<!-- /MODAL DEACTIVATE -->
							<div class="modal modal-warning fade" id="modal-warning">
								<div class="modal-dialog">
									<div class="modal-content">
										
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
							
							<?php endforeach;?>
						</table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
						<a href="<?php echo site_url('jobs/add'); ?>" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
						
						<div class="pull-right">
							<?php echo $links; ?>
						</div>
					</div>
				</div>
				<!-- /.box -->
				
			</div>
		</div>
		
		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->