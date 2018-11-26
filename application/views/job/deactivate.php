<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Deactive</h4>
</div>

<?php echo form_open("job/deactivate/".$user->id);?>
<div class="modal-body">
	
	<div class="box-body">
	<p>Apakah Anda ingin men-deactivate user : <?php echo $user->name;?></p>
</div>
</div>

<?php echo form_hidden($csrf); ?>
<?php echo form_hidden(array('id'=>$user->id)); ?>

<div class="modal-footer">
	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	<?php echo form_submit('submit',('Deactivate'),('class="btn btn-outline"'));?>
</div>
<?php echo form_close();?>