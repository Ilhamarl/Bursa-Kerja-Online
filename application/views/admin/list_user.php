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
			<h4><?php echo $message;?></h4>
		</div>
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive no-padding">
					<table id="example1" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th><?php echo('No');?></th>
								<th><?php echo('Nama');?></th>
								<th><?php echo('Email');?></th>
								<th><?php echo('Jenis Pengguna');?></th>
								<th class="text-center"><?php echo('Status');?></th>
								<th class="text-center"><?php echo('Aksi');?></th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($users as $user){?>
								<tr>
									<td><?php echo $no++ ?></td>
									
									<td><a href="<?php echo site_url('admin/data_user/'.$user->id);?>"><?php echo $user->first_name;?> <?php echo $user->last_name;?></a></td>
									<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
									<td>
										<?php foreach ($user->groups as $group):?>
										<?php echo anchor("admin/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
										<?php endforeach?>
									</td>
									<td class="text-center"><?php echo ($user->active) ? anchor("admin/deactivate/".$user->id, lang('index_active_link'),('class="label label-success" data-toggle="modal" data-target="#modal-warning"')) : anchor("admin/activate/". $user->id, lang('index_inactive_link'),('class="label label-warning"'));?></td>
									
									<td class="text-center">
										<a href="<?php echo site_url("admin/edit_user/".$user->id);?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
										&nbsp;
										<a href="<?php echo site_url("admin/delete_user/".$user->id);?>" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i> Hapus</a>
									</td>
								</tr>
							<?php } ?>
							<!-- /MODAL DELETE -->
										<div class="modal modal-danger fade" id="modal-danger">
											<div class="modal-dialog">
												<div class="modal-content">
													
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->
										
										<!-- /MODAL EDIT -->
										<div class="modal modal-default fade" id="modal-default" tabindex="-1" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->
										
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
						</tbody>
					</table>
					<!--<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
					<p><?php echo anchor('auth/logout', 'Log out')?></p>-->
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>	

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->