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
					<h4><?php echo $this->session->flashdata('message'); ?><?php echo validation_errors(); ?></h4>
				</div>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Katagori</h3>
						<a href="<?php echo site_url('catagories/add'); ?>" class="btn btn-primary btn-sm pull-right" data-tooltip="tooltip" data-placement="top"><i class="glyphicon glyphicon-plus"></i> Tambah Katagori</a>
					</div>
					<div class="box-body">
						<div class="table-responsive no-padding">
							<table id="example1"  class="table table-striped table-hover table-bordered table-condensed">
								<thead>
									<tr>
										<th class="text-center" width="50px">No</th>
										<th>Nama</th>
										<th>Deskripsi</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php
											if($catagories === FALSE )
											{
												echo '<tr><td colspan="8"><br><div class="well"><p>Data belum tersedia</p></div></td></tr>';
											}
											else
											{
												$i = 1; foreach ($catagories as $catagory){
												?>
												<td class="text-center"><?php echo $i++; ?></td>
												<td><?php echo $catagory->name;?></td>
												<td><?php echo $catagory->description;?></td>
												<td class="text-center">
													<?php if ($this->ion_auth->is_admin()): ?>
													<a href="<?php echo site_url('catagories/edit/'.$catagory->id);?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a>
													<a href="#" data-url="<?php echo site_url('catagories/delete_catagory/'.$catagory->id);?>" class="btn btn-xs btn-danger confirm_delete"><i class="fa fa-trash"></i> Delete</a>
													<?php endif ?>

												</td>
											</tr>
											<?php
											} // end foreach
										} // end if
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
