<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
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

$(function () {
  $('#input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' /* optional */
  });
});

// Match Password
$('#new, #new_confirm').on('keyup', function ()
{
  if ($('#new').val() != $('#new_confirm').val())
  {
    $('#message').html('<i class ="fa fa-ban"></i> Not Matching').css('color', 'red');
  }
  else
  $('#message').html('<i class ="fa fa-check"></i> Matching').css('color', 'green');
});
</script>

<script>
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
</script>
</body>
</html>
