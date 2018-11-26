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


<div id="infoMessage"><?php echo $message;?></div>
<div class="box box-primary">
	<div class="box-header">
		<h4 class="modal-title"><?php echo lang('edit_user_heading');?></h4>
	</div>
	
	<?php echo form_open(uri_string());?>
	<div class="box-body">
		<div class="form-group">
			<label>Nama Depan</label>
			<?php echo form_input($first_name);?>
		</div>
		
		<div class="form-group">
			<label>Nama Belakang</label>
			<?php echo form_input($last_name);?>
		</div>
		
		<div class="form-group">
			<label>Alamat</label>
			<?php echo form_textarea($address);?>
		</div>
		
		<div class="form-group">
			<label>No. Handphone</label>
			<?php echo form_input($phone);?>
		</div>
		
		<div class="form-group col-md-6">
			<label>Tempat Lahir</label>
			<?php echo form_input($location);?>
		</div>
		
		<div class="form-group col-md-6">
			<label>Tanggal Lahir</label>
			<?php echo form_input($birthdate);?>
		</div>
		
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<?php echo form_input($password);?>
			<div class="progress" style="margin:0">
				<div class="pwstrength_viewport_progress"></div>
			</div>
			
		</div>
		
		<div class="form-group">
			<label for="exampleInputPassword1">Konfirmasi Password</label>
			<?php echo form_input($password_confirm);?>
			<span id='message'></span>
		</div>
		
		<div class="form-group">
			&nbsp;
			<?php if ($this->ion_auth->is_admin()):?>
			
			<label><?php echo lang('edit_user_groups_heading');?> : </label>
			
			<?php foreach ($groups as $group):?>
			<label>
				<?php
					$gID = $group['id'];
					$checked 	= NULL;
					$item 		= NULL;
					foreach($currentGroups as $grp)
					{
						if ($gID == $grp->id)
						{
							$checked= 'checked="checked"';
							break;
						}
					}
				?>
				<input type="checkbox" class="icheck" name="groups[]" value="<?php echo $group['id'];?>" <?php echo $checked;?>>
				<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
			</label>
			<?php endforeach?>
			&nbsp;
			<?php endif ?>
		</div>
	</div>
	
	<?php echo form_hidden('id', $user->id);?>
	<?php echo form_hidden($csrf); ?>
	
	<div class="box-footer">
		<?php echo form_submit('submit',lang('edit_user_heading'),'class = "btn btn-md btn-primary"');?>
	</div>
</div>
<?php echo form_close();?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->