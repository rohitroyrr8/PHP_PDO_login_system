$('').ready(function(){
	$('.form').on('submit', function(e){
		e.preventDefault();

		$form = $(this);

		submitForm($form);
	});

	$('#forget-link').on('click', function(e){
		console.log('working');
		$('#login_modal').modal('hide');
	});

});

function submitForm($form){

	$footer = $form.parent('modal-body').next('modal-footer');

	$.ajax({
		url : $form.attr('action'),
		method : $form.attr('method'),
		data : $form.serialize(),
		
		success : function(response){
			console.log(response);
			
			response = $.parseJSON(response);
			
			if(response.success){
				
				if(response.redirect){
					setTimeout(function(){
						$('#'+response.alert+'-alert').html(response.message);
						document.location = response.url;
					}, 2000);
				}
			$('#'+response.alert+'-alert').html(response.message);

			}else if(response.error){
				$('#'+response.alert+'-alert').html(response.message);
			}
			$('input').val('');
		}
					
	});
		
}
