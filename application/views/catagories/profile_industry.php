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
		<?php foreach ($catagories as $catagory):?>
		<div class="box box-primary">
			<div class="box-body box-profile">
				<h3 class="profile-username text-center">
					<b><?php echo $catagory->name;?></b>
				</h3>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b><i class="fa fa-file-text-o margin-r-5"></i>  Deskripsi :</b>
						<a class="pull-right"><?php echo $catagory->description;?></a>
					</li>
				</ul>
				<div class="row">
				<div class="col-md-12">
					<?php if ($this->ion_auth->is_admin()): ?>
					<a href="<?php echo site_url("catagories/edit/".$catagory->id); ?>" class="btn btn-primary btn-block"><b>Update Industry Profile</b></a>
					<?php endif ?>
				</div>
				</div>
			</div>
            <!-- /.box-body -->
		</div>v
	</div>
	<?php endforeach;?>
</div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->