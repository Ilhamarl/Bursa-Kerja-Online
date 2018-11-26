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
	<div class="col-xs-12">
		
		<div id="infoMessage"><?php echo $message;?></div>
		
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Data Table With Full Features</h3>
			</div>
			
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive no-padding">
					<table id="example1" class="table table-bordered table-striped ">
						<thead>
							<tr>
								<th><?php echo('Nama Lengkap');?></th>
								<th><?php echo('Email');?></th>
								<th><?php echo('Groups');?></th>
								<th><?php echo('Status');?></th>
								<th><?php echo('Action');?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $user):?>
							<tr>
								<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?>
								<?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
								<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
								<td>
									<?php foreach ($user->groups as $group):?>
									<?php echo anchor("admin/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
									<?php endforeach?>
								</td>
								<td><?php echo ($user->active) ? anchor("admin/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
								<td><?php echo anchor("user/edit_user/".$user->id, 'Edit',('type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-default"')) ;?></td>
							</tr>
							<?php endforeach;?>
							
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
							
						</tbody>
					</table>
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