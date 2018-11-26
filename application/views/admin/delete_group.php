<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Delete Group</h4>
</div>

<?php echo form_open("admin/delete_group/".$group->id);?>
<div class="modal-body">
	<div class="box-body">
		<p>Apakah yakin ingin menghapus Group ini 
			<!--<?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?>-->
		?</p>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	<?php echo form_submit('submit','Delete Group',('class="btn btn-outline"'));?>
</div>
<?php echo form_close();?>