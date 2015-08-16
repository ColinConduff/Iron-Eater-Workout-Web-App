$('document').ready(function() {
	$('.createWkForm').on('click', function () {
		$('.WkForm').removeClass('hidden');
		$('.hideWell').addClass('hidden');
	});
	
	$('.createExForm').on('click', function () {
		$('.exForm').removeClass('hidden');
		$('.hideWell').addClass('hidden');
	});
});