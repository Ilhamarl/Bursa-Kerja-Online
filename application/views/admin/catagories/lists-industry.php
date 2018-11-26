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
		
		<?php if($catagories === FALSE ){
			echo '<tr><td colspan="8"><br><div class="well"><p>Data belum tersedia</p></div></td></tr>';
		}
		else{
			$i = 1; foreach ($catagories as $catagory){
			?>
			<div class="box box-default">
				<div class="box-header with-border">
					<h2 class="box-title">
						<b><a href="<?php echo site_url('catagories/data_catagory/'.$catagory->id);?>"><?php echo $catagory->name;?></a></b>
					</h2>
					<small class="pull-right"></small>
				</div>
				
				<div class="box-body">
					<div class="col-sm-8">
						<p><b><?php echo $catagory->description;?></b></p>
					</div>
				</div>
		
		<div class="box-footer">
			<a href="<?php echo site_url('catagories/data_catagory/'.$catagory->id);?>" class="btn btn-md btn-default"><i class="fa fa-eye" ></i> Detail</a>
			
			<?php if ($this->ion_auth->is_admin()): ?>
				<a href="<?php echo site_url('catagories/edit/'.$catagory->id);?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i> Edit</a>
				<a href="#" data-url="<?php echo site_url('catagories/delete_catagory/'.$catagory->id);?>" class="btn btn-md btn-danger pull-right confirm_delete"><i class="fa fa-trash"></i> Delete</a>
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