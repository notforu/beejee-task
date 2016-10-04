$(function(){
	$('.confirm-button').on('click', function(){
		var button = $(this);
		var id = $(this).attr('data-id');
		$.post("/comment/changeConfirmation/"+id, {}, function(confirmed){	
			button.text(confirmed == 1 ? 'Reject' : 'Confirm');
		});
		return false;
	});
});