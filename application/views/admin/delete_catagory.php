<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Hapus Katagori</h4>
</div>

<?php echo form_open("admin/delete_catagory/".$user->id);?>
<div class="modal-body">

	<div class="box-body">
	<p>Apakah yakin ingin menghapus Katagori ini
		<!--<b><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></b>-->
	?</p>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	<?php echo form_submit('submit','Hapus Katagori',('class="btn btn-outline"'));?>
</div>
<?php echo form_close();?>
