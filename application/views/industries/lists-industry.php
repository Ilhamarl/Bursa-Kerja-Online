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
		
		<div id="infoMessage">
			<h4><?php echo $this->session->flashdata('message'); ?><?php echo validation_errors(); ?></h4>
		</div>
		
		<?php if($groups === FALSE ){
			echo '<tr><td colspan="8"><br><div class="well"><p>Data belum tersedia</p></div></td></tr>';
		}
		else{
			$i = 1; foreach ($groups as $industry){
				$foto_url = base_url().'/uploads/'.$industry->foto;
				$thumbnail_foto_url = base_url().'/uploads/'.$industry->thumb_foto;
			?>
			<div class="box box-default">
				<div class="box-header with-border">
					<h2 class="box-title">
						<b><a href="<?php echo site_url('industries/data_industry/'.$industry->id);?>"><?php echo $industry->name;?></a></b>
					</h2>
					<small class="pull-right"></small>
				</div>
				
				<div class="box-body">
					<div class="col-sm-4">
						<a href="<?php echo $foto_url;?>" target="_blank"><img src="<?php echo $thumbnail_foto_url;?>" width="100"></a>
						
					</div>
					<div class="col-sm-8">
						<p>Lokasi : <b><?php echo $industry->location;?></b></p>
						<p>Alamat : <b><?php echo $industry->address;?></b></p>
						<p>Website : <b><a href="<?php echo $industry->website;?>" target="_blank"><?php echo $industry->website;?></a></b></p>
					</div>
		</div>
		
		<div class="box-footer">
			<a href="<?php echo site_url('industries/data_industry/'.$industry->id);?>" class="btn btn-md btn-default"><i class="fa fa-eye" ></i> Detail</a>
			
			<?php if ($this->ion_auth->is_admin()): ?>
			<a href="<?php echo site_url('industries/edit/'.$industry->id);?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i> Edit</a>
			<a href="#" data-url="<?php echo site_url('industries/delete_industry/'.$industry->id);?>" class="btn btn-md btn-danger pull-right confirm_delete"><i class="fa fa-trash"></i> Delete</a>
			<?php endif ?>
		</div>
		</div>
		<?php
		} // end foreach
	} // end if
?>

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