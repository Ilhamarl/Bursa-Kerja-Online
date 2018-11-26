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

$(document).ready(function() {
	$.uploadPreview({
		input_field: "#image-upload",
		preview_box: "#image-preview",
		label_field: "#image-label"
	});
});

$('#infoMessage').fadeIn('slow').delay(3000).fadeOut('slow');

// MENU SIDE BAR
$(document).ready(function () {
	$('.sidebar-menu').tree()
})

$(function () {
	$('#textarea').wysihtml5()
	$('#textarea1').wysihtml5()
})

// DATA TABLES
$(function () {
	$('#example1').DataTable()
	$('#example2').DataTable({
		'paging'      : true,
		'lengthChange': true,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : true
	})
})

// Match Password
$('#new, #new_confirm').on('keyup', function ()
{
	if ($('#new').val() != $('#new_confirm').val())
	{
		$('#message').html('<i class ="fa fa-ban"></i> Not Matching').css('color', 'red');
	}else
	$('#message').html('<i class ="fa fa-check"></i> Matching').css('color', 'green');
});

$(function () {
	//Initialize Select2 Elements
	$('.select2').select2()

	//Rupiah mask
	$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })

	//Datemask dd/mm/yyyy
	$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	//Datemask2 mm/dd/yyyy
	$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
	//Money Euro
	$('[data-mask]').inputmask()

	//Date range picker
	$('#reservation').daterangepicker()
	//Date range picker with time picker
	$('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
	//Date range as a button
	$('#daterange-btn').daterangepicker(
	{
		ranges   : {
			'Today'       : [moment(), moment()],
			'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month'  : [moment().startOf('month'), moment().endOf('month')],
			'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: moment().subtract(29, 'days'),
		endDate  : moment()
	},
	function (start, end) {
		$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
	}
	)

	//Date picker
	$('#datepicker').datepicker({
		autoclose: false
	})

	//iCheck for checkbox and radio inputs
	$(function () {
		$('#input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});
	});

	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass   : 'iradio_minimal-blue'
	})
	//Red color scheme for iCheck
	$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		checkboxClass: 'icheckbox_minimal-red',
		radioClass   : 'iradio_minimal-red'
	})
	//Flat red color scheme for iCheck
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass   : 'iradio_flat-green'
	})

	//Colorpicker
	$('.my-colorpicker1').colorpicker()
	//color picker with addon
	$('.my-colorpicker2').colorpicker()

	//Timepicker
	$('.timepicker').timepicker({
		showInputs: false
	})
})

// UNTUK LOWONGAN
function confirm_delete()
{
	var get_confirm = confirm('Apakah Anda yakin akan menghapus data ini ?');

	if(get_confirm == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy'
	});
});
// LOGIN JS
$(function () {
    $('#input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' /* optional */
	});
});

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
})
