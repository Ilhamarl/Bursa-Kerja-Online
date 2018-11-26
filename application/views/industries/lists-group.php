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
						<h3 class="box-title">Data Industri</h3>
						<a href="<?php echo site_url('industries/add'); ?>" class="btn btn-primary btn-sm pull-right" data-tooltip="tooltip" data-placement="top"><i class="glyphicon glyphicon-plus"></i> Tambah Industri</a>
					</div>
					<div class="box-body">
						<div class="table-responsive no-padding">
							<table id="example1"  class="table table-striped table-hover table-bordered table-condensed">
								<thead>
									<tr>
										<th class="text-center" width="50px">No</th>
										<th>Foto</th>
										<th>Nama</th>
										<th>Email</th>
										<th>Telepon</th>
										<th>Lokasi</th>
										<th>Alamat</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php
											if($groups === FALSE )
											{
												echo '<tr><td colspan="8"><br><div class="well"><p>Data belum tersedia</p></div></td></tr>';
											}
											else
											{
												$i = 1; foreach ($groups as $industry)
												{
													$foto_url = base_url().'/uploads/'.$industry->foto;
													$thumbnail_foto_url = base_url().'/uploads/'.$industry->thumb_foto;
												?>
												<td class="text-center"><?php echo $i++; ?></td>
												<td>
													<a href="<?php echo site_url('industries/data_industry/'.$industry->id);?>" target="_blank"><img src="<?php echo $thumbnail_foto_url;?>" width="100"></a>
												</td>
												<td><a href="<?php echo site_url('industries/data_industry/'.$industry->id);?>"><?php echo $industry->name;?></a></td>
												<td><?php echo $industry->website;?></td>
												<td><?php echo $industry->phone;?></td>
												<td><?php echo $industry->location;?></td>
												<td><?php echo $industry->address;?></td>
												<td class="text-center">
													<?php if ($this->ion_auth->is_admin()): ?>
													<a href="<?php echo site_url('industries/edit/'.$industry->id);?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a>
													<a href="#" data-url="<?php echo site_url('industries/delete_industry/'.$industry->id);?>" class="btn btn-xs btn-danger pull-right confirm_delete"><i class="fa fa-trash"></i> Delete</a>
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
