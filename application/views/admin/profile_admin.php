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
	<div class="col-md-offset-3 col-sm-6">
		<div id="infoMessage"><?php echo $message;?></div>

		<?php foreach ($users as $user):?>
		<div class="box box-primary">
			<div class="box-body box-profile">
				<h3 class="profile-username text-center">
					<?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?>
					<?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?>
				</h3>

				<p class="text-muted text-center"><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Jenis : </b>
						<a class="">
							<?php foreach ($user->groups as $group):?>
							<span class="label label-primary"><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?></span>
							<?php endforeach?>
						</a>
					</li>
					<li class="list-group-item">
						<b>Status : </b>
						<a class="pull-right">
							<?php foreach ($users as $user):?>
							<?php echo htmlspecialchars ($user->active) ? anchor($user->id, lang('index_active_link')) : anchor($user->id, lang('index_inactive_link'));?>
							<?php endforeach?>
						</a>
					</li>
				</ul>
				<div class="row">
				<div class="col-sm-6 col-xs-6">
					<a href="<?php echo site_url("admin/edit_user/".$user->id);?>" class="btn btn-md btn-primary btn-block"><b>Update Profile</b></a>
				</div>
				<div class="col-sm-6 col-xs-6">
					<a href="<?php echo site_url("admin/change_password/".$user->id);?>" class="btn btn-md btn-primary btn-block"><b>Change Password</b></a>
				</div>
				</div>
			</div>
            <!-- /.box-body -->
		</div>

		<?php endforeach;?>
	</div>
</div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
