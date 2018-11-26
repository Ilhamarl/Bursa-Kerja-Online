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
	<div class="box-header with-border">
		<h4 class="modal-title"><?php echo lang('edit_user_heading');?></h4>
	</div>

	<?php echo form_open(uri_string());?>
	<div class="box-body">
		<div class="form-group">
			<label><?php echo lang('edit_user_fname_label', 'first_name');?> </label>
			<?php echo form_input($first_name);?>
		</div>

		<div class="form-group">
			<label><?php echo lang('edit_user_lname_label', 'last_name');?></label>
			<?php echo form_input($last_name);?>
		</div>

		<div class="form-group">
			<label>Alamat :</label>
			<?php echo form_textarea($address);?>
		</div>

		<div class="form-group">
			<label><?php echo lang('edit_user_phone_label', 'phone');?></label>
			<?php echo form_input($phone);?>
		</div>

		<div class="form-group">
			<label>Tempat Lahir</label>
			<?php echo form_input($location);?>
		</div>

		<div class="form-group">
			<label>Tanggal Lahir</label>
			<?php echo form_input($birthdate);?>
		</div>

		<div class="form-group">
			<label>Jenis Kelamin</label>
			<?php echo form_dropdown($sex,$sex_option,$sex_value);?>
		</div>

		<div class="form-group">
			<label>Agama</label>
			<?php echo form_dropdown($religion,$religion_option,$religion_value);?>
		</div>

		<div class="form-group">
			<label>Kemampuan</label>
			<?php echo form_textarea($skill);?>
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1"><?php echo lang('edit_user_password_label', 'password');?></label>
			<?php echo form_input($password);?>
			<div class="progress" style="margin:0">
				<div class="pwstrength_viewport_progress"></div>
			</div>

		</div>
		<div class="form-group">
			<label for="exampleInputPassword1"><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
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
					$checked = null;
					$item = null;
					foreach($currentGroups as $grp){
						if ($gID == $grp->id){
							$checked= 'checked="checked"';
							break;
						}
					}
				?>
				<input type="checkbox" class="minimal" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>/>
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
		<?php echo form_submit('submit',lang('edit_user_submit_btn'),('class = "btn btn-md btn-primary"'));?>
	</div>
	<?php echo form_close();?>
</div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
