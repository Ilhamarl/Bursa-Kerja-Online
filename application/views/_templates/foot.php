</div><!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/demo.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Data Tables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<!-- iCheck -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- Pwstrength password -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/2.2.1/pwstrength-bootstrap.min.js"></script>
<script>
    if ('serviceWorker' in navigator) {
      console.log("Will service worker register?");
      navigator.serviceWorker.register('service-worker.js').then(function(reg){
        console.log("Yes it did.");
      }).catch(function(err) {
        console.log("No it didn't. This happened: ", err)
      });
    }

    // SWEET ALERT DELETE
    $(document).ready(function(){
      $('.confirm_delete').on('click', function(){
        var delete_url = $(this).attr('data-url');
        swal({
          title: "Hapus data ini ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Hapus !",
          cancelButtonText: "Batalkan",
          closeOnConfirm: false
        }, function(){
          window.location.href = delete_url;
        });
        return false;
      });
    });
</script>

<script>
// Password pwstrength
jQuery(document).ready(function() {
  var options = {
    ui: {
      showVerdictsInsideProgressBar: true,
      viewports: {
        progress: ".pwstrength_viewport_progress"
      }
    }
  };
  $(':password').pwstrength(options);
});

// Service Worker
if ('serviceWorker' in navigator) {
  console.log("Will service worker register?");
  navigator.serviceWorker.register('service-worker.js').then(function(reg){
    console.log("Yes it did.");
  }).catch(function(err) {
    console.log("No it didn't. This happened: ", err)
  });
}

$('#infoMessage').fadeIn('slow').delay(3000).fadeOut('slow');

$(document).ready( function () {
    $('#example1').DataTable();
    $('#example2').DataTable();
} );

$(function () {
	$('#textarea').wysihtml5()
	$('#textarea1').wysihtml5()
});

//Date picker
$('#datepicker').datepicker({
  autoclose: false
});


// Match Password
$('#new, #new_confirm').on('keyup', function ()
{
	if ($('#new').val() != $('#new_confirm').val())
	{
		$('#message').html('<i class ="fa fa-ban"></i> Not Matching').css('color', 'red');
	}else
	$('#message').html('<i class ="fa fa-check"></i> Matching').css('color', 'green');
});

</script>

</body>
</html>
