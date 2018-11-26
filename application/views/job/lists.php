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
					<h4><?php echo $this->session->flashdata('message'); ?>
						<?php echo validation_errors(); ?></h4>
					</div>
					<div class="box">
						<div class="box-header">
							<h3 class="box-title"><?php echo $title ?></h3>
							<a href="<?php echo site_url('job/add'); ?>" class="btn btn-primary btn-sm pull-right" data-tooltip="tooltip" data-placement="top" title="Tambah Lowongan" data-original-title="Tambah Lowongan"><i class="glyphicon glyphicon-plus"></i>Tambah Lowongan</a>
						</div>
						<!-- Content -->
						<div class="box-body table-responsive ">
							<div class="table-responsive no-padding">
								<table id="example1" class="table table-striped table-hover table-bordered">
									<thead>
										<tr class="info">
											<th class="text-center">NO</th>
											<th>Nama Lowongan</th>
											<th>Tipe</th>
											<th>Berlaku hingga</th>
											<th>Nama Industri</th>
											<th>Katagori</th>
											<!-- <th>Sub Katagori</th> -->
											<th>Form</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>

									<tbody>
										<?php $i = 1;foreach ($result as $user):?>
											<tr>
												<td class="text-center"><?php echo $i++; ?></td>
												<td><a href="<?php echo site_url('job/data_job/'.$user->id);?>"><?php echo $user->name;?></a></td>
												<td><?php echo $user->type;?></td>
												<td><?php echo waktu($user->date_expired);?></td>
												<td>
													<?php foreach ($user->groups as $group):?>
														<?php echo $group->name;?>
													<?php endforeach?>
												</td>
													<?php foreach ($user->catagories as $catagory):?>
														<td><?php echo $catagory->name;?></td>
														<!-- <td><?php echo $catagory->description;?></td> -->
													<?php endforeach?>
												<?php if ($user->filedoc == NULL)
												{ ?>
													<td><a href="" target="_blank" class="label label-default"><i class="fa fa-file-text"></i> Tidak Tersedia</a></td>
												<?php }
												else
												{
													?>
													<td><a href="<?php echo base_url('uploads/'.$user->filedoc);?>" target="_blank" class="label label-default"><i class="fa fa-download"></i> Unduh Form</a></td>
												<?php } ?>
												<!--
													<td class="text-center">
													<?php
													echo ($user->active)?
														anchor("job/deactivate/".$user->id, 'aktif','type="button" class="label label-success" data-toggle="modal" data-target="#modal-warning"'):
														anchor("job/activate/". $user->id, 'tidak aktif', 'class="label label-default"');
														?>
													</td>
												-->
													<td class="text-center">
														<a href="<?php echo site_url('job/edit/'.$user->id);?>" class="label label-warning"><i class="fa fa-edit"></i> Edit</a>
														<a href="#" data-url="<?php echo site_url('job/delete/'.$user->id);?>" class="label label-danger confirm_delete"><i class="fa fa-trash"></i> Hapus</a>
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
										</tbody>
									</table>
								</div>
							</div><!-- box-body-->
						</div>
					</div>
				</div>

				<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
