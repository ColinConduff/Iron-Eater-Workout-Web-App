$('document').ready(function() {
	$('.createWkForm').on('click', function () {
		$('.WkForm').removeClass('hidden');
		$('.hideWell').addClass('hidden');
	});
	
	$('.createExForm').on('click', function () {
		$('.exForm').removeClass('hidden');
		$('.hideWell').addClass('hidden');
	});

	$('.createWkFormForPlan').on('click', function () {
		$('.WkForm').removeClass('hidden');
		$('.hideWK').addClass('hidden');
	});

	$('#exercise_list').select2({
		placeholder: 'Select exercises'
	});
});