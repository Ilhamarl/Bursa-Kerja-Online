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
			<div class="col-sm-12">
				<div id="infoMessage"><?php echo $message;?></div>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $title;?></h3>
					</div>
					<div class="box-body">
						<div class="table-responsive no-padding">
							<table id="example1"class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo ('Groups Name');?></th>
										<th><?php echo ('Groups Description');?></th>
									</tr>
								</thead>
								
								<tbody>
									<?php foreach ($groups as $group):?>
									<tr>
										<td><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></td>
										<td><a href="<?php echo site_url("admin/edit_group/".$group->id);?>"><?php echo htmlspecialchars($group->description, ENT_QUOTES, 'UTF-8'); ?></a></td>
										<!--
										<td class="text-center">
											<?php
												if( $group->id != 1 && $group->id != 2):
											?>
											<a class="btn btn-info btn-xs" href="<?php echo site_url("admin/edit_group/".$group->id);?>">Edit</a>
											<a class="btn btn-danger btn-xs" href="<?php echo site_url("admin/delete_group/".$group->id);?>" data-toggle="modal" data-target="#modal-danger">Delete</a>
											<?php  
												endif;
											?>
										</td>
										-->
									</tr>
									<?php endforeach;?>
									<!-- /MODAL DELETE -->
									<div class="modal modal-danger fade" id="modal-danger">
										<div class="modal-dialog">
											<div class="modal-content">
												
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
								</tbody>
							</table>
						</div>
					</div>
					<div class="box-footer clearfix">
						<?php echo anchor('admin/create_group',('Create Group'),('class="btn btn-primary"'))?> 
					</div>
				</div>
			</div>
		</div>
		
		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->