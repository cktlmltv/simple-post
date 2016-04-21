$(function () {
    $('#pwd-addon').on('click', function () {
	if ($(this).data('toggle')) {
	    $(this).html('<i class="fa fa-eye-slash"></i>');
	    $(this).data('toggle', false);
	    $('#pwd').attr('type', 'text');
	} else {
	    $(this).html('<i class="fa fa-eye"></i>');
	    $(this).data('toggle', true);
	    $('#pwd').attr('type', 'password');
	}
    });
})