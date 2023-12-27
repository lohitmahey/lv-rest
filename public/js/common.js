$(document).ready(function() {

	$(".delete-btn").click(function() {
		$("#myModal").modal();
		let url = $('#input-url').val() +'/'+ $(this).data('id');
		$('#delete-form').attr('action', url);
	});

	$("#delete-confirm").click(function() {
		$("#myModal").modal('hide');
		$('#delete-form').submit();
	});
});